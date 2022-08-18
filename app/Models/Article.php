<?php

namespace App\Models;

class Article
{
    private string $title;
    private string $description;
    private string $url;
    private ?string $image;
    private ?int $id;

    public function __construct(string $title, string $description, string $url, ?string $image = null, ?int $id = null)
    {
        $this->title = $title;
        $this->description = $description;
        $this->url = $url;
        $this->image = $image;
    }


    public function getDescription(): string
    {
        return $this->description;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

}