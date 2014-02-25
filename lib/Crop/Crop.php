<?php
/**
 * Handles the cropping of objects
 *
 * @package \ThatChrisR\Imagen
 * @author Christopher Rolfe christopher.rolfe198@gmail.com
 */

namespace ThatChrisR\Imagen\Crop;

use ThatChrisR\Imagen\Base\BaseImage;

/**
 * Handles cropping of images
 */
class Crop
{
	private $image;

	public function __construct(BaseImage $image)
	{
		$this->image = $image;
	}

	public function crop($newWidth, $newHeight)
	{
		$optimalWidth = $this->image->get_image_width();
		$optimalHeight = $this->image->get_image_height();
		// Find the center for the crop
		$cropStartX = ( $optimalWidth / 2) - ( $newWidth /2 );
		$cropStartY = ( $optimalHeight / 2) - ( $newHeight/2 );

		// Create a resource to hold the current image
		$currentImage = $this->image->get_image_resource();

		// Create a new resource to hold the crop
		$newImage = imagecreatetruecolor($newWidth , $newHeight);
		imagecopyresampled($newImage, $currentImage, 0, 0, $cropStartX, $cropStartY, $newWidth, $newHeight , $newWidth, $newHeight);

		return $newImage;
	}
}