<?php

namespace App\Repositories;

use App\Models\Article;
use App\Models\ArticleCollection;


class MyNews implements ArticlesRepository
{

    public function getAll(string $category = 'business'): ArticleCollection
    {

    $connectionParams = [
       'dbname' => $_ENV['DB_NAME'],
       'user' => $_ENV['USER_NAME'],
       'password' => $_ENV['PASSWORD'],
       'host' => $_ENV['HOST_NAME'],
       'driver' => $_ENV['DRIVER']
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
