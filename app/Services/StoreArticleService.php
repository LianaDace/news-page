<?php

namespace App\Services;

use App\Models\Article;
use App\Repositories\CsvArticleRepository;
use App\Repositories\Exceptions\RecordStoreFailedException;
use App\Services\Exceptions\ArticleStoreFailedException;

class StoreArticleService
{
    private CsvArticleRepository $csvArticleRepository;

    public function __construct(CsvArticleRepository $csvArticleRepository)
    {
        $this->csvArticleRepository = $csvArticleRepository;
    }

    public function execute(StoreArticleServiceRequest $request): void
    {
        try {
        $article = new Article(
            $request->getTitle(),
            $request->getDescription(),
            $request->getUrl(),
            $request->getImage()
        );

        $this->csvArticleRepository->save($article);
            } catch (RecordStoreFailedException $e){
           throw new ArticleStoreFailedException();
        }

    }
}