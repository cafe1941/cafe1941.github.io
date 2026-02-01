<?php
    /**
     * @class  bodexItem
     * @author phiDel (phidel@foxb.kr)
     **/

    class bodexItem extends Object {

        var $module_srl = 0;
        var $display_extra_images = null;

        function bodexItem($module_srl, $display_extra_images) {
            $this->module_srl = $module_srl;
            $this->display_extra_images = array_flip(explode('|@|', $display_extra_images));
            if(!is_array($this->display_extra_images)) $this->display_extra_images = array();
        }

        function getGrantGroups($site_srl = 0) {
            $oMemberModel = &getModel('member');
            return $oMemberModel->getGroups($site_srl);
        }

        function getPointConfig($name = null) {
            $oBodexModel = &getModel('bodex');
            return $oBodexModel->getPointConfig($name, $this->module_srl);
        }

        function getMemberPoint($member_srl=0) {
            $oBodexModel = &getModel('bodex');
            return $oBodexModel->getMemberPoint($member_srl);
        }

        function getNotAdoptedPostCount() {
            $oBodexModel = &getModel('bodex');
            return $oBodexModel->getNotAdoptedPostCount($this->module_srl);
        }

        function getDocumentNavigation($document_srl=0) {
            $oBodexModel = &getModel('bodex');
            return $oBodexModel->getDocumentNavigation($document_srl, $this->module_srl);
        }

        function getVotedLogInfo($document_srl = 0, $member_srl=0) {
            if(!$document_srl) $document_srl = Context::get('document_srl');

            $args->document_srl = $document_srl;
            if($member_srl>0) $args->member_srl = $member_srl;
            $output = executeQueryArray('bodex.getDocumentVotedLog', $args);

            $re = array();
            //% 없으면 빈값을 내보냄
            if(!$output->toBool() || !$output->data) return $re;

            //% 검색이 쉽게 멤버번호 또는 ip주소를 키값으로 셋팅
            foreach($output->data as $val){
                if($val->member > 0){
                    $re[$val->member] = $val->point;
                }else{
                    $re[$val->ipaddress] = $val->point;
                }
            }

            return $re;
        }

        function getDownloadedLogInfo($document_srl = 0) {
            if(!$document_srl) $document_srl = Context::get('document_srl');

            $logged_info = Context::get('logged_info');
            //% 로그인 사용자이면 member_srl, 비회원이면 ipaddress
            if($logged_info->member_srl) {
                $args->member_srl = $logged_info->member_srl;
            } else {
                $args->ipaddress = $_SERVER['REMOTE_ADDR'];
            }

            $args->upload_target_srl = $document_srl;
            $output = executeQueryArray('bodex.getFileDownloadedLogInfo', $args);

            $re = array();
            //% 없으면 빈값을 내보냄
            if(!$output->toBool() || !$output->data) return $re;

            $Data = $output->data;
            //% 검색이 쉽게 파일번호를 키값으로 셋팅
            foreach($Data as $val){
                $re[$val->file_srl] = $val->download_count;
            }

            return $re;
        }

        function getSplitFileList($buffs) {
            if(!is_array($buffs)||!count($buffs)) return;

            $re = array();
            foreach($buffs as $key => $file){
                if($file->direct_download=='Y'){
                    if(preg_match("/\.(swf|flv|mp[1234]|as[fx]|wm[av]|mpg|mpeg|avi|wav|mid|midi|mov|moov|qt|rm|ram|ra|rmm|m4v)$/i", $file->source_filename)){
                        $re['media'][]=$file;
                    }else{
                        $re['image'][]=$file;
                    }
                }else{
                    $re['binary'][]=$file;
                }
            }
            return $re;
        }

        function printExtraImages($buffs) {
            if(!is_array($buffs)) return;

            // 아이콘 디렉토리 구함
            $path = sprintf('%s%s',getUrl(), 'modules/document/tpl/icons/');

            if(!count($buffs)) return;

            $buff = null;
            foreach($buffs as $key => $val) {
                if(isset($this->display_extra_images['none']) && !$this->display_extra_images[$val]) continue;
                $buff .= sprintf('<img src="%s%s.gif" alt="%s" title="%s" style="margin-right:2px;" />', $path, $val, $val, $val);
            }
            return $buff;
        }

        function getWith($obj, $arr) {
            if(!$obj || !is_array($obj->variables) || !is_array($arr)) return $obj;

            foreach($arr as $val){
                $obj->{$val} = $obj->variables[$val];
            }

            return $obj;
        }

        function cutStrEx($value, $cut_size = 0) {
            if(!$cut_size || $cut_size<=0) return $value;

            if(preg_match('/(<a\s.+>)(http:\/\/)?(.+?)(<\/a>)/e', $value, $match)) {
                $value = $match[1].cut_str($match[3], $cut_size).$match[4];
            }else{
                $value = cut_str(strip_tags($value), $cut_size);
            }

            return $value;
        }

        function inArrayEx($needle, $haystack, $strict = false) {
            if(!is_array($needle) || !is_array($haystack))
                return false;

            foreach($needle as $val){
                if(in_array($val, $haystack, $strict))
                    return true;
            }

            return false;
        }
    }
?>
