<?php
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2010 Arno Dudek <webmaster@adgrafik.at>
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * Google Maps API class.
 * Nearly the same like the Google Maps API
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html
 *
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License, version 2
 * @package AdGoogleMaps
 */
abstract class Tx_AdGoogleMaps_MapBuilder_API_Overlay_AbstractOverlay implements Tx_AdGoogleMaps_MapBuilder_API_Overlay_OverlayInterface {

	/**
	 * @var Tx_AdGoogleMaps_JsonClassEncoder_JsonEncoderInterface
	 * @jsonClassEncoder ignoreProperty
	 */
	protected $jsonEncoder;

	/**
	 * Injects this jsonEncoder.
	 *
	 * @param Tx_AdGoogleMaps_JsonClassEncoder_JsonEncoderInterface $jsonEncoder
	 * @return void
	 */
	public function injectJsonEncoder(Tx_AdGoogleMaps_JsonClassEncoder_JsonEncoderInterface $jsonEncoder) {
		$this->jsonEncoder = $jsonEncoder;
	}

	/**
	 * Merge given option array with this object.
	 *
	 * @param array $options
	 * @return void
	 */
	public function mergeOptionsWithObject(array $options = NULL) {
		foreach ((array) $options as $propertyName => $propertyValue) {
			$setterName = 'set' . ucfirst($propertyName);
			if (is_callable(array($this, $setterName))) {
				call_user_func(array($this, $setterName), $propertyValue);
			}
		}
	}

	/**
	 * Returns the info window options as JavaScript string.
	 *
	 * @return array
	 */
	public function getPrintOptions() {
		return $this->jsonEncoder->encode($this);
	}

	/**
	 * Returns the polyline as JavaScript string.
	 *
	 * @return array
	 */
	abstract public function getPrint();

	/**
	 * Returns the polyline as JavaScript string.
	 *
	 * @return string
	 */
	public function __toString() {
		$this->getPrint();
	}

}

?>