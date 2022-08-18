<?php

namespace App\Repositories;

use App\Models\Article;
use App\Models\ArticleCollection;

interface ArticlesRepository
{
    public function getAll(): ArticleCollection;
    public function save(Article $article): void;
}