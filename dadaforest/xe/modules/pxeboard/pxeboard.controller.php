<?php
    /**
     * vi:set ts=4 sw=4 expandtab enc=utf8:
     * @class  pxeboardController
     * @author zero (zero@nzeo.com)
     * @author diver (diver@coolsms.co.kr)
     * @brief  pxeboard 모듈의 Controller class
     **/

    class pxeboardController extends pxeboard {

        /**
         * @brief 초기화
         **/
        function init() {
        }

        /**
         * @brief 문서 입력
         **/
        function procBoardInsertDocument() {
            if($this->module_info->module != "pxeboard") return new Object(-1, "msg_invalid_request");

            // 권한 체크
            if(!$this->grant->write_document) return new Object(-1, 'msg_not_permitted');
            $logged_info = Context::get('logged_info');

            // 글작성시 필요한 변수를 세팅
            $obj = Context::getRequestVars();
            $obj->module_srl = $this->module_srl;
            if($obj->is_notice!='Y'||!$this->grant->manager) $obj->is_notice = 'N';

            settype($obj->title, "string");
            if($obj->title == '') $obj->title = cut_str(strip_tags($obj->content),20,'...');
            //그래도 없으면 Untitled
            if($obj->title == '') $obj->title = 'Untitled';

            // 관리자가 아니라면 게시글 색상/굵기 제거
            if(!$this->grant->manager) {
                unset($obj->title_color);
                unset($obj->title_bold);
            }

            // document module의 model 객체 생성
            $oDocumentModel = &getModel('document');

            // document module의 controller 객체 생성
            $oDocumentController = &getController('document');

            // 이미 존재하는 글인지 체크
            $oDocument = $oDocumentModel->getDocument($obj->document_srl, $this->grant->manager);

            // 익명 설정일 경우 여러가지 요소를 미리 제거 (알림용 정보들 제거)
            if($this->module_info->use_anonymous == 'Y') {
                $obj->notify_message = 'N';
                $this->module_info->admin_mail = '';
                $obj->member_srl = -1*$logged_info->member_srl;
                $obj->email_address = $obj->homepage = $obj->user_id = '';
                $obj->user_name = $obj->nick_name = 'anonymous';
                $bAnonymous = true;
            }
            else
            {
                $bAnonymous = false;
            }

            // 이미 존재하는 경우 수정
            if($oDocument->isExists() && $oDocument->document_srl == $obj->document_srl) {
				if(!$oDocument->isGranted()) return new Object(-1,'msg_not_permitted');
                $output = $oDocumentController->updateDocument($oDocument, $obj);
                $msg_code = 'success_updated';

            // 그렇지 않으면 신규 등록
            } else {
                $output = $oDocumentController->insertDocument($obj, $bAnonymous);
                $msg_code = 'success_registed';
                $obj->document_srl = $output->get('document_srl');

                // 문제가 없고 모듈 설정에 관리자 메일이 등록되어 있으면 메일 발송
                if($output->toBool() && $this->module_info->admin_mail) {
                    $extravars = "";
                    foreach ($obj as $key => $val) {
                        if (substr($key,0,10)  == 'extra_vars') $extravars = $extravars . $val . "\r\n";
                    }
                    if ($extravars) {
                        $content = sprintf("From : <a href=\"%s\">%s</a><br/>\r\n%s%s"
                            , getFullUrl('','document_srl',$obj->document_srl)
                            , getFullUrl('','document_srl',$obj->document_srl)
                            , $extravars
                            , $obj->content);
                    } else {
                        $content = sprintf("From : <a href=\"%s\">%s</a><br/>\r\n%s"
                            , getFullUrl('','document_srl',$obj->document_srl)
                            , getFullUrl('','document_srl',$obj->document_srl)
                            , $obj->content);
                    }
                    $oMail = new Mail();
                    $oMail->setTitle($obj->title);
                    $oMail->setContent($content);
                    $oMail->setSender($obj->user_name, $obj->email_address);

                    $target_mail = explode(',',$this->module_info->admin_mail);
                    for($i=0;$i<count($target_mail);$i++) {
                        $email_address = trim($target_mail[$i]);
                        if(!$email_address) continue;
                        $oMail->setReceiptor($email_address, $email_address);
                        $oMail->send();
                    }
                }
            }

            // 오류 발생시 멈춤
            if(!$output->toBool()) return $output;

            // 결과를 리턴
            $this->add('mid', Context::get('mid'));
            $this->add('document_srl', $output->get('document_srl'));

            // record rating
            $this->insertRegistrantRating($obj);


            // 성공 메세지 등록
            $this->setMessage($msg_code);
        }


        function procBoardAttachFile() {
            $attached_count=0;
            $obj = Context::gets('document_srl', 'attach_file', 'attach_screenshot', 'screenshot_link', 'preview_image', 'label_image', 'label_url', 'cancel_label_url', 'download_file_delete', 'attach_screenshot_delete','preview_image_delete','label_image_delete');
            if (is_uploaded_file($obj->attach_file['tmp_name'])) $attached_count++;
            if (is_uploaded_file($obj->attach_screenshot['tmp_name'])) $attached_count++;
            if (is_uploaded_file($obj->preview_image['tmp_name'])) $attached_count++;
            if (is_uploaded_file($obj->label_image['tmp_name'])) $attached_count++;


            // record attachments
            $this->insertAttachments($obj, $attached_count);

            $site_module_info = Context::get('site_module_info');
            if (Context::get('category_srl')) 
                $url = getNotEncodedSiteUrl($site_module_info->domain, '', 'mid', Context::get('mid'),'document_srl',Context::get('document_srl'), 'category', Context::get('category_srl'));
            else
                $url = getNotEncodedSiteUrl($site_module_info->domain, '', 'mid', Context::get('mid'),'document_srl',Context::get('document_srl'), 'category', Context::get('category_srl'));

            Context::set('url', $url);

            Context::set('layout','none');
            $this->setTemplatePath($this->module_path.'tpl');
            $this->setTemplateFile('redirect');


        }

        /**
         * @brief 문서 삭제
         **/
        function procBoardDeleteDocument() {
            // 문서 번호 확인
            $document_srl = Context::get('document_srl');

            // 문서 번호가 없다면 오류 발생
            if(!$document_srl) return $this->doError('msg_invalid_document');

            // document module model 객체 생성
            $oDocumentController = &getController('document');

            // 삭제 시도
            $output = $oDocumentController->deleteDocument($document_srl, $this->grant->manager);
            if(!$output->toBool()) return $output;

            $args->document_srl = $document_srl;
            // delete Registrant Rating
            executeQuery('pxeboard.deleteRegistrantRating', $args);
            // delete Readers Rating
            executeQuery('pxeboard.deleteReaderRating', $args);
            // delete attachment
            executeQuery('pxeboard.deletePxeboardAttachment', $args);

            // 성공 메세지 등록
            $this->add('mid', Context::get('mid'));
            $this->add('page', $output->get('page'));
            $this->setMessage('success_deleted');
        }

        /**
         * @brief 추천
         **/
        function procBoardVoteDocument() {
            // document module controller 객체 생성
            $oDocumentController = &getController('document');

            $document_srl = Context::get('document_srl');
            return $oDocumentController->updateVotedCount($document_srl);
        }

        /**
         * @brief 코멘트 추가
         **/
        function procBoardInsertComment() {
            // 권한 체크
            if(!$this->grant->write_comment) return new Object(-1, 'msg_not_permitted');
            $logged_info = Context::get('logged_info');

            // 댓글 입력에 필요한 데이터 추출
            $obj = Context::gets('document_srl','comment_srl','parent_srl','content','password','nick_name','nick_name','member_srl','email_address','homepage','is_secret','notify_message');
            $obj->module_srl = $this->module_srl;

            // 원글이 존재하는지 체크
            $oDocumentModel = &getModel('document');
            $oDocument = $oDocumentModel->getDocument($obj->document_srl);
            if(!$oDocument->isExists()) return new Object(-1,'msg_not_permitted');

            // For anonymous use, remove writer's information and notifying information
            if($this->module_info->use_anonymous == 'Y') {
                $obj->notify_message = 'N';
                $this->module_info->admin_mail = '';

                $obj->member_srl = -1*$logged_info->member_srl;
                $obj->email_address = $obj->homepage = $obj->user_id = '';
                $obj->user_name = $obj->nick_name = 'anonymous';
                $bAnonymous = true;
            }
            else
            {
                $bAnonymous = false;
            }

            // comment 모듈의 model 객체 생성
            $oCommentModel = &getModel('comment');

            // comment 모듈의 controller 객체 생성
            $oCommentController = &getController('comment');

            // comment_srl이 존재하는지 체크
            // 만일 comment_srl이 n/a라면 getNextSequence()로 값을 얻어온다.
            if(!$obj->comment_srl) {
                $obj->comment_srl = getNextSequence();
            } else {
                $comment = $oCommentModel->getComment($obj->comment_srl, $this->grant->manager);
            }

            // comment_srl이 없을 경우 신규 입력
            if($comment->comment_srl != $obj->comment_srl) {

                // parent_srl이 있으면 답변으로
                if($obj->parent_srl) {
                    $parent_comment = $oCommentModel->getComment($obj->parent_srl);
                    if(!$parent_comment->comment_srl) return new Object(-1, 'msg_invalid_request');

                    $output = $oCommentController->insertComment($obj, $bAnonymous);

                // 없으면 신규
                } else {
                    $output = $oCommentController->insertComment($obj, $bAnonymous);
                }

                // 문제가 없고 모듈 설정에 관리자 메일이 등록되어 있으면 메일 발송
                if($output->toBool() && $this->module_info->admin_mail) {
                    $oMail = new Mail();
                    $oMail->setTitle($oDocument->getTitleText());
                    $oMail->setContent( sprintf("From : <a href=\"%s#comment_%d\">%s#comment_%d</a><br/>\r\n%s", getFullUrl('','document_srl',$obj->document_srl),$obj->comment_srl, getFullUrl('','document_srl',$obj->document_srl), $obj->comment_srl, $obj->content));
                    $oMail->setSender($obj->user_name, $obj->email_address);

                    $target_mail = explode(',',$this->module_info->admin_mail);
                    for($i=0;$i<count($target_mail);$i++) {
                        $email_address = trim($target_mail[$i]);
                        if(!$email_address) continue;
                        $oMail->setReceiptor($email_address, $email_address);
                        $oMail->send();
                    }
                }

            // comment_srl이 있으면 수정으로
            } else {
				// 다시 권한체크
				if(!$comment->isGranted()) return new Object(-1,'msg_not_permitted');

                $obj->parent_srl = $comment->parent_srl;
                $output = $oCommentController->updateComment($obj, $this->grant->manager);
                $comment_srl = $obj->comment_srl;
            }
            if(!$output->toBool()) return $output;

            $this->setMessage('success_registed');
            $this->add('mid', Context::get('mid'));
            $this->add('document_srl', $obj->document_srl);
            $this->add('comment_srl', $obj->comment_srl);
        }

        /**
         * @brief 코멘트 삭제
         **/
        function procBoardDeleteComment() {
            // 댓글 번호 확인
            $comment_srl = Context::get('comment_srl');
            if(!$comment_srl) return $this->doError('msg_invalid_request');

            // comment 모듈의 controller 객체 생성
            $oCommentController = &getController('comment');

            $output = $oCommentController->deleteComment($comment_srl, $this->grant->manager);
            if(!$output->toBool()) return $output;

            $this->add('mid', Context::get('mid'));
            $this->add('page', Context::get('page'));
            $this->add('document_srl', $output->get('document_srl'));
            $this->setMessage('success_deleted');
        }

        /**
         * @brief 엮인글 삭제
         **/
        function procBoardDeleteTrackback() {
            $trackback_srl = Context::get('trackback_srl');

            // trackback module의 controller 객체 생성
            $oTrackbackController = &getController('trackback');
            $output = $oTrackbackController->deleteTrackback($trackback_srl, $this->grant->manager);
            if(!$output->toBool()) return $output;

            $this->add('mid', Context::get('mid'));
            $this->add('page', Context::get('page'));
            $this->add('document_srl', $output->get('document_srl'));
            $this->setMessage('success_deleted');
        }

        /**
         * @brief 문서와 댓글의 비밀번호를 확인
         **/
        function procBoardVerificationPassword() {
            // 비밀번호와 문서 번호를 받음
            $password = Context::get('password');
            $document_srl = Context::get('document_srl');
            $comment_srl = Context::get('comment_srl');

            $oMemberModel = &getModel('member');

            // comment_srl이 있을 경우 댓글이 대상
            if($comment_srl) {
                // 문서번호에 해당하는 글이 있는지 확인
                $oCommentModel = &getModel('comment');
                $oComment = $oCommentModel->getComment($comment_srl);
                if(!$oComment->isExists()) return new Object(-1, 'msg_invalid_request');

                // 문서의 비밀번호와 입력한 비밀번호의 비교
                if(!$oMemberModel->isValidPassword($oComment->get('password'),$password)) return new Object(-1, 'msg_invalid_password');

                $oComment->setGrant();
            } else {
                // 문서번호에 해당하는 글이 있는지 확인
                $oDocumentModel = &getModel('document');
                $oDocument = $oDocumentModel->getDocument($document_srl);
                if(!$oDocument->isExists()) return new Object(-1, 'msg_invalid_request');

                // 문서의 비밀번호와 입력한 비밀번호의 비교
                if(!$oMemberModel->isValidPassword($oDocument->get('password'),$password)) return new Object(-1, 'msg_invalid_password');

                $oDocument->setGrant();
            }
        }

        /**
         * @brief 아이디 클릭시 나타나는 팝업메뉴에 "작성글 보기" 메뉴를 추가하는 trigger
         **/
        function triggerMemberMenu(&$obj) {
            $member_srl = Context::get('target_srl');
            $mid = Context::get('cur_mid');

            if(!$member_srl || !$mid) return new Object();

            $logged_info = Context::get('logged_info');

            // 호출된 모듈의 정보 구함
            $oModuleModel = &getModel('module');
            $cur_module_info = $oModuleModel->getModuleInfoByMid($mid);

            if($cur_module_info->module != 'pxeboard') return new Object();

            // 자신의 아이디를 클릭한 경우
            if($member_srl == $logged_info->member_srl) {
                $member_info = $logged_info;
            } else {
                $oMemberModel = &getModel('member');
                $member_info = $oMemberModel->getMemberInfoByMemberSrl($member_srl);
            }

            if(!$member_info->user_id) return new Object();

            // 아이디로 검색기능 추가
            $url = getUrl('','mid',$mid,'search_target','user_id','search_keyword',$member_info->user_id);
            $oMemberController = &getController('member');
            $oMemberController->addMemberPopupMenu($url, 'cmd_view_own_document', './modules/member/tpl/images/icon_view_written.gif');

            return new Object();
        }

        // permission check added. - 2010/03/15
        function triggerCheckPermission($obj) {
            $oModuleModel = &getModel('module');
            $module_info = $oModuleModel->getModuleInfoByModuleSrl($obj->module_srl);
            if ($module_info->module != 'pxeboard') return new Object();

            $logged_info = Context::get('logged_info');
            $grant = $oModuleModel->getGrant($module_info, $logged_info);
            if(!$grant->download) return new Object(-1, 'msg_not_permitted');
        }

        function insertRegistrantRating(&$obj) {
            $logged_info = Context::get('logged_info');
            $args->document_srl = $obj->document_srl;
            $args->member_srl = $logged_info->member_srl;
            $args->ipaddress = $_SERVER['REMOTE_ADDR'];
            $args->point = $obj->registrant_rating;
            $queryid = 'pxeboard.deleteRegistrantRating';
            $output = executeQuery($queryid, $args);
            $queryid = 'pxeboard.insertRegistrantRating';
            $output = executeQuery($queryid, $args);
            return $output;
        }

        function insertReaderRating(&$obj) {
            $logged_info = Context::get('logged_info');
            $args->document_srl = $obj->document_srl;
            $args->member_srl = $logged_info->member_srl;
            $args->ipaddress = $_SERVER['REMOTE_ADDR'];
            $args->point = $obj->rating;
            $queryid = "pxeboard.insertReaderRating";
            $output = executeQuery($queryid, $args);
            return $output;
        }

        function insertAttachments(&$obj, $attached_count) {
            // document module의 model 객체 생성
            $oDocumentModel = &getModel('document');
            // 이미 존재하는 글인지 체크
            $oDocument = $oDocumentModel->getDocument($obj->document_srl, $this->grant->manager);

            $args->module_srl = $this->module_srl;
            $args->document_srl = $obj->document_srl;

            $oFileController = &getController('file');

            // get existent data
            $output = executeQuery('pxeboard.getPxeboardAttachment', $args);
            if ($output->toBool() && $output->data) {
                $args = $output->data;
            }
            $args->screenshot_link = $obj->screenshot_link;


            // delete exist images
            if ($obj->attach_file || $obj->download_file_delete=='Y') {
                if ($args->file_srl > 0) {
                    $oFileController->deleteFile($args->file_srl);
                    $attached_count--;
                }
                $args->file_srl = 0;
            }
            if ($obj->attach_screenshot || $obj->attach_screenshot_delete=='Y') {
                if ($args->screenshot_file_srl > 0) {
                    $oFileController->deleteFile($args->screenshot_file_srl);
                    $attached_count--;
                }
                $args->screenshot_file_srl = 0;
                $args->screenshot_url = '';
            }
            if ($obj->preview_image || $obj->preview_image_delete=='Y') {
                if ($args->preview_file_srl > 0) {
                    $oFileController->deleteFile($args->preview_file_srl);
                    $attached_count--;
                }
                $args->preview_file_srl = 0;
                $args->preview_url = '';
            }
            if ($obj->label_image || $obj->label_image_delete=='Y') {
                if ($args->label_file_srl > 0) {
                    $oFileController->deleteFile($args->label_file_srl);
                    $attached_count--;
                }
                $args->label_file_srl = 0;
                $args->label_url = '';
            }
            if ($obj->cancel_label_url == 'Y') {
                $args->label_url = '';
            }

            // 이미 존재하는 경우 수정
            if($oDocument->isExists() && $oDocument->document_srl == $obj->document_srl) {
                // uploaded count modification
                $args->document_srl = $obj->document_srl;
                $args->uploaded_count = $oDocument->get('uploaded_count');
                $args->uploaded_count += $attached_count;
                executeQuery('pxeboard.updateDocumentFilesCount', $args);
            }

            if ($obj->attach_file) {
                $output = $oFileController->insertFile($obj->attach_file, $args->module_srl, $args->document_srl);
                if(!$output || !$output->toBool()) return $output;
                $args->file_srl = $output->get('file_srl');
            }

            if ($obj->attach_screenshot) {
                $output = $oFileController->insertFile($obj->attach_screenshot, $this->module_srl, $args->document_srl);
                if(!$output || !$output->toBool()) return $output;
                $args->screenshot_file_srl = $output->get('file_srl');
                $args->screenshot_url = $output->get('uploaded_filename');
                $screenshot_width = $this->module_info->screenshot_width;
                $screenshot_height = $this->module_info->screenshot_height;
                if (!$screenshot_width) $screenshot_width = 154;
                if (!$screenshot_height) $screenshot_width = 154;
                if($args->screenshot_url) FileHandler::createImageFile($args->screenshot_url, $args->screenshot_url, $screenshot_width,$screenshot_height,'jpg');
            }

            // preview
            if ($obj->preview_image) {
                $output = $oFileController->insertFile($obj->preview_image, $this->module_srl, $args->document_srl);
                if(!$output || !$output->toBool()) return $output;
                $args->preview_file_srl = $output->get('file_srl');
                $args->preview_url = $output->get('uploaded_filename');
            }
            // label
            if ($obj->label_image) {
                $output = $oFileController->insertFile($obj->label_image, $this->module_srl, $args->document_srl);
                if(!$output || !$output->toBool()) return $output;
                $args->label_file_srl = $output->get('file_srl');
                $args->label_url = $output->get('uploaded_filename');
            }
            if ($obj->label_url) {
                $args->label_url = $obj->label_url;
            }

            // set files valid
            $oFileController = &getController('file');
            $oFileController->setFilesValid($obj->document_srl);

            $output = executeQuery('pxeboard.deletePxeboardAttachment', $args);
            if (!$output->toBool()) return $output;

            $output = executeQuery('pxeboard.insertPxeboardAttachment', $args);
            if (!$output->toBool()) return $output;
        }

        /**
         * @brief 라벨박스에 파일 추가 및 업데이트
         **/
        function procPxeboardLabelBoxAdd(){

            $logged_info = Context::get('logged_info');
            if($logged_info->is_admin !='Y' && !$logged_info->is_site_admin) return new Object(-1, 'msg_not_permitted');

            $vars = Context::gets('comment','addfile','filter');
            $pxeboard_labelbox_srl = Context::get('pxeboard_labelbox_srl');

            $ext = strtolower(substr(strrchr($vars->addfile['name'],'.'),1));
            $vars->ext = $ext;
            if($vars->filter) $filter = explode(',',$vars->filter);
            else $filter = array('jpg','jpeg','gif','png');
            if(!in_array($ext,$filter)) return new Object(-1, 'msg_error_occured');

            $vars->member_srl = $logged_info->member_srl;

            // update
            if($pxeboard_labelbox_srl > 0){
                $vars->pxeboard_labelbox_srl = $pxeboard_labelbox_srl;
                $output = $this->updateLabelBox($vars);

            // insert
            }else{
                if(!Context::isUploaded()) return new Object(-1, 'msg_error_occured');
                $addfile = Context::get('addfile');
                if(!is_uploaded_file($addfile['tmp_name'])) return new Object(-1, 'msg_error_occured');
                if($vars->addfile['error'] != 0) return new Object(-1, 'msg_error_occured');
                $output = $this->insertLabelBox($vars);
            }

            $url  = getUrl('','module','pxeboard','act','dispPxeboardLabelBox','input',Context::get('input'),'filter',$vars->filter);
            $url = html_entity_decode($url);
            $vars = Context::set('url',$url);
            $this->setTemplatePath($this->module_path.'tpl');
            $this->setTemplateFile('move_labelbox_list');
        }


        /**
         * @brief 파일박스에 파일 업데이트
         **/
        function updateLabelBox($vars){

            // have file
            if($vars->addfile['tmp_name'] && is_uploaded_file($vars->addfile['tmp_name'])){
                $oModuleModel = &getModel('module');
                $output = $oModuleModel->getModuleFileBox($vars->pxeboard_labelbox_srl);
                FileHandler::removeFile($output->data->filename);

                $path = $oModuleModel->getModuleFileBoxPath($vars->pxeboard_labelbox_srl);
                FileHandler::makeDir($path);

                $save_filename = sprintf('%s%s.%s',$path, $vars->pxeboard_labelbox_srl, $ext);
                $tmp = $vars->addfile['tmp_name'];

                if(!@move_uploaded_file($tmp, $save_filename)) {
                    return false;
                }

                $args->fileextension = strtolower(substr(strrchr($vars->addfile['name'],'.'),1));
                $args->filename = $save_filename;
                $args->filesize = $vars->addfile['size'];

            }

            $args->pxeboard_labelbox_srl = $vars->pxeboard_labelbox_srl;
            $args->comment = $vars->comment;

            return executeQuery('module.updateLabelBox', $vars);
        }


        /**
         * @brief 파일박스에 파일 추가
         **/
        function insertLabelBox($vars){
            // set pxeboard_labelbox_srl
            $vars->pxeboard_labelbox_srl = getNextSequence();

            // get file path
            $oModel = &getModel('pxeboard');
            $path = $oModel->getLabelBoxPath($vars->pxeboard_labelbox_srl);
            FileHandler::makeDir($path);
            $save_filename = sprintf('%s%s.%s',$path, $vars->pxeboard_labelbox_srl, $vars->ext);
            $tmp = $vars->addfile['tmp_name'];

            // upload
            if(!@move_uploaded_file($tmp, $save_filename)) {
                return false;
            }

            // insert
            $args->pxeboard_labelbox_srl = $vars->pxeboard_labelbox_srl;
            $args->member_srl = $vars->member_srl;
            $args->comment = $vars->comment;
            $args->filename = $save_filename;
            $args->fileextension = strtolower(substr(strrchr($vars->addfile['name'],'.'),1));
            $args->filesize = $vars->addfile['size'];

            $output = executeQuery('pxeboard.insertLabelBox', $args);
            return $output;
        }


        /**
         * @brief 라벨박스에 파일 삭제
         **/

        function procPxeboardLabelBoxDelete() {
            $logged_info = Context::get('logged_info');
            if($logged_info->is_admin !='Y' && !$logged_info->is_site_admin) return new Object(-1, 'msg_not_permitted');

            $pxeboard_labelbox_srl = Context::get('pxeboard_labelbox_srl');
            if(!$pxeboard_labelbox_srl) return new Object(-1, 'msg_invalid_request');
            $vars->pxeboard_labelbox_srl = $pxeboard_labelbox_srl;
            $output = $this->deleteLabelBox($vars);
            if(!$output->toBool()) return $output;
        }

        function deleteLabelBox($vars) {

            // delete real file
            $oModel = &getModel('pxeboard');
            $output = $oModel->getLabelBox($vars->pxeboard_labelbox_srl);
            FileHandler::removeFile($output->data->filename);

            $args->pxeboard_labelbox_srl = $vars->pxeboard_labelbox_srl;
            return executeQuery('pxeboard.deleteLabelBox', $args);
        }

    }
?>
