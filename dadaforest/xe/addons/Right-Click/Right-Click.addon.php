<?php
    if(!defined("__ZBXE__")) exit();

    /**
    * @file Right Click.addon.php
    * @author SMaker (dowon2308@paran.com)
    * @brief jQuery Right Click Plugin
    **/
		if(Context::get('module')) return;

		// Addon Called Position
		if(Context::getResponseMethod()!='HTML') return;
		if($called_position != 'before_module_proc') return;

		// Addon Setting Check
		if(!$addon_info->disable_target || !in_array($addon_info->disable_target,array('a','img','btn','img_btn','img_btn_link','document'))) $addon_info->disable_target = 'document';
		if(!$addon_info->allow_admin) $addon_info->allow_admin = 'Y';
		if(!$addon_info->defend_altoolbar) $addon_info->defend_altoolbar = 'Y';
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
			if($addon_info->require_point || $addon_info->require_level) {
				// Get Point
				$Point = $oPointModel->getPoint($logged_info->member_srl);
			}

			if($addon_info->require_level) {
				// Get Level
				$oModuleModel = &getModel('module');
				$config = $oModuleModel->getModuleConfig('point');
				$Level = $oPointModel->getLevel($Point, $config->level_step);
			}

			if($addon_info->require_group) {
				// Get Group
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

		// jQuery Right-Click JS Plugin
		Context::addJsFile('./addons/Right-Click/js/jquery.rightClick.js');
		Context::addJsFile('./addons/Right-Click/js/Right-Click-min.js');

		// Right-Click Start
		$script_code = '<script type="text/javascript">startRightClick(%s)</script>';

		// Defend the ALTOOLBAR
		if($addon_info->defend_altoolbar == 'Y') {
			Context::addBodyHeader('<div id="Right-Click">');
			Context::addHtmlFooter('</div>');
		}
		Context::addHtmlHeader(sprintf($script_code,$addon_info->disable_target));
?>