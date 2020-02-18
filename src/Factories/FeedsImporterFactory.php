<?php

namespace App\Service;

use App\Service\Feeds\FeedJson;
use Doctrine\ORM\EntityManagerInterface;

class FeedsImporterFactory
{

    public function __invoke(EntityManagerInterface $entityManager): FeedsImporter
    {
        $feedsImporter = new FeedsImporter(
            [
                new FeedJson($entityManager),
            ]
        );
        return $feedsImporter;
    }


}