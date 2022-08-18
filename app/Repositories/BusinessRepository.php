<?php

namespace App\Repositories;

use App\Models\Article;
use App\Models\ArticleCollection;

class BusinessRepository implements ArticlesRepository
{
    public function __construct()
    {
        $this->httpClient = new \GuzzleHttp\Client([
            'base_uri' => $_ENV['NEWSAPI_URL']
        ]);
    }

    public function getAll(): ArticleCollection
    {

        $category = $_GET['category'] ?? 'business';

        $url = "top-headlines?country=us&category={$category}&apiKey=" . $_ENV['NEWSAPI_KEY'];

        $apiResponse = json_decode($this->httpClient->get($url)->getBody()->getContents());


        $articles = [];

        foreach ($apiResponse->articles as $article)
        {
            $articles[] = new Article(
                (string)$article->title,
                (string)$article->description,
                (string)$article->url,
                (string)$article->urlToImage,
            );
        }

        return new ArticleCollection($articles);
    }

    public function save(Article $article): void
    {
        // TODO: Implement save() method.
    }
}