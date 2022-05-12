<?php

namespace App\Helpers;

use URL;
use Image;

class FileUploadHelper {
	public static function compress_file($image,$paths){
		$mime = explode('/',$image->getMimeType());
		$mimetype = $mime[0];
		$path = $paths;
		if($mimetype == "image"){
			$name = time().uniqid().'.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/'.$path);
			$img = Image::make($image->getRealPath());
			$height = '600';
			$width = '600';
			$img->height() > $img->width() ? $width=null : $height=null;
			$img->resize($width, $height, function ($constraint) {
				$constraint->aspectRatio();
			})->save($destinationPath.'/'.$name);
			$destinationPath = public_path('/'.$path.'/original');
			$image->move($destinationPath, $name);
			$name = URL::to('/').'/'.$path.'/'.$name;
		}else{
			$name = $image->getClientOriginalName();
			$name = str_replace(" ", "", time() . $name);
			$image->move(public_path().'/' . $path, $name);
		}
		return $name;
	}
}
