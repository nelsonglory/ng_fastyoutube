<?php
namespace PHFR\NgFastyoutube\Controller;

/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2017 Roderick Braun <roderick.braun@ph-freiburg.de>, University of Education Freiburg
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
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

use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * VideoElementController
 */
class VideoElementController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	/**
	* init
	*/
	public function initializeAction() {
	    $assetCollector = GeneralUtility::makeInstance(\TYPO3\CMS\Core\Page\AssetCollector::class);
	    $assetCollector->addStyleSheet('defaultCSS', 'EXT:ng_fastyoutube/Resources/Public/css/default.css');
	    $assetCollector->addJavaScript('defaultJS', 'EXT:ng_fastyoutube/Resources/Public/JS/default.js');
	}
	/**
	 * action showElement
	 *
	 * @return void
	 */
	public function showElementAction(): ResponseInterface {
		// set default showinfo=0
		$paramArr[] = 'showinfo=0';
		// get all parameters
		if ($this->getConfigValue('playlistID','string'))
			$paramArr[] = 'list='.$this->getConfigValue('playlistID','string');
		if ($this->getConfigValue('video_quality','string')) 
			$paramArr[] = 'vq='.$this->getConfigValue('video_quality','string');
		if ($this->getConfigValue('disable_fullscreen','int',0))
			$paramArr[] = 'fs=0';
		if ($this->getConfigValue('hide_controls','int',0))
			$paramArr[] = 'controls=0';
		if ($this->getConfigValue('no_related_videos','int',0))
			$paramArr[] = 'rel=0';
		if ($this->getConfigValue('disable_branding','int',0))	
			$paramArr[] = 'modestbranding=1';
		// create data-params string
		$dataParms = implode('&',$paramArr);
		
		// size
		$width = $this->getConfigValue('width','int',0);
		$height = $this->getConfigValue('height','int',0); 
			
		$this->view->assignMultiple(array(
				'vidID' => $this->getConfigValue('vidID','string'),
				'width' => $width,
				'height' => $height,
				'format' => $this->getConfigValue('video_format','string','16:9'),
				'max-pv-width' => $this->getConfigValue('max-pv-width','string','480'),
				'data-parms' => $dataParms,
                'disablePrivStmnt' => $this->getConfigValue('disable_privacy_statement','int',0),
		        'sysLanguageCode' => $GLOBALS['TSFE']->language->getTwoLetterIsoCode(),
		));
		
		return $this->htmlResponse();
	}	
	/**
	 * retrieve config value from flexform or typoscript
	 *
	 * @param string $configVar
	 * @param string $type
	 * @param string $defaultValue
	 * @return string
	 */
	private function getConfigValue($configVar,$type='string',$defaultValue='') {
		// retrieve config values given by flexform with respect of types, fallback on typoscript values or default
		$configValue = null;
	    if (!empty($this->settings['flexform'][$configVar])) {
	        $configValue = $this->settings['flexform'][$configVar];
	    } elseif (!empty($this->settings[$configVar])) {
	        $configValue = $this->settings[$configVar];
	    } else {
	        $configValue = $defaultValue;
	    }
	    settype($configValue,$type);
	    return $configValue;
	}
	/**
	 * translate given key or return key if no translation is found
	 *
	 * @param string $key
	 * @return string
	 */
	private function translate($key) {
	    $translated =  \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate($key, $this->request->getControllerExtensionKey());
	    return $translated ? $translated : $key;
	}
}
