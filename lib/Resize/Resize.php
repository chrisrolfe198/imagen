<?php

namespace ThatChrisR\Imagen\Resize;

use ThatChrisR\Imagen\Base\BaseImage;

class Resize
{
	private $image;
	private $width;
	private $height;

	public function image(BaseImage $image)
	{
		$this->image = $image;
		$this->height = $image->get_image_height();
		$this->width = $image->get_image_width();
	}

	public function width($width)
	{
		$this->newWidth = $width;
	}

	public function height($height)
	{
		$this->newHeight = $height;
	}

	public function resize()
	{
		// *** Resample - create image canvas of x, y size
		$newImage = imagecreatetruecolor($this->newWidth, $this->newHeight);

		imagecopyresampled($newImage, $this->image, 0, 0, 0, 0, $this->newWidth, $this->newHeight, $this->width, $this->height);

		return $newImage;
	}
}

// Resize->image($resource)->width('300')->resize();