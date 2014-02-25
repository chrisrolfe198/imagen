<?php
/**
 * A class that implents the ImageTypeInterface in order to handle images with the jpg extension
 */

namespace ThatChrisR\Imagen\ImageType;

use ThatChrisR\Imagen\ImageType\ImageTypeInterface;

/**
 * A class that implents the ImageTypeInterface in order to handle images with the jpg extension
 */
class JpgTypeImage implements ImageTypeInterface
{

	/**
	 * Creates an image resource using the gd jpg function
	 */
	public function create_image($image)
	{
		return imagecreatefromjpeg($image);
	}

}