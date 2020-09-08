<?php

namespace App\Service;


/**
 * Class FeedsImporter
 * import the data from all injected feeds objects to local database repository
 * @package App\Entity
 */
interface FeedsImporterInterface
{

    public function import(): bool;


}