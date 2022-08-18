<?php

namespace App\Services;

use App\Models\ArticleCollection;
use App\Repositories\ArticlesRepository;
use App\Repositories\NewsApiArticleRepository;

class ShowAllArticleService
{
    private ArticlesRepository $articlesRepository;

    public function __construct(ArticlesRepository $articlesRepository)
    {
        $this->articlesRepository = $articlesRepository;
    }

    public function execute(): ArticleCollection
    {
        return $this->articlesRepository->getAll();
    }
}