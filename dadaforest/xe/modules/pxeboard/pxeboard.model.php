<?php
    /**
     * vi:set ts=4 sw=4 expandtab enc=utf8:
     * @class  pxeboardModel
     * @author zero (zero@nzeo.com)
     * @brief  pxeboard 모듈의 Model class
     **/

    class pxeboardModel extends module {
        /**
         * @brief 초기화
         **/
        function init() {
        }

        /**
         * @brief 목록 설정 값을 가져옴
         **/
        function getListConfig($module_srl) {
            $oModuleModel = &getModel('module');
            $oDocumentModel = &getModel('document');

            // 저장된 목록 설정값을 구하고 없으면 기본 값으로 설정
            $list_config = $oModuleModel->getModulePartConfig('pxeboard', $module_srl);
            if(!$list_config || !count($list_config)) $list_config = array( 'no', 'title', 'nick_name','regdate','readed_count');

            // 사용자 선언 확장변수 구해와서 배열 변환후 return
            $inserted_extra_vars = $oDocumentModel->getExtraKeys($module_srl);

            foreach($list_config as $key) {
                if(preg_match('/^([0-9]+)$/',$key)) $output['extra_vars'.$key] = $inserted_extra_vars[$key];
                else $output[$key] = new ExtraItem($module_srl, -1, Context::getLang($key), $key, 'N', 'N', 'N', null);
            }
            return $output;
        }

        /** 
         * @brief 기본 목록 설정값을 return
         **/
        function getDefaultListConfig($module_srl) {
            // 가상번호, 제목, 등록일, 수정일, 닉네임, 아이디, 이름, 조회수, 추천수 추가
            $virtual_vars = array( 'no', 'title', 'regdate', 'last_update', 'last_post', 'nick_name', 'user_id', 'user_name', 'readed_count', 'voted_count','thumbnail','summary','registrant_rating','reader_rating');
            foreach($virtual_vars as $key) {
                $extra_vars[$key] = new ExtraItem($module_srl, -1, Context::getLang($key), $key, 'N', 'N', 'N', null);
            }

            // 사용자 선언 확장변수 정리
            $oDocumentModel = &getModel('document');
            $inserted_extra_vars = $oDocumentModel->getExtraKeys($module_srl);

            if(count($inserted_extra_vars)) foreach($inserted_extra_vars as $obj) $extra_vars['extra_vars'.$obj->idx] = $obj;

            return $extra_vars;

        }

        /**
         * @brief get registrant rating
         * @return document_srl, member_srl, point
         **/
        function getRegistrantRating($document_srl) {
            $queryid = "pxeboard.getRegistrantRating";
            $args->document_srl = $document_srl;
            $output = executeQuery($queryid, $args);
            return $output->data;
        }

        function getReaderRatingAverage($document_srl) {
            $count=0;
            $point=0;
            $average=0;

            $queryid = "pxeboard.getReaderRatingAverage";
            $args->document_srl = $document_srl;
            $output = executeQuery($queryid, $args);
            if ($output->data) {
                $count = $output->data->count;
                $point = $output->data->point;

                if ($point && $count) $average = round($point / $count);
            }
            $rating = new StdClass();
            $rating->count = $count;
            $rating->point = $point;
            $rating->average = $average;
            return $rating;
        }

        function getLabelBox($pxeboard_labelbox_srl){
            $args->module_filebox_srl = $pxeboard_labelbox_srl;
            return executeQuery('pxeboard.getLabelBox', $args);
        }

        function getLabelBoxList(){
            $args->page = Context::get('page');
            $args->list_count = 10;
            $args->page_count = 10;
            return executeQuery('pxeboard.getLabelBoxList', $args);
        }

        function getLabelBoxPath($pxeboard_labelbox_srl){
            return sprintf("./files/attach/labelbox/%s",getNumberingPath($pxeboard_labelbox_srl,3));
        }
    }
?>
