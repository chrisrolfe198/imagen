<?php
/**
 * Overlays images onto other images
 *
 * @package \ThatChrisR\Imagen
 * @author Christopher Rolfe christopher.rolfe198@gmail.com
 */

namespace ThatChrisR\Imagen\Overlay;

use ThatChrisR\Imagen\Base\BaseImage;
use \Exception;

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

	/**
	 * Overlays the image passed in
	 */
	public function add_image($imageToOverlay)
	{
		$imageToOverlay = $this->_create_base_image($imageToOverlay);

		// Base variables, should be removed completely when the class is ready
		$overlayHeight = $imageToOverlay->get_image_width();
		$overlayWidth = $imageToOverlay->get_image_height();

		$transparentImageToOverlay = $this->_create_transparent_overlay($imageToOverlay, $this->image);

        // Merging
		try {
			$this->_merge_images($transparentImageToOverlay, $overlayHeight, $overlayWidth);
		} catch(Exception $e) {
			throw new Exception($e->getMessage(), 1);
		}

		return $this->imageResource;
	}

	private function _create_transparent_overlay($overlay, $background)
	{
		$src_w = $overlay->get_image_width();
		$src_h = $overlay->get_image_height();

		$dst_im = $background->get_image_resource();
		$src_im = $overlay->get_image_resource();

		// creating a cut resource 
        $cut = imagecreatetruecolor($src_w, $src_h);

        // copying relevant section from background to the cut resource 
        imagecopy($cut, $dst_im, 0, 0, 0, 0, $src_w, $src_h); 
        
        // copying relevant section from watermark to the cut resource 
        imagecopy($cut, $src_im, 0, 0, 0, 0, $src_w, $src_h);

        return $cut;
	}

	private function _create_base_image($image)
	{
		if (is_a($image, 'ThatChrisR\Imagen\Base\BaseImage')) {
			return $image;
		}
		
		return new BaseImage($image);
	}

	private function _merge_images($imageToOverlay, $overlayWidth, $overlayHeight)
	{
		// Validation here?
		if ($overlayHeight > $this->image->get_image_height() && $overlayWidth > $this->image->get_image_width()) {
			throw new Exception("Overlay image is larger than the background", 1);
		}

		imagecopymerge(
			$this->imageResource,	// Image to overlay image onto
			$imageToOverlay,		// Overlay image
			0,						// X position on the destination
			0,						// Y position on the destination
			0,						// X position from the source
			0,						// Y position from the source
			$overlayHeight,			// Source width
			$overlayWidth,			// Source height
			100						// opacity, scale of 0-100
			);
	}
}