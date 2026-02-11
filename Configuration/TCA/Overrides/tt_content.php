<?php

declare(strict_types=1);

use TYPO3\CMS\Extbase\Utility\ExtensionUtility;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

defined('TYPO3') or die();

$pluginSignature = ExtensionUtility::registerPlugin(
    // extension name, matching the PHP namespaces (but without the vendor)
    'NgFastyoutube',
    // arbitrary, but unique plugin name (not visible in the backend)
    'Pi',
    // plugin title, as visible in the drop-down in the backend, use "LLL:" for localization
    'LLL:EXT:ng_fastyoutube/Resources/Private/Language/locallang.xlf:tx_ng_fastyoutube_pi.name',
    // plugin icon, use an icon identifier from the icon registry
    'ng_fastyoutube-svg-icon',
    // plugin group, to define where the new plugin will be located in
    'plugins',
    // plugin description, as visible in the new content element wizard
    'LLL:EXT:ng_fastyoutube/Resources/Private/Language/locallang.xlf:tx_ng_fastyoutube_pi.description',
);


ExtensionManagementUtility::addToAllTCAtypes(
    'tt_content',
    '--div--;Configuration,pi_flexform,',
    $pluginSignature,
    'after:subheader',
    );
    
ExtensionManagementUtility::addPiFlexFormValue(
    '*',
    'FILE:EXT:ng_fastyoutube/Configuration/FlexForms/flexform_pi.xml',
    $pluginSignature,
);