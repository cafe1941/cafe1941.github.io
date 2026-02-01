<?php
    /**
     * vi:set ts=4 sw=4 expandtab enc=utf8:
     * @class  pxeboard
     * @author zero (zero@nzeo.com)
     * @brief  pxeboard 모듈의 high class
     **/

    class pxeboard extends ModuleObject {

        var $search_option = array('title','content','title_content','comment','user_name','nick_name','user_id','tag'); ///< 검색 옵션

        var $order_target = array('list_order', 'update_order', 'regdate', 'voted_count', 'readed_count', 'comment_count', 'title'); // 정렬 옵션

        var $skin = "default"; ///< 스킨 이름
        var $list_count = 20; ///< 한 페이지에 나타날 글의 수
        var $page_count = 10; ///< 페이지의 수
        var $category_list = NULL; ///< 카테고리 목록


        /**
         * @brief 설치시 추가 작업이 필요할시 구현
         **/
        function moduleInstall() {
            // action forward에 등록 (관리자 모드에서 사용하기 위함)
            $oModuleController = &getController('module');
            $oModuleModel = &getModel('module');

            // 2007. 10. 17 아이디 클릭시 나타나는 팝업메뉴에 작성글 보기 기능 추가
            $oModuleController->insertTrigger('member.getMemberMenu', 'pxeboard', 'controller', 'triggerMemberMenu', 'after');

            // 기본 게시판 생성
            $args->site_srl = 0;
            $output = executeQuery('module.getSite', $args);
            if(!$output->data->index_module_srl) {
                $args->mid = 'board';
                $args->module = 'pxeboard';
                $args->browser_title = 'XpressEngine';
                $args->skin = 'xe_default';
                $args->site_srl = 0;
                $output = $oModuleController->insertModule($args);
                $module_srl = $output->get('module_srl');
                $site_args->site_srl = 0;
                $site_args->index_module_srl = $module_srl;
                $oModuleController = &getController('module');
                $oModuleController->updateSite($site_args);
            }

            return new Object();
        }

        /**
         * @brief 설치가 이상이 없는지 체크하는 method
         **/
        function checkUpdate() {
            $oDB = &DB::getInstance();
            $oModuleModel = &getModel('module');

            // 2007. 10. 17 아이디 클릭시 나타나는 팝업메뉴에 작성글 보기 기능 추가
            if(!$oModuleModel->getTrigger('member.getMemberMenu', 'pxeboard', 'controller', 'triggerMemberMenu', 'after')) return true;

            // screenshot_link field added - 2010/03/05
            if (!$oDB->isColumnExists('pxeboard_attachment', 'screenshot_link'))
                return true;

            // preview_url field added - 2010/03/05
            if (!$oDB->isColumnExists('pxeboard_attachment', 'preview_url'))
                return true;

            // label_url field added - 2010/03/05
            if (!$oDB->isColumnExists('pxeboard_attachment', 'label_url'))
                return true;

            // screenshot_file_srl field added - 2010/03/09
            if (!$oDB->isColumnExists('pxeboard_attachment', 'screenshot_file_srl'))
                return true;

            // preview_file_srl field added - 2010/03/09
            if (!$oDB->isColumnExists('pxeboard_attachment', 'preview_file_srl'))
                return true;

            // label_file_srl field added - 2010/03/09
            if (!$oDB->isColumnExists('pxeboard_attachment', 'label_file_srl'))
                return true;

            // trigger added. - 2010/03/15
            if(!$oModuleModel->getTrigger('file.downloadFile', 'pxeboard', 'controller', 'triggerCheckPermission', 'before')) return true;

            return false;
        }

        /**
         * @brief 업데이트 실행
         **/
        function moduleUpdate() {
            $oDB = &DB::getInstance();
            $oModuleModel = &getModel('module');
            $oModuleController = &getController('module');

            // 2007. 10. 17 아이디 클릭시 나타나는 팝업메뉴에 작성글 보기 기능 추가
            if(!$oModuleModel->getTrigger('member.getMemberMenu', 'pxeboard', 'controller', 'triggerMemberMenu', 'after'))
                $oModuleController->insertTrigger('member.getMemberMenu', 'pxeboard', 'controller', 'triggerMemberMenu', 'after');

            // screenshot_link field added - 2010/03/05
            if (!$oDB->isColumnExists('pxeboard_attachment', 'screenshot_link'))
                $oDB->addColumn('pxeboard_attachment', 'screenshot_link', 'varchar', 255, '', true);

            // preview_url field added - 2010/03/05
            if (!$oDB->isColumnExists('pxeboard_attachment', 'preview_url'))
                $oDB->addColumn('pxeboard_attachment', 'preview_url', 'varchar', 255, '', true);

            // label_url field added - 2010/03/05
            if (!$oDB->isColumnExists('pxeboard_attachment', 'label_url'))
                $oDB->addColumn('pxeboard_attachment', 'label_url', 'varchar', 255, '', true);

            // screenshot_file_srl field added - 2010/03/09
            if (!$oDB->isColumnExists('pxeboard_attachment', 'screenshot_file_srl'))
                $oDB->addColumn('pxeboard_attachment', 'screenshot_file_srl', 'number', 11, '0', true);

            // preview_file_srl field added - 2010/03/09
            if (!$oDB->isColumnExists('pxeboard_attachment', 'preview_file_srl'))
                $oDB->addColumn('pxeboard_attachment', 'preview_file_srl', 'number', 11, '0', true);

            // label_file_srl field added - 2010/03/09
            if (!$oDB->isColumnExists('pxeboard_attachment', 'label_file_srl'))
                $oDB->addColumn('pxeboard_attachment', 'label_file_srl', 'number', 11, '0', true);

            // trigger added. - 2010/03/15
            if(!$oModuleModel->getTrigger('file.downloadFile', 'pxeboard', 'controller', 'triggerCheckPermission', 'before'))
                $oModuleController->insertTrigger('file.downloadFile', 'pxeboard', 'controller', 'triggerCheckPermission', 'before');

            return new Object(0, 'success_updated');
        }

        /**
         * @brief 캐시 파일 재생성
         **/
        function recompileCache() {
        }

    }
?>
