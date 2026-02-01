<?php

    if(!defined("__ZBXE__")) exit();

    /**
     * @JpgResize.addon.php
     * @author 카르마(http://www.wildgreen.co.kr)
     * @brief 이미지 크기조절 addon
     *
     **/

require_once "JpgResize.class.php";

if($called_position == 'after_module_proc' && Context::get('act') == 'procFileUpload') {
            if(!$addon_info->target_size) $addon_info->target_size=1024;
            $target_size=$addon_info->target_size;
            $file_srl = $output->get('file_srl');
            $file = $output->get('uploaded_filename');
            $s_file = $output->get('source_filename');
            $quality = $addon_info->quality;
			if($quality>100) $quality = 100;
            if(!$quality) $quality =80;

            $file_names=explode(".",$s_file);
            $num=count($file_names);
//            $newfile = str_replace($s_file,"_Xe_resized".$s_file,$file);

            if($num>0) {
                $ext=strtolower($file_names[$num-1]);

                if($ext=='jpg' || $ext=='jpeg') {
                    list($image_width, $image_height)=getimagesize($file);

                    if($addon_info->target_width == 'Y') {
                        if($image_width>$target_size) {
                        $new_width = $target_size;
                        $new_height=round($image_height*$target_size/$image_width);
						JpgResize::createResizeFile($file, $new_width , $new_height, $quality);
//						if(file_exists($newfile)) @rename($newfile,$file);
						} 
					} elseif($image_width>$target_size || $image_height>$target_size) {
                	    if($image_width>$image_height) {
                    	    $new_width = $target_size;
                        	$new_height=round($image_height*$target_size/$image_width);
	                    } else {
    	                    $new_height = $target_size;
        	                $new_width = round($image_width*$target_size/$image_height);
            	        }
				        JpgResize::createResizeFile($file, $new_width , $new_height, $quality);
//						if(file_exists($newfile)) @rename($newfile,$file);
					} 
					$fr->file_srl = $file_srl;
                    $fr->file_size = filesize($file);
                    $fileupdate = executeQuery('addons.JpgResize.updateFileSize', $fr);
					$water = $addon_info->watermark;
					if($water && preg_match("/\.(png)$/i", $water) && file_exists(realpath($water))) JpgResize::AlphaWatermark($file,$water,$addon_info->position);
				}
			}

}
?>
