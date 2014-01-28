<?php

namespace ThatChrisR\Image\Base;

use ThatChrisR\Image\ImageType\ImageTypeFactory;

class BaseImage
{

	private $_image;
	protected $_height;
	protected $_width;

	/**
	 * Creates our basic image and grabs the height and width
	 */
	public function __construct($imagePath)
	{
		$this->_image = $this->_get_image($imagePath);
		$this->_width = imagesx($this->_image);
		$this->_height = imagesy($this->_image);
	}

	/**
	 * Simple getter to return the image height
	 */
	public function get_image_height()
	{
		return $this->_height;
	}
	
	/**
	 * Simple getter to return the image width
	 */
	public function get_image_width()
	{
		return $this->_width;
	}

	/**
	 * Creates an image from the factory and returns the image resource
	 */
	private function _get_image($imagePath)
	{
		// Create our factory and get a class that can instantiate the image
		$imageFactory = new ImageTypeFactory();
		$imageType = $imageFactory::create(pathinfo($imagePath, PATHINFO_EXTENSION));
		// Because the class implements our interface we know it has a create image method
		$image = $imageType->create_image($imagePath);
		return $image;
	}
}