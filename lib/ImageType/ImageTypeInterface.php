<?php

namespace ThatChrisR\Image\ImageType;

interface ImageTypeInterface
{
	/**
	 * @return resource 	an image resource, something created using imagecreatefrompng or similar
	 */
	public function create_image($image);
}