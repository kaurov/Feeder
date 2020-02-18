<?php

namespace App\Service;

/**
 * Class FeedsImporter
 * import the data from all injected feeds objects to local database repository
 * @package App\Entity
 */
class FeedsImporter
{
    /**
     * @var array the array of feeds objects to be imported
     */
    private $feeds;


    public function __construct(array $feeds)
    {
        $this->feeds = $feeds;
    }


    public function import(): bool
    {
        $status = false;
        foreach ($this->feeds as $feed) {
            if ($feed instanceof \FeedInterface) {
                $feed->import();
                $status = true;
            }
        }
        return $status;
    }


}