<?php
namespace Core;

use App\Config;
use Core\Util\StringHelper;

use PDO;

class PdoDatabase implements IDatabase
{
    private $pdoInstance;
    
    public function __construct()
    {
        $pdo_options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
                             PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING);
        try
        {
            $this->pdoInstance = new PDO(
                'mysql:host=' . Config::DB_SERVER .
                ';dbname=' . Config::DB_NAME,
                Config::DB_USER,
                Config::DB_PASS,
                $pdo_options);
        }
        catch (Exception $ex)
        {
            echo $ex->getMessage() . '<br />';
            die('<p style="color: red;">PDO ERROR: Could not connect to database!</p>');
        }
    }

    public function query(string $queryString, array $params = array())
    {
        $query = $this->pdoInstance->prepare($queryString);
        $query->execute($params);

        if (explode(' ', $queryString)[0] == 'SELECT')
        {
            if (StringHelper::endsWith($queryString, 'LIMIT 1'))
                return $query->fetch();
            return $query->fetchAll();
        }
    }
}