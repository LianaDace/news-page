<?php

namespace App\Repositories;

use App\Models\Article;
use App\Models\ArticleCollection;
use App\Repositories\Exceptions\RecordStoreFailedException;

class CsvArticleRepository implements ArticlesRepository
{

    public function getAll(): ArticleCollection
    {
        return new ArticleCollection([]);
    }

    public function save(Article $article): void
    {

        $data = $_POST;

        $errors = [];
        foreach (["title", "url", "image", "description"] as $field){
            if(empty($data[$field])) {
                $errors[] = sprintf('The %s is a required field', $field);
            }
        }

        if(!empty($errors)){
            echo implode('<br />', $errors);
            exit;
        }

$host = $_ENV['HOST_NAME'];
$database = $_ENV['DB_NAME'];
$user = $_ENV['USER_NAME'];
$pass = $_ENV['PASSWORD'];
$dsn = sprintf("mysql:host=%s;dbname=%s;", $host, $database);

$options = [
   \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
    \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
];

try {
    $pdo = new \PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

$statement = $pdo->prepare('SELECT * FROM article WHERE title=:title');
$statement->execute(['title' => $data['title']]);

$statement = $pdo->prepare('INSERT INTO article(title, description, url, image) VALUES(:title, :description, :url, :image)');
$statement->execute([
    'title' => $data['title'],
    'description' => $data['description'],
    'url' => $data['url'],
    'image' => $data['image']
]);

        header('Location: http://localhost:8000');
    }
}
