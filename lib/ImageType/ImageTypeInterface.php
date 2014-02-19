<?php
/**
 * An interface to force consistency between different image formats
 *
 * @package \ThatChrisR\Imagen
 * @author Christopher Rolfe christopher.rolfe198@gmail.com
 */

namespace ThatChrisR\Imagen\ImageType;

/**
 * An interface to force consistency between different image formats
 */
interface ImageTypeInterface
{
	/**
	 * Creates an image resource that can be manipulated
	 *
	 * @param string $image The file type for an image, the result of pathinfo
	 *
	 * @return resource $image an image resource, something created using imagecreatefrompng or similar
	 */
	public function create_image($image);
}