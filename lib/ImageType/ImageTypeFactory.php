<?php

/**
 * Factory to create an image class based on its file type
 *
 * @package \ThatChrisR\Imagen
 * @author Christopher Rolfe christopher.rolfe198@gmail.com
 */

namespace ThatChrisR\Imagen\ImageType;

use ThatChrisR\Imagen\ImageType\PngTypeImage;
use ThatChrisR\Imagen\ImageType\GifTypeImage;
use \Exception as Exception;

/**
 * Factory class used to create an image class
 */
class ImageTypeFactory
{
	/**
	 * Puts the namespace into a variable
	 *
	 * @todo Why is this even needed? Surely my use statements should handle this?
	 */
	public static $namespace = 'ThatChrisR\Imagen\ImageType\\';

	/**
	 * The function to create an image if it can otherwise throws an exception
	 *
	 * @param string $type The file type for an image, the result of pathinfo
	 * @return PngTypeImage|GifTypeImage|Exception The image class or an exception if the class isn't found
	 */
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