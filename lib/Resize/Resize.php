<?php
/**
 * Handles resizing objects
 *
 * The ideal way this should work is that classes should be chained, E.G. $newImage->width(700)->height(20)->resize();
 *
 * @package \ThatChrisR\Imagen
 * @author Christopher Rolfe christopher.rolfe198@gmail.com
 */

namespace ThatChrisR\Imagen\Resize;

use ThatChrisR\Imagen\Base\BaseImage;

/**
 * Handles resizing of images
 */
class Resize
{
	/**
	 * An image resource
	 */
	private $image;

	/**
	 * The current width of the image
	 */
	private $width;

	/**
	 * The current height of the image
	 */
	private $height;

	/**
	 * Sets up the variables
	 *
	 * @param BaseImage $image An image created using the base image class
	 */
	public function __construct(BaseImage $image)
	{
		$this->image = $image->get_image_resource();
		$this->height = $image->get_image_height();
		$this->width = $image->get_image_width();
	}

	/**
	 * Carry out the resize
	 */
	public function resize($width, $height)
	{
		$newHeight = $height;
		$newWidth = $width;

		// Create a new image resource with the new height
		$newImage = imagecreatetruecolor($this->newWidth, $this->newHeight);

		// Bend the old and the new
		imagecopyresampled($newImage, $this->image, 0, 0, 0, 0, $this->newWidth, $this->newHeight, $this->width, $this->height);

		return $newImage;
	}
}