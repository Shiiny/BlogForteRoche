<?php

namespace blog\html;

class Image{
	private static $dir = "../public/images/";
	private static $auth_ext = ['jpg', 'jpeg', 'png', 'gif'];
	private static $ext;
	private static $img;

	static function addImage($img_name) {
		self::$img = $img_name;
		var_dump(self::$img);

		self::$ext = strtolower(pathinfo(self::$img['name'], PATHINFO_EXTENSION));
		var_dump(self::$ext);

		$file_name = uniqid() . '.' . self::$ext;

		var_dump($file_name);

		if(in_array(self::$ext, self::$auth_ext)) {
			move_uploaded_file(self::$img['tmp_name'], self::$dir . $file_name);
			self::thumbnail(self::$dir . $file_name, self::$dir . "/thumbnail/", $file_name, 215, 112);
			return $file_name;
		}
		else {
			return false;
		}
	}

	static function thumbnail($src, $dest, $name, $max_width = 300, $max_height = 100){
		// On explose le nom du fichier
		$name = explode('.', $name);

		// On récupère les dimensions de l'image
		list($width, $height) = getimagesize($src);

		// On crée une image à partir du fichier récup
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
		// On crée une image vide
		$thumbnail = imagecreatetruecolor($max_width, $max_height);

		// on copie et redimensionne l'image
		imagecopyresampled($thumbnail, $image, 0, 0, 0, 0, $max_width, $max_height, $width, $height);
		// On sauvegarde la miniature
		imagejpeg($thumbnail, $dest ."/". $name[0] ."_min.jpg", 90);
		return true;
	}
}

?>
