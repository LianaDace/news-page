<?php

namespace App\Repositories;

use App\Models\Article;
use App\Models\ArticleCollection;

class AddArticle implements ArticlesRepository
{

    public function getAll(): ArticleCollection
    {
        $addNew = new Article('title', 'description', 'url', 'image');
    }

    public function save(Article $article): void
    {
        // TODO: Implement save() method.
    }
}