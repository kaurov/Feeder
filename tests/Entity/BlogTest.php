<?php

namespace App\Tests;

use App\Entity\Blog;
use PHPUnit\Framework\TestCase;

class BlogTest extends TestCase
{

    /**
     * @var Blog
     */
    private $blog;


    protected function setUp(): void
    {
        $this->blog = new Blog();
    }


    /**
     * @dataProvider EntriesDataProvider
     */
    public function testAdd(?int $feedId, string $title, ?string $content, ?string $imageUrl): void
    {
        $this->blog->add($feedId, $title, $content, $imageUrl);
        $this->assertEquals($title, $this->blog->getTitle());
        $this->assertEquals($content, $this->blog->getContent());
        $this->assertEquals($imageUrl, $this->blog->getImageUrl());
        $this->assertEquals($feedId, $this->blog->getFeedId());
    }


    public function EntriesDataProvider(): array
    {
        $out = [];

        $out[] = [null, 'Title', null, null];
        $out[] = [1, 'Title', 'some long content', '/15.jpg'];

        return $out;

    }

}
