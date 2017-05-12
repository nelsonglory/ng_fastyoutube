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

/**
 * VideoElementController
 */
class VideoElementController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	/**
	* init
	*/
	public function initializeAction() {
		define(EXTKEY, $this->request->getControllerExtensionKey());
		$this->response->addAdditionalHeaderData('<link rel="stylesheet" href="'.\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::siteRelPath(EXTKEY).'Resources/Public/css/default.css'.'" type="text/css" />');
		$this->response->addAdditionalHeaderData('<script src="'.\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::siteRelPath(EXTKEY).'Resources/Public/JS/default.js" type="text/javascript"></script>');
	}
	/**
	 * action showElement
	 *
	 * @return void
	 */
	public function showElementAction() {
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
			
		$this->view->assignMultiple(array(
				'vidID' => $this->getConfigValue('vidID','string'),
				'width' => $this->getConfigValue('width','int'),
				'height' => $this->getConfigValue('height','int'),
				'data-parms' => $dataParms
		));
	}	
	/**
	 * retrieve config value from flexform or typoscript
	 *
	 * @param string $configVar
	 * @param string $type
	 * @param string $defaultValue
	 * @return string
	 */
	public function getConfigValue($configVar,$type='string',$defaultValue='') {
		// retrieve config values given by flexform with respect of types, fallback on typoscript values or default
		$configValue = $this->settings['flexform'][$configVar] ? $this->settings['flexform'][$configVar] : $this->settings[$configVar];
		
		if ($configValue != NULL) {
			settype($configValue,$type);
			return $configValue;
		} else return $defaultValue;
	}

}