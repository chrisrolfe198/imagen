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
		$this->image = $image->get_image_resource();
	}

	public function add_image($image)
	{
		if (!$this->_is_base_image($image)) {
			$image = new BaseImage($image);
		}

		// Base variables, should be removed completely when the class is ready
		$src_w = $image->get_image_width();
		$src_h = $image->get_image_height();
		$src_x = 0;
		$src_y = 0;
		$dst_x = 0;
		$dst_y = 0;
		$src_im = $image->get_image_resource();
		$dst_im = $this->image;

		// Copying alpha layers
		// creating a cut resource 
        $cut = imagecreatetruecolor($src_w, $src_h);

        // copying relevant section from background to the cut resource 
        imagecopy($cut, $dst_im, 0, 0, $dst_x, $dst_y, $src_w, $src_h); 
        
        // copying relevant section from watermark to the cut resource 
        imagecopy($cut, $src_im, 0, 0, $src_x, $src_y, $src_w, $src_h); 

        // Merging
		imagecopymerge(
			$this->image, 			// Image to overlay image onto
			$cut,					// Overlay image
			0,						// X position on the destination
			0,						// Y position on the destination
			0,						// X position from the source
			0,						// Y position from the source
			$image->get_image_height(),	// Source width
			$image->get_image_width(),	// Source height
			100						// opacity, scale of 0-100
			);
		return $this->image;
	}

	private function _is_base_image($image)
	{
		if (is_a($image, 'ThatChrisR\Imagen\Base\BaseImage')) {
			return true;
		}
		
		return false;
	}
}