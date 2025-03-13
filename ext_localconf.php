<?php
if (!defined('TYPO3')) {
	die('Access denied.');
}

call_user_func(
    function()
    {

     \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
        'NgFastyoutube',
        'Pi',
            [
                \PHFR\NgFastyoutube\Controller\VideoElementController::class => 'showElement',
            ],
            // non-cacheable actions
            [
                \PHFR\NgFastyoutube\Controller\VideoElementController::class => '',
            ]
    );
        

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
                            CType = list
                            list_type = ngfastyoutube_pi
                        }
                    }
                }
                show = *
            }
       }'
    );
    }
);
