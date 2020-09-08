<?php
namespace App\Service\Feeds;

use App\Entity\Blog;
use Doctrine\ORM\EntityManagerInterface;
use FeedInterface;
use FeedIo\FeedIo;
use FeedIo\Reader\Result;


class FeedRssGolem implements FeedInterface
{

    public const ID = 2;

    // the feed you want to read
    private const URL = 'https://rss.golem.de/rss.php?tp=foto&feed=RSS2.0';

    // this date is used to fetch only the latest items
    private const SINCE = '-1 day';

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @type \FeedIo\FeedIo
     */
    private $feedIo;


    public function __construct(EntityManagerInterface $entityManager, FeedIo $feedIo)
    {
        $this->entityManager = $entityManager;
        $this->feedIo = $feedIo;
    }


    public function import(): ?int
    {
        $statusCount = null;

        $modifiedSince = new \DateTime(static::SINCE);
        $entries = $this->feedIo->readSince(static::URL, $modifiedSince)->getFeed();

        if (!$entries) {
            return null;
        }
        foreach ($entries as $entry) {
            if ($entry instanceof Result) {
                continue;
            }
            $blogRecord = new Blog();
            $blogRecord->add(
                self::ID,
                $entry->getTitle(),
                $entry->getContent() ?? null,
                $entry->getMedias() ?? null
            );
            $this->entityManager->persist($blogRecord);
            $this->entityManager->flush();
            $statusCount++;
        }

        return $statusCount;
    }


}
