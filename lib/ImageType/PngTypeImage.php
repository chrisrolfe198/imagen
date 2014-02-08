<?php
/**
 * A class that implents the ImageTypeInterface in order to handle images with the png extension
 */

namespace ThatChrisR\Imagen\ImageType;

/**
 * A class that implents the ImageTypeInterface in order to handle images with the png extension
 */
class PngTypeImage implements ImageTypeInterface
{

	/**
	 * Creates an image resource using the gd png function
	 */
	public function create_image($image)
	{
		return imagecreatefrompng($image);
	}

}