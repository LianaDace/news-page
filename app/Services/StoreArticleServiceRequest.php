<?php

namespace App\Services;

class StoreArticleServiceRequest
{
    private string $title;
    private string $description;
    private string $url;
    private $image;

    public function __construct(string $title, string $description, string $url,  $image = null)
    {
        $this->title = $title;
        $this->description = $description;
        $this->url = $url;
        $this->image = $image;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getImage()
    {
        return $this->image;
    }
}