<?php
    /**
     * @class flowing_pictures
     * @author zirho6 (zirho6@nate.com)
     * @brief 선택된 모듈의 이미지를 흘러가는 형식으로 보여주는 위젯
     * @version 0.1
     **/

    class flowing_pictures extends WidgetHandler {

        /**
         * @brief 위젯의 실행 부분
         *
         * ./widgets/위젯/conf/info.xml 에 선언한 extra_vars를 args로 받는다
         * 결과를 만든후 print가 아니라 return 해주어야 한다
         **/
       
        function proc($args) {
			
            $fi_widget_count = Context::get('fi_widget_count');
			$fi_widget_count = $fi_widget_count + 1;

			// default vals
			$args->thumbnail_type = isset($args->thumbnail_type) ? $args->thumbnail_type : 'ratio';
			$args->shuffling = isset($args->shuffling) ? $args->shuffling : "false";
			$args->mouseoverstop = isset($args->mouseoverstop) ? $args->mouseoverstop : "true";
			$args->thumbnail_width = isset($args->thumbnail_width) ? (int)$args->thumbnail_width : 100;
			$args->thumbnail_height = isset($args->thumbnail_height) ? (int)$args->thumbnail_height : 100;
			$args->shown_image_num = isset($args->shown_image_num) ? (int)$args->shown_image_num : 3;

			$args->flowing_images_num = isset($args->flowing_images_num) ? (int)$args->flowing_images_num : 7;
			$args->controls = isset($args->controls) ? $args->controls : 'buttons';
			$args->sliding_effect = isset($args->sliding_effect) ? $args->sliding_effect : 'easeOutQuad';
			$args->auto_scroll_msec = isset($args->auto_scroll_msec) ? (int)$args->auto_scroll_msec : 3000;
			$args->scroll_speed = isset($args->scroll_speed) ? (int)$args->scroll_speed : 1000;

			$args->img_margin = isset($args->img_margin) ? (int)$args->img_margin : 0;
			$args->mouse_wheel = isset($args->mouse_wheel) ? $args->mouse_wheel : "true";
			$args->border_color = isset($args->border_color) ? $args->border_color : "transparent";
			$args->border_width = isset($args->border_width) ? (int)$args->border_width : 0;

			$args->title_visibility = isset($args->title_visibility) ? $args->title_visibility : "false";
			$args->title_length = isset($args->title_length) ? (int)$args->title_length : 14;
			$args->title_size = isset($args->title_size) ? $args->title_size : "10px";
			$args->title_color = isset($args->title_color) ? $args->title_color : "transparent";
			$args->title_font = isset($args->title_font) ? $args->title_font : "gulim";

            // query args
			$query_args->module_srls = $args->module_srls;
			$query_args->direct_download = 'Y';
            $query_args->isvalid = 'Y';
            if($args->shuffling == "true") $query_args->list_order = 'rand()';
			$query_args->list_count = $args->flowing_images_num;
						
            // get file list
            $files_output = executeQueryArray("widgets.flowing_pictures.getImages", $query_args);
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
            Context::set('fi_widget_count', $fi_widget_count);
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