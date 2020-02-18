<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BlogRepository")
 */
class Blog
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $feedId;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $content;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $imageUrl;


    public function getId(): ?int
    {
        return $this->id;
    }


    public function getFeedId(): ?int
    {
        return $this->feedId;
    }


    public function setFeedId(?int $feedId): self
    {
        $this->feedId = $feedId;

        return $this;
    }


    public function getTitle(): ?string
    {
        return $this->title;
    }


    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }


    public function getContent(): ?string
    {
        return $this->content;
    }


    public function setContent(?string $content): self
    {
        $this->content = $content;

        return $this;
    }


    public function getImageUrl(): ?string
    {
        return $this->imageUrl;
    }


    public function setImageUrl(?string $imageUrl): self
    {
        $this->imageUrl = $imageUrl;

        return $this;
    }


    public function add(?int $feedId, string $title, ?string $content, ?string $imageUrl): self
    {
        $this->setFeedId($feedId);
        $this->setTitle($title);
        $this->setContent($content);
        $this->setImageUrl($imageUrl);

        return $this;
    }


}
