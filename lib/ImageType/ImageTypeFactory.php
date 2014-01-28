<?php

namespace ThatChrisR\Imagen\ImageType;

use ThatChrisR\Imagen\ImageType\PngTypeImage;
use ThatChrisR\Imagen\ImageType\GifTypeImage;
use \Exception as Exception;

class ImageTypeFactory
{
	// TODO: Why is this even needed? Surely my use statements should handle this?
	public static $namespace = 'ThatChrisR\Imagen\ImageType\\';

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