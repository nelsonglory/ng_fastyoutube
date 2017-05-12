<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'PHFR.' . $_EXTKEY,
	'Pi',
	array(
		'VideoElement' => 'showElement',
		
	),
	// non-cacheable actions
	array(
		'VideoElement' => '',
		
	)
);
