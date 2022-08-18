<?php

namespace App\Repositories;

use App\Models\Article;
use App\Models\ArticleCollection;


class MyNews implements ArticlesRepository
{

    public function getAll(string $category = 'business'): ArticleCollection
    {

    $connectionParams = [
       'dbname' => 'codelex_news',
       'user' => 'liana',
       'password' => 'Ma1jaEm1l1ja',
       'host' => 'localhost',
       'driver' => 'pdo_mysql',
   ];
       $conn = \Doctrine\DBAL\DriverManager::getConnection($connectionParams);
       $queryBuilder = $conn->createQueryBuilder();


       $articlesQuery = $queryBuilder
           ->select('*')
           ->from('article')
           ->orderBy('date_created', 'desc')
           ->executeQuery()
           ->fetchAllAssociative();

       $articles = [];
       foreach($articlesQuery as $article) {
           $articles[] = new Article(
               (string)$article['title'],
               (string)$article['description'],
               (string)$article['url'],
               (string)$article['image']
           );
       }

       return new ArticleCollection($articles);

    }

    public function save(Article $article): void
    {
        // TODO: Implement save() method.
    }
}