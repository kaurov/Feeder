<?php

namespace App\Service;

use App\Service\Feeds\FeedJson;
use App\Service\Feeds\FeedRssGolem;
use Doctrine\ORM\EntityManagerInterface;
use FeedIo\FeedIo;

class FeedsImporterFactory
{

    public function __invoke(EntityManagerInterface $entityManager, FeedIo $feedIo): FeedsImporter
    {
        $feedsImporter = new FeedsImporter(
            [
                new FeedJson($entityManager),
                new FeedRssGolem($entityManager, $feedIo),
            ]
        );
        return $feedsImporter;
    }


}