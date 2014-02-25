<?php
/**
 * Overlays images onto other images
 *
 * @package \ThatChrisR\Imagen
 * @author Christopher Rolfe christopher.rolfe198@gmail.com
 */

namespace ThatChrisR\Imagen\Overlay;

use ThatChrisR\Imagen\Base\BaseImage;

/**
 * Handles overlaying images, this can be useful for things like watermarking
 */
class ImageOverlay
{
	private $image;

	public function __construct(BaseImage $image)
	{
		$this->imageResource = $image->get_image_resource();
		$this->image = $image;
	}

	public function add_image($image)
	{
		if (!$this->_is_base_image($image)) {
			$image = new BaseImage($image);
		}

		// Base variables, should be removed completely when the class is ready
		$overlayHeight = $image->get_image_width();
		$overlayWidth = $image->get_image_height();

		$image = $this->_create_alpha_layer($image, $this->image);

        // Merging
		imagecopymerge(
			$this->imageResource, 	// Image to overlay image onto
			$image,					// Overlay image
			0,						// X position on the destination
			0,						// Y position on the destination
			0,						// X position from the source
			0,						// Y position from the source
			$overlayHeight,			// Source width
			$overlayWidth,			// Source height
			100						// opacity, scale of 0-100
			);
		return $this->imageResource;
	}

	private function _create_alpha_layer($overlay, $background)
	{
		$src_w = $overlay->get_image_width();
		$src_h = $overlay->get_image_height();
		$dst_x = 0;
		$dst_y = 0;
		$src_x = 0;
		$src_y = 0;

		$dst_im = $background->get_image_resource();
		$src_im = $overlay->get_image_resource();

		// creating a cut resource 
        $cut = imagecreatetruecolor($src_w, $src_h);

        // copying relevant section from background to the cut resource 
        imagecopy($cut, $dst_im, 0, 0, $dst_x, $dst_y, $src_w, $src_h); 
        
        // copying relevant section from watermark to the cut resource 
        imagecopy($cut, $src_im, 0, 0, $src_x, $src_y, $src_w, $src_h); 

        return $cut;
	}

	private function _is_base_image($image)
	{
		if (is_a($image, 'ThatChrisR\Imagen\Base\BaseImage')) {
			return true;
		}
		
		return false;
	}
}