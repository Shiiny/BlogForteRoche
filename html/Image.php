<?php

namespace blog\html;

class Image{
	private static $dir = "../public/images/upload/";
	private static $auth_ext = ['jpg', 'jpeg', 'png', 'gif'];
	private static $ext;
	private static $img;

	static function addImage($img_name) {
		self::$img = $img_name;
		self::$ext = strtolower(pathinfo(self::$img['name'], PATHINFO_EXTENSION));
		$file_name = uniqid() . '.' . self::$ext;

		if(in_array(self::$ext, self::$auth_ext)) {
			move_uploaded_file(self::$img['tmp_name'], self::$dir . $file_name);
			self::thumbnail(self::$dir . $file_name, self::$dir . "/thumbnail/", $file_name, 215, 112);
			return $file_name;
		}
		else {
			return false;
		}
	}

	static function getImage($img_name) {
		if($img_name != null) {
			return $photo = self::$dir . $img_name;
		}
		else {
			return false;
		}
	}

	static function thumbnail($src, $dest, $name, $max_width = 300, $max_height = 100){
		$name = explode('.', $name);
		list($width, $height) = getimagesize($src);

		if(self::$ext == "jpg" || self::$ext == 'jpeg'){
			$image = imagecreatefromjpeg($src);
		}
		else if(self::$ext == "png"){
			$image = imagecreatefrompng($src); 
		}
		else if(self::$ext == "gif"){
			$image = imagecreatefromgif($src);
		}
		else{
			return false;
		}
		
		// Création des thumbnails
		$thumbnail = imagecreatetruecolor($max_width, $max_height);
		imagecopyresampled($thumbnail, $image, 0, 0, 0, 0, $max_width, $max_height, $width, $height);
		imagejpeg($thumbnail, $dest ."/". $name[0] ."_min.jpg", 90);
		return true;
	}
}

?>
