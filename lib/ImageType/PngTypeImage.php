<?php

namespace ThatChrisR\Image\ImageType;

class PngTypeImage implements ImageTypeInterface
{

	public function create_image($image)
	{
		return imagecreatefrompng($image);
	}

}