<?php
/**
 * Overlays text
 *
 * @package \ThatChrisR\Imagen
 * @author Christopher Rolfe christopher.rolfe198@gmail.com
 */

namespace ThatChrisR\Imagen\Overlay;

/**
 * Handles overlaying text
 */
class TextOverlay
{
	/**
	 * An array to handle fonts
	 */
	public static $fonts = array();

	/**
	 * An array to handle the text colours
	 */
	public static $colours = array();

	/**
	 * Adds a font to the fonts array
	 */
	public static function add_font($font) {
		array_push(self::$fonts, $font);
	}

	/**
	 * Adds a colour to the colours array
	 */
	public static function add_colour($colour) {
		array_push(self::$colours, $colour);
	}
}