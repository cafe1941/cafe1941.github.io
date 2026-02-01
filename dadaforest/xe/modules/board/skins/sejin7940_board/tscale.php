<?php
	if(!$size) $size=200;
	if(!$scale) $scale=0.6;
//	$tscale1=$tscale2=$tscale3=$tscale4=$tscale5=10;
	
	$image = ImageCreateTrueColor($size*$scale+5,$size*$scale+5);  // 이미지 생성
	$color_black=ImageColorAllocate ($image,0x00,0x00,0x00);  // 검정색을 설정
	$color_gray=ImageColorAllocate ($image,153,153,153);  // 검정색을 설정
	$color_white=ImageColorAllocate ($image,0xff,0xff,0xff);  // 흰색을 설정
	$color_pink=ImageColorAllocate ($image,239,55,125);  // 흰색을 설정
	ImageFill($image,0,0,$color_white);

	$coor0_y = $coor0_x = ($size/2) * $scale;
	$coor1_x = ($size/2) * $scale;
	$coor1_y = ($size/2-($size/20*10)) * $scale;
	$coor2_x = ($size/2+(9.5*10) ) *$scale;
	$coor2_y = ($size/2-(($size/20-7.5)*10)) * $scale;
	$coor3_x = ($size/2+(($size/20-4.5)*10)) * $scale;
	$coor3_y = ($size/2+(8.3*10)) * $scale;
	$coor4_x = ($size/2-(($size/20-4.5)*10)) *$scale;
	$coor4_y = ($size/2+(8.3*10)) *$scale;
	$coor5_x = ($size/2-(9.5*10)) *$scale;
	$coor5_y = ($size/2-(($size/20-7.5)*10)) *$scale;

	ImageArc ($image, 100*$scale, 100*$scale, 200*$scale, 200*$scale, 200*$scale, 200*$scale, $color_gray); // ImageArc (이미지 구분자, X좌표, Y좌표, 폭, 높이, 시작위치, 종료위치, 색 구분자); 

	ImageLine($image,$coor0_x,$coor0_y,$coor1_x,$coor1_y,$color_gray);
	ImageLine($image,$coor0_x,$coor0_y,$coor2_x,$coor2_y,$color_gray);
	ImageLine($image,$coor0_x,$coor0_y,$coor3_x,$coor3_y,$color_gray);
	ImageLine($image,$coor0_x,$coor0_y,$coor4_x,$coor4_y,$color_gray);
	ImageLine($image,$coor0_x,$coor0_y,$coor5_x,$coor5_y,$color_gray);


	$coor1_x = ($size/2) * $scale;
	$coor1_y = ($size/2-($size/20*$tscale1)) * $scale;
	$coor2_x = ($size/2+(9.5*$tscale2) ) *$scale;
	$coor2_y = ($size/2-(($size/20-7.5)*$tscale2)) * $scale;
	$coor3_x = ($size/2+(($size/20-4.5)*$tscale3)) * $scale;
	$coor3_y = ($size/2+(8.3*$tscale3)) * $scale;
	$coor4_x = ($size/2-(($size/20-4.5)*$tscale4)) *$scale;
	$coor4_y = ($size/2+(8.3*$tscale4)) *$scale;
	$coor5_x = ($size/2-(9.5*$tscale5)) *$scale;
	$coor5_y = ($size/2-(($size/20-7.5)*$tscale5)) *$scale;

	$xy=array($coor1_x,$coor1_y,$coor2_x,$coor2_y,$coor3_x,$coor3_y,$coor4_x,$coor4_y,$coor5_x,$coor5_y);  // 좌표 배열의 생성
	ImagePolygon($image,$xy,5,$color_pink);   // 꼭지점이 5개인 다각형 그리기


	ImageFill($image,$coor0_x+10,$coor0_y+10,$color_pink);
	ImageFill($image,$coor0_x+10,$coor0_y-10,$color_pink);
	ImageFill($image,$coor0_x-10,$coor0_y+10,$color_pink);
	ImageFill($image,$coor0_x-10,$coor0_y-10,$color_pink);
	ImageFill($image,$coor0_x,$coor0_y+10,$color_pink);

	ImageGif($image);   // 이미지 출력
	ImageDestroy($image);   // 메모리에서 이미지 제거

?>