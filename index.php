<?php
	
	if(isset($_REQUEST["resize"])){		
		require_once 'imgresize/ThumbLib.inc.php';
		
		//Rename
		if(isset($_REQUEST["rename"]) && !empty($_REQUEST["rename"])){
			$name = $_REQUEST["rename"];
		}else{
			$name = time();
		}
		
		//Image size
		if(isset($_REQUEST["width"]) && !empty($_REQUEST["width"])){
			$width = $_REQUEST["width"];
		}else{
			$width = 100;
		}
		if(isset($_REQUEST["height"]) && !empty($_REQUEST["height"])){
			$height = $_REQUEST["height"];
		}else{
			$height = 100;
		}
		
		//Counter
		if(isset($_REQUEST["counter"]) && !empty($_REQUEST["counter"])){
			$counter = $_REQUEST["counter"];
		}else{
			$counter = 0;
		}
		
		//Resize up
		if(isset($_REQUEST["resizeup"])){
			$options = array('resizeUp' => true);
		}else{
			$options = array();
		}
		
		//Adaptive resize
		if(isset($_REQUEST["adaptive_resize"])){
			$adaptive = true;
		}else{
			$adaptive = false;
		}
		
		//Get the images
		$images = glob("in/*.jpg");
		foreach($images as $image){
			$img = PhpThumbFactory::create($image, $options);
			if($adaptive){
            	$img->adaptiveResize($width, $height);
			}else{
				$img->resize($width, $height);
			}
            $filename = $name.$counter.".jpg";
            $img->save("out/".$filename, "jpg");
			$counter++;
		}
				
		include "assets/end.html";	
	}else{
		include "assets/interface.html";	
	}