<?php 

declare(strict_types=1);

class Database {
    private const OFFERS_TABLE = 'offers';
    private const REQUESTS_TABLE = 'requests';
    private const OPERATORS_TABLE = 'operators';

    /**
     * @var PDO|null
     */
    public static $connection;

    /**
     * @return PDO
     */
	public static function getDatabaseConnection(): PDO
	{
	    if (null === self::$connection) {
            $dbParams = include_once(ROOT . '/config/db_config.php');
            $dsn = "mysql:dbname={$dbParams['dbname']};host={$dbParams['host']}";
            try {
            $db = new PDO($dsn, $dbParams['user'], $dbParams['password']);
            } catch (PDOException $e) {
                echo "Database ERROR: " . $e->getMessage();
                die();
            }
            $db->exec('set names utf8');
            self::$connection = $db;
        }

        return self::$connection;
	}

    /**
     * @return array
     */
	public static function getResultsFromQuery1(): array
    {
        $db = self::getDatabaseConnection();
        $query_variables = [
            ':count' => 2,
            ':firstOperatorId' => 10,
            ':secondOperatorId' => 12,
        ];
        $query = "SELECT r.id, of.name, r.price, r.count, op.fio FROM " . self::REQUESTS_TABLE . " r 
                  LEFT JOIN ". self::OFFERS_TABLE . " of ON (of.id = r.offer_id) 
                  LEFT JOIN ". self::OPERATORS_TABLE . " op 
                  ON (op.id = r.operator_id) WHERE r.count > :count 
                  AND (r.operator_id = :firstOperatorId OR r.operator_id = :secondOperatorId)";
        $result = $db->prepare($query);
        $result->execute($query_variables);

        $ordersList = [];

        $i = 0;

        while ($row = $result->fetch()) {
            $ordersList[$i]['id'] = $row['id'];
            $ordersList[$i]['name'] = $row['name'];
            $ordersList[$i]['price'] = $row['price'];
            $ordersList[$i]['count'] = $row['count'];
            $ordersList[$i]['fio'] = $row['fio'];
            $i++;
        }

        return $ordersList;

    }

    /**
     * @return array
     */
    public static function getResultsFromQuery2(): array
    {
        $db = self::getDatabaseConnection();

        $query = "SELECT of.name, SUM(r.price) price_sum, SUM(r.count) count_sum FROM " . self::REQUESTS_TABLE . " r 
                  LEFT JOIN ". self::OFFERS_TABLE . " of ON (of.id = r.offer_id) 
                  GROUP BY of.name";
        $result = $db->prepare($query);
        $result->execute();

        $productsList = [];

        $i = 0;

        while ($row = $result->fetch()) {
            $productsList[$i]['name'] = $row['name'];
            $productsList[$i]['price_sum'] = $row['price_sum'];
            $productsList[$i]['count_sum'] = $row['count_sum'];
            $i++;
        }

        return $productsList;
    }
}