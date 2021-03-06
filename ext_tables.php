<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

/*
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
	$_EXTKEY,
	'Pi',
	'YouTubeVideo'
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'YouTubeVideo');
*/

call_user_func(
    function()
    {
        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
            'PHFR.Ng_fastyoutube',
            'Pi',
            'YouTubeVideo'
        );

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('ng_fastyoutube', 'Configuration/TypoScript', 'YouTubeVideo');
    }
);

$extensionName = strtolower(\TYPO3\CMS\Core\Utility\GeneralUtility::underscoredToUpperCamelCase($_EXTKEY));
$pluginSignature = strtolower($extensionName).'_pi';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($pluginSignature, 'FILE:EXT:'.$_EXTKEY . '/Configuration/FlexForms/flexform_pi.xml');
