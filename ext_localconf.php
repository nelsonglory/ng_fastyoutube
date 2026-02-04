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