<?php

namespace ThatChrisR\Imagen\ImageType;

use ThatChrisR\Imagen\ImageType\ImageTypeInterface;

class GifTypeImage implements ImageTypeInterface
{

	public function create_image($image)
	{
		return imagecreatefromgif($image);
	}

}