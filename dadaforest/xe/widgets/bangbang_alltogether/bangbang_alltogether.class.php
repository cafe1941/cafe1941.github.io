<?php
    /**
     * @class bangbang_alltogether
     * @author zirho6 (zirho6@nate.com)
     * @brief 회전목마 형식으로 첨부 이미지를 보여주는 모듈
     * @version 0.1
     **/

    class bangbang_alltogether extends WidgetHandler {

        /**
         * @brief 위젯의 실행 부분
         *
         * ./widgets/위젯/conf/info.xml 에 선언한 extra_vars를 args로 받는다
         * 결과를 만든후 print가 아니라 return 해주어야 한다
         **/
       
        function proc($args) {
			
            $ba_widget_count = Context::get('ba_widget_count');
			$ba_widget_count = $ba_widget_count + 1;

			// default vals
			$args->thumbnail_type = isset($args->thumbnail_type) ? $args->thumbnail_type : 'ratio';
			$args->shuffling = isset($args->shuffling) ? $args->shuffling : "true";

			$args->pause_on_hover = isset($args->pause_on_hover) ? $args->pause_on_hover : "true";

			$args->canvas_width = isset($args->canvas_width) ? (int)$args->canvas_width : 23;
			$args->canvas_height = isset($args->canvas_height) ? (int)$args->canvas_height : 10;

			$args->thumb_width = isset($args->thumb_width) ? (int)$args->thumb_width : 7;
			$args->thumb_height = isset($args->thumb_height) ? (int)$args->thumb_height : 7;

			$args->images_num = isset($args->images_num) ? (int)$args->images_num : 7;
			$args->focusBearing = isset($args->focusBearing) ? $args->focusBearing : "0.0";

			$args->shape = isset($args->shape) ? $args->shape : 'lazySusan';
			$args->sliding_effect = isset($args->sliding_effect) ? $args->sliding_effect : 'easeInOutExpo';

			$args->transition_interval = isset($args->transition_interval) ? (int)$args->transition_interval : 3000;
			$args->transition_speed = isset($args->transition_speed) ? (int)$args->transition_speed : 900;

			$args->clickable = isset($args->clickable) ? $args->clickable : "true";
			
            // query args
			$query_args->module_srls = $args->module_srls;
			$query_args->direct_download = 'Y';
            $query_args->isvalid = 'Y';
            if($args->shuffling == "true") $query_args->list_order = 'rand()';
			$query_args->list_count = $args->images_num;
						
            // get file list
            $files_output = executeQueryArray("widgets.bangbang_alltogether.getImages", $query_args);
			unset($query_args);

			$document_srl_list = array();
            $document_list = array();
			
			if($files_output->data) foreach($files_output->data as $val){ $document_srl_list[] = $val->document_srl; }
			
			unset($files_output);
				
    		if($document_srl_list) {
		        $oDocumentModel = &getModel('document');
				$tmp_document_list = $oDocumentModel->getDocuments($document_srl_list);
				foreach($tmp_document_list as $val) $document_list[] = $val;
				unset($oDocumentModel);
				unset($tmp_document_list);

				//shuffle
				if($args->shuffling == "true") shuffle($document_list);
				$args->document_list = $document_list;
			}

			$args->theme_path = sprintf('%sskins/%s', $this->widget_path, $args->skin);

            Context::set('ba_widget_count', $ba_widget_count);
            Context::set('widget_vals', $args);

            // skin
            $tpl_path = sprintf('%sskins/%s', $this->widget_path, $args->skin);
            $tpl_file = 'list';
            $oTemplate = &TemplateHandler::getInstance();
            $output = $oTemplate->compile($tpl_path, $tpl_file);

            return $output;
        }
    }
?>