<?php
defined('TYPO3_MODE') || die('Access denied.');

// plugin signature: <extension key without underscores> '_' <plugin name in lowercase>
$pluginSignature = 'ngfastyoutube_pi';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
    $pluginSignature,
    // Flexform configuration schema file
    'FILE:EXT:ng_fastyoutube/Configuration/FlexForms/flexform_pi.xml'
    );

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin
(
    'PHFR.NgFastyoutube',
    'Pi',
    'YouTubeVideo'
    );