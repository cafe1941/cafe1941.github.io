<?php
    /**
     * vi:set ts=4 sw=4 expandtab enc=utf8:
     * @class  pxeboardIcons
     * @author diver (diver@coolsms.co.kr)
     * @brief  icons
     **/

    class pxeboardIcons extends Object {
        var $skin;
        var $filter = array();

        function pxeboardIcons($skin, $filter = array()) {
            $this->skin = $skin;
            $this->filter = $filter;
        }

        // secret, new, update, image, movie, file
        function printIcons(&$oDocument, $time_check = 43200) {

            // icon directory
            $path = sprintf('%smodules/pxeboard/skins/%s/img/icons/', getUrl(), $this->skin);

            $buffs = $oDocument->getExtraImages($time_check);
            if(!count($buffs)) return;

            $buff = null;
            foreach($buffs as $key => $val) {
                if (!in_array($val, $this->filter))
                    $buff .= sprintf('<img src="%s%s.gif" alt="%s" title="%s" style="margin-right:2px;" />', $path, $val, $val, $val);
            }
            return $buff;
        }
    }
?>
