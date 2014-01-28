<?php

namespace ThatChrisR\Imagen\ImageType;

class PngTypeImage implements ImageTypeInterface
{

	public function create_image($image)
	{
		return imagecreatefrompng($image);
	}

}