<?php
    class JpgResize {

        function createResizeFile($source_file, $resize_width = 0, $resize_height = 0, $quality=80) {
            $source_file = FileHandler::getRealPath($source_file);

            if(!file_exists($source_file)) return;
            if(!$resize_width) $resize_width = 100;
            if(!$resize_height) $resize_height = $resize_width;

            // retrieve source image's information
            $imageInfo = getimagesize($source_file);
            if(!FileHandler::checkMemoryLoadImage($imageInfo)) return false;
            list($width, $height, $type, $attrs) = $imageInfo;

            if($width<1 || $height<1) return;

			if($type !=2) return false;

            // if original image is larger than specified size to resize, calculate the ratio
            if($resize_width > 0 && $width >= $resize_width) $width_per = $resize_width / $width;
            else $width_per = 1;

            if($resize_height>0 && $height >= $resize_height) $height_per = $resize_height / $height;
            else $height_per = 1;

            if($width_per>$height_per) $per = $height_per;
            else $per = $width_per;
            $resize_width = $width * $per;
            $resize_height = $height * $per;

            if(!$per) $per = 1;

            // create temporary image with target size
            if(function_exists('imagecreatetruecolor')) $thumb = @imagecreatetruecolor($resize_width, $resize_height);
            else $thumb = @imagecreate($resize_width, $resize_height);

            $white = @imagecolorallocate($thumb, 255,255,255);
            @imagefilledrectangle($thumb,0,0,$resize_width-1,$resize_height-1,$white);

            // create temporary image having original type
                        if(!function_exists('imagecreatefromjpeg')) return false;
                        $source = @imagecreatefromjpeg($source_file);

            // resize original image and put it into temporary image
            $new_width = (int)($width * $per);
            $new_height = (int)($height * $per);

                $x = 0;
                $y = 0;

            if($source) {
                if(function_exists('imagecopyresampled')) @imagecopyresampled($thumb, $source, $x, $y, 0, 0, $new_width, $new_height, $width, $height);
                else @imagecopyresized($thumb, $source, $x, $y, 0, 0, $new_width, $new_height, $width, $height);
            } else return false;

            // write into the file
                        if(!function_exists('imagejpeg')) return false;
                        $output = @imagejpeg($thumb, $source_file,$quality);

            @imagedestroy($thumb);
            @imagedestroy($source);

            if(!$output) return false;

            return true;
        }
   

		function AlphaWatermark($source_file,$water,$position) {
			$source_file = FileHandler::getRealPath($source_file);
			$water = FileHandler::getRealPath($water);

			// Load the stamp and the photo to apply the watermark to
			$stamp = @imagecreatefrompng($water);
			$im = @imagecreatefromjpeg($source_file);

			if(imagesx($stamp)*2 >imagesx($im) || imagesy($stamp)*2 >imagesy($im)) return false;
			if(!function_exists('imagejpeg')) return false;
			if(!function_exists('imagecopy')) return false;

			// Set the margins for the stamp and get the height/width of the stamp image
			$marge= 10;
			$sx = imagesx($stamp);
			$sy = imagesy($stamp);
			if($position=="RT") {$locax=imagesx($im) - $sx - $marge; $locay=$marge;}
			elseif($position=="CE") {$locax=(imagesx($im) - $sx)/2; $locay = (imagesy($im) - $sy)/2;}
			elseif($position=="LT") {$locax=$marge; $locay=$marge;}
			elseif($position=="LB") {$locax=$marge; $locay=imagesy($im) - $sy - $marge;}
			else {$locax =imagesx($im) - $sx - $marge; $locay=imagesy($im) - $sy - $marge;}

			// Copy the stamp image onto our photo using the margin offsets and the photo 
			// width to calculate positioning of the stamp. 
			imagecopy($im, $stamp, $locax, $locay, 0, 0, $sx, $sy);

			// Output and free memory
			$output= @imagejpeg($im,$source_file,100);
			@imagedestroy($im);

			if(!$output) return false;
	        return true;
		}
 
}
?>
