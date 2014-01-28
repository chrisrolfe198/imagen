<?php

namespace ThatChrisR\Imagen\ImageType;

interface ImageTypeInterface
{
	/**
	 * @return resource 	an image resource, something created using imagecreatefrompng or similar
	 */
	public function create_image($image);
}