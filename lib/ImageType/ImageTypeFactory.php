<?php

namespace ThatChrisR\Image\ImageType;

use ThatChrisR\Image\ImageType\PngTypeImage;
use ThatChrisR\Image\ImageType\GifTypeImage;
use \Exception as Exception;

class ImageTypeFactory
{
	public static $namespace = 'ThatChrisR\Image\ImageType\\';

	public static function create($type)
	{
		$type = ucfirst(strtolower($type));
		$image = self::$namespace . $type . "TypeImage";

		if (class_exists($image)) {
			return new $image();
		} else {
			throw new Exception("Invalid image type given of ".$image);
		}
	}
}