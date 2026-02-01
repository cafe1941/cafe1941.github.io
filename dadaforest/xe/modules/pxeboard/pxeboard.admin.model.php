<?php
    /**
     * vi:set ts=4 sw=4 expandtab enc=utf8:
     * @class  pxeboardAdminModel
     * @author zero (zero@nzeo.com)
     * @brief  pxeboard 모듈의 Model class
     **/

    class pxeboardAdminModel extends module {
        /**
         * @brief 초기화
         **/
        function init() {
        }

        function getPxeboardAdminBoardSkins() {
            $module_name = Context::get('module_name');
            $oModel = &getModel($module_name);

            if (!is_object($oModel)) return;

            $skin_list = array();

            // 스킨 목록을 구해옴
            $oModuleModel = &getModel('module');
            $skin_objs = $oModuleModel->getSkins($oModel->module_path);

            foreach ($skin_objs as $key => $val) {
                $obj = new StdClass();
                $obj->skin = $key;
                $obj->title = $val->title;
                $skin_list[] = $obj;
            }
            $this->add('skin_list', $skin_list);
        }
    }
?>
