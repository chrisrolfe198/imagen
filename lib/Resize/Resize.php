<?php

namespace ThatChrisR\Imagen\Resize;

class Resize
{
	public function image(BaseImage $image)
	{
		$this->image = $image;
	}

	public function width($width)
	{
		$this->width = $width;
	}

	public function height($height)
	{
		$this->height = $height;
	}

	public function resize()
	{
		if (($this->height) and ($this->width)) {
			$newHeight = $this->height;
			$newWidth = $this->width;
		}
	}
}

// Resize->image($resource)->width('300')->resize();