<?php

declare(strict_types=1);

namespace PHFR\NgFastyoutube\Updates;

use TYPO3\CMS\Install\Attribute\UpgradeWizard;
use TYPO3\CMS\Install\Updates\AbstractListTypeToCTypeUpdate;

#[UpgradeWizard('NgFastyoutubeCTypeMigration')]
final class NgFastyoutubeCTypeMigration extends AbstractListTypeToCTypeUpdate
{
    /**
     * Mapping von altem list_type auf neuen CType
     */
    protected function getListTypeToCTypeMapping(): array
    {
        return [
            // 'alter_list_type' => 'neuer_ctype'
            'ngfastyoutube_pi' => 'ngfastyoutube_pi',
        ];
    }
    
    public function getTitle(): string
    {
        return 'Migrate "NgFastyoutube" plugins to dedicated CTypes';
    }
    
    public function getDescription(): string
    {
        return 'Updates tt_content records from list_type to the new CType based registration.';
    }
}