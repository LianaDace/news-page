<?php

namespace App\Controllers;


use App\Repositories\MyNews;
use App\Repositories\NewsApiArticleRepository;
use App\Services\Exceptions\ArticleStoreFailedException;
use App\Services\ShowAllArticleService;
use App\Services\StoreArticleService;
use App\Services\StoreArticleServiceRequest;
use App\View;

class ArticleController
{
    private ShowAllArticleService $service;
    private StoreArticleService $storeArticleService;

    public function __construct(
        ShowAllArticleService $service,
        StoreArticleService $storeArticleService
    )
    {
        $this->service = $service;
        $this->storeArticleService = $storeArticleService;
    }

    public function show(): View
    {
        return new View('articles', [
            'articles' => $this->service->execute()->getAll()
        ]);
    }


    public function create(): View
    {
        return new View('create-article');
    }

    /**
     * @throws \App\Services\Exceptions\ArticleStoreFailedException
     */
    public function store(): void
    {
        try {
            $this->storeArticleService->execute(
                new StoreArticleServiceRequest(
                    $_POST['title'],
                    $_POST['description'],
                    $_POST['url'],
                    $_POST['image']
                )
            );
        } catch (ArticleStoreFailedException $e) {
            header('Location: /articles?failed=true');
        }
      header('Location: http://localhost:8000/my-articles');


    }

  public function index(): View
  {
      return new View('articles', [
          'articles' => $this->service->execute()->getAll()
      ]);
  }
    public function sports(): View
    {
        return new View('articles', [
            'articles' => $this->service->execute()->getAll()
        ]);
    }
    public function business(): View
    {
        return new View('articles', [
            'articles' => $this->service->execute()->getAll()
        ]);
    }

    public function latNews(): View
    {
        return new View('articles', [
            'articles' => $this->service->execute()->getAll()
        ]);
    }
}