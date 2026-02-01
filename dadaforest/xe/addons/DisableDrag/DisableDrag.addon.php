<?php
    if(!defined("__ZBXE__")) exit();

    /**
    * @file DisableDrag.addon.php
    * @author SMaker (dowon2308@paran.com)
    * @brief jQuery Disable text select Plugin
    **/
		if(Context::get('module')) return;

		// Addon Called Position
		if(Context::getResponseMethod()!='HTML') return;
		if($called_position != 'before_module_init') return;

		// Addon Setting Check
        $target = array('a', 'img', 'btn', 'img_btn', 'img_btn_link', 'document');
		if(!$addon_info->disable_target || !in_array($addon_info->disable_target, $target)) $addon_info->disable_target = 'document';
		if(!$addon_info->allow_admin) $addon_info->allow_admin = 'Y';
		if(!$addon_info->condition_pipe != 'or') $addon_info->condition_pipe = 'and';
		$addon_info->require_point = (int)$addon_info->require_point;
		$addon_info->require_level = (int)$addon_info->require_level;
		$addon_info->require_level = trim($addon_info->require_group);
		$addon_info->disable_target = "'".$addon_info->disable_target."'";

		// Allow Member/Admin
		$logged_info = Context::get('logged_info');
		if($addon_info->allow_member == 'Y' && $logged_info) return;
		if($addon_info->allow_admin == 'Y' && $logged_info->is_admin == 'Y') return;


		// Allow Point/Level/Group
		$oMemberModel = &getModel('member');
		$oPointModel = &getModel('point');

		if($logged_info) {
            // Get Point
			if($addon_info->require_point || $addon_info->require_level) $point = $oPointModel->getPoint($logged_info->member_srl);

            // Get Level
			if($addon_info->require_level) {
				$oModuleModel = &getModel('module');
				$config = $oModuleModel->getModuleConfig('point');
				$level = $oPointModel->getLevel($point, $config->level_step);
			}

            // Get Group
			if($addon_info->require_group) {
				$RequireGroup = explode(',',trim($addon_info->require_group));
				$GroupList = $logged_info->group_list;
			}
		}

		// Condition Check
		$ConditionS = 0;
		$Condition = 0;

		if($addon_info->require_point) {
			$ConditionS += 1;
			if($Point>=$addon_info->require_point) $Condition += 1;
		}

		if($addon_info->require_level) {
			$ConditionS += 1;
			if($Level>=$addon_info->require_level) $Condition += 1;
		}

		if($addon_info->require_group) {
			$ConditionS += 1;
			if(in_array($RequireGroup, $GroupList)) $Condition += 1;
		}

		if($addon_info->condition_pipe == 'and') {
			if($ConditionS && $ConditionS === $Condition) return;
		} elseif($addon_info->condition_pipe == 'or') {
			if($ConditionS && $Condition) return;
		}

		// jQuery Disable text select JS Plugin
		Context::addJsFile('./addons/DisableDrag/js/jQuery.text_selection.min.js');
		Context::addJsFile('./addons/DisableDrag/js/DisableDrag-min.js');

		// Right-Click Start
		$script_code = '<script type="text/javascript">startDisableDrag(%s)</script>';
		Context::addHtmlHeader(sprintf($script_code,$addon_info->disable_target));
?>