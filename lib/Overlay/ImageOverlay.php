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
	/**
	 * Instance of BaseImage holding the background image
	 */
	private $image;

	/**
	 * The image resource of the background, same resource as you would get if used imagecreatefrompng
	 */
	private $imageResource;

	/**
	 * Loads up the background image and resource into local variables
	 */
	public function __construct(BaseImage $image)
	{
		$this->imageResource = $image->get_image_resource();
		$this->image = $image;
	}
	/**
	 * Overlays the image passed in
	 * @param mixed   $imageToOverlay Either a path to an image or an instance of BaseImage
	 * @param integer $xpos
	 * @param integer $ypos
	 * @return image resource The image with the appropriate image overlayed
	 */
	public function add_image($imageToOverlay, $xpos = 0, $ypos = 0)
	{
		$imageToOverlay = $this->_create_base_image($imageToOverlay);

		// Base variables, should be removed completely when the class is ready
		$overlayHeight = $imageToOverlay->get_image_height();
		$overlayWidth = $imageToOverlay->get_image_width();
		$baseHeight = $this->image->get_image_height();
		$baseWidth = $this->image->get_image_width();

		// Create the positioning values for the overlay based on the percentages passed in
		$overlayXpos = $this->_calculate_percentage($baseWidth, $xpos, $overlayWidth);
		$overlayYpos = $this->_calculate_percentage($baseHeight, $ypos, $overlayHeight);

		$transparentImageToOverlay = $this->_create_transparent_overlay($imageToOverlay, $overlayXpos, $overlayYpos);

        // Merging
		try {
			$this->_merge_images($transparentImageToOverlay, $overlayHeight, $overlayWidth, $overlayXpos, $overlayYpos);
		} catch(Exception $e) {
			throw new Exception($e->getMessage(), 1);
		}

		return $this->imageResource;
	}

	/**
	 * Calculate's the position of an overlay based on a percentage
	 * @param  integer $orig
	 * @param  integer $newPercent
	 * @param  integer $newHeight
	 * @return integer
	 */
	private function _calculate_percentage($orig, $newPercent, $newHeight)
	{

		return (int) (($orig - $newHeight) * ($newPercent / 100));
	}

	/**
	 * Creates a proper overlay for transparent images
	 * @param  BaseImage $overlay
	 * @param  integer $xpos
	 * @param  integer $ypos
	 * @return image resource
	 */
	private function _create_transparent_overlay($overlay, $xpos, $ypos)
	{
		$src_w = $overlay->get_image_width();
		$src_h = $overlay->get_image_height();

		$dst_im = $this->image->get_image_resource();
		$src_im = $overlay->get_image_resource();

		// creating a cut resource 
        $cut = imagecreatetruecolor($src_w, $src_h);

        // copying relevant section from background to the cut resource 
        imagecopy($cut, $dst_im, 0, 0, $xpos, $ypos, $src_w, $src_h); 
        
        // copying relevant section from watermark to the cut resource 
        imagecopy($cut, $src_im, 0, 0, 0, 0, $src_w, $src_h);

        return $cut;
	}

	/**
	 * Creates an instance of BaseImage or returns the item if it is already one
	 * @param  mixed $image
	 * @return BaseImage
	 */
	private function _create_base_image($image)
	{
		if (is_a($image, 'ThatChrisR\Imagen\Base\BaseImage')) {
			return $image;
		}
		
		return new BaseImage($image);
	}

	/**
	 * Merges images together
	 * @param  image resource $imageToOverlay
	 * @param  integer $overlayWidth
	 * @param  integer $overlayHeight
	 * @param  integer $xpos
	 * @param  integer $ypos
	 */
	private function _merge_images($imageToOverlay, $overlayWidth, $overlayHeight, $xpos, $ypos)
	{
		if ($overlayHeight > $this->image->get_image_height() || $overlayWidth > $this->image->get_image_width()) {
			throw new Exception("Overlay image is larger than the background", 1);
		}

		imagecopymerge(
			$this->imageResource,	// Image to overlay image onto
			$imageToOverlay,		// Overlay image
			$xpos,					// X position on the destination
			$ypos,					// Y position on the destination
			0,						// X position from the source
			0,						// Y position from the source
			$overlayHeight,			// Source width
			$overlayWidth,			// Source height
			100						// opacity, scale of 0-100
			);
	}
}