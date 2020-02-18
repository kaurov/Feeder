<?php
namespace App\Service\Feeds;

use Doctrine\ORM\EntityManagerInterface;
use FeedInterface;

class FeedJson implements FeedInterface
{

    public const ID = 1;

    private const URL = 'http://localhost/feeder/public/Import/jsonFeed.php';

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;


    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }


    public function import(): ?int
    {
        $statusCount = null;
        $feedContent = \file_get_contents(self::URL);
        $entries = $feedContent ? \json_decode($feedContent, true) : null;
        if (!$entries) {
            return null;
        }
        foreach ($entries as $entry) {
            $blogRecord = new \App\Entity\Blog();
            $blogRecord->add(
                self::ID,
                $entry['title'],
                $entry['content'] ?? null,
                $entry['imageURL'] ?? null
            );
            $this->entityManager->persist($blogRecord);
            $this->entityManager->flush();
            $statusCount++;
            /** @todo add validator and skipping invalid records here. */

        }

        return $statusCount;
    }


}
