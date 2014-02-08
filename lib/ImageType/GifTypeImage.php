<?php
/**
 * A class that implents the ImageTypeInterface in order to handle images with the gif extension
 */

namespace ThatChrisR\Imagen\ImageType;

use ThatChrisR\Imagen\ImageType\ImageTypeInterface;

/**
 * A class that implents the ImageTypeInterface in order to handle images with the gif extension
 */
class GifTypeImage implements ImageTypeInterface
{

	/**
	 * Creates an image resource using the gd gif function
	 */
	public function create_image($image)
	{
		return imagecreatefromgif($image);
	}

}