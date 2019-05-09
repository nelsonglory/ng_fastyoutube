<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}
/*
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
*/
call_user_func(
    function()
    {

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'PHFR.Ng_fastyoutube',
            'Pi',
            [
                'VideoElement' => 'showElement',
            ],
            // non-cacheable actions
            [
                'VideoElement' => '',
            ]
        );

    // wizards
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
        'mod {
            wizards.newContentElement.wizardItems.plugins {
                elements {
                    pi {
                        iconIdentifier = ng_fastyoutube-plugin-pi
                        title = LLL:EXT:ng_fastyoutube/Resources/Private/Language/locallang_db.xlf:tx_ng_fastyoutube_pi.name
                        description = LLL:EXT:ng_fastyoutube/Resources/Private/Language/locallang_db.xlf:tx_ng_fastyoutube_pi.description
                        tt_content_defValues {
                            CType = list
                            list_type = ng_fastyoutube_pi
                        }
                    }
                }
                show = *
            }
       }'
    );
		$iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);
		
			$iconRegistry->registerIcon(
				'ng_fastyoutube-plugin-pi',
				\TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
				['source' => 'EXT:ng_fastyoutube/Resources/Public/Icons/user_plugin_pi.svg']
			);
		
    }
);
