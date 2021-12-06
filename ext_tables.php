<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'PHFR.NgFastyoutube',
    'Pi',
    'YouTubeVideo'
    );

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('ng_fastyoutube', 'Configuration/TypoScript', 'YouTubeVideo');
