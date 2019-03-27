<?php

declare(strict_types=1);

class SiteController
{
    public function actionIndex(): void
    {
        require_once ROOT . '/views/site/index.php';
    }

    public function actionQuery1(): void
    {
        $ordersList = Database::getResultsFromQuery1();

        require_once ROOT . '/views/site/result.php';
    }

    public function actionQuery2(): void
    {
        $productsList = Database::getResultsFromQuery2();

        require_once ROOT . '/views/site/result.php';
    }

}