<?php

declare(strict_types=1);

use TYPO3\CMS\Extbase\Utility\ExtensionUtility;
use PHFR\NgFastyoutube\Controller\VideoElementController;

defined('TYPO3') or die();

ExtensionUtility::configurePlugin(
    'NgFastyoutube',
    'Pi',
    [
        VideoElementController::class => 'showElement',
    ],
    // non-cacheable actions
    [
        VideoElementController::class => '',
    ],
    ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT,
    );


/*
// wizards
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
    'mod {
            wizards.newContentElement.wizardItems.plugins {
                elements {
                    pi {
                        iconIdentifier = ng_fastyoutube-svg-icon
                        title = LLL:EXT:ng_fastyoutube/Resources/Private/Language/locallang.xlf:tx_ng_fastyoutube_pi.name
                        description = LLL:EXT:ng_fastyoutube/Resources/Private/Language/locallang.xlf:tx_ng_fastyoutube_pi.description
                        tt_content_defValues {
                            CType = ngfastyoutube_pi
                            list_type = ngfastyoutube_pi
                        }
                    }
                }
                show = *
            }
       }'
    );
*/