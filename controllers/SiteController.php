<?php

declare(strict_types=1);

class SiteController
{
    public const OPERATOR_IDS = [10, 12];
    public const REQUESTS_COUNT = 2;

    public function actionIndex(): void
    {
        require_once ROOT . '/views/site/index.php';
    }

    public function actionRequestsList(): void
    {
        $ordersList = Database::getRequestsListByCondition(self::REQUESTS_COUNT, self::OPERATOR_IDS);

        require_once ROOT . '/views/site/result.php';
    }

    public function actionAggregatedOffers(): void
    {
        $productsList = Database::getAggregatedOffers();

        require_once ROOT . '/views/site/result.php';
    }

}