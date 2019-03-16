<?php
namespace Core;

use PDO;
use App\Config;
use Core\Util\StringHelper;

/**
 * The singleton Database access used to ensure that there is only
 * ever one instance of the Database class.
 */
class Database
{
    /**
     * The variable that stores the singleton Database instance.
     */
    private static $instance = NULL;

    /**
     * The constructor and clone functions are set private
     * so that they cannot be called from outside the class.
     */
    private function __construct() {}
    private function __clone() {}

    /**
     * Returns the singleton Database instance. If there is none, 
     * it will create it.
     */
    public static function getInstance()
    {
        if (!isset(self::$instance))
            self::setInstance();
        return self::$instance;
    }

    public static function query(string $queryString, array $params = array())
    {
        $query = self::getInstance()->prepare($queryString);
        $query->execute($params);
        if (explode(' ', $queryString)[0] == 'SELECT')
        {
            if (StringHelper::endsWith($queryString, 'LIMIT 1'))
                return $query->fetch();
            return $query->fetchAll();
        }
    }

    /**
     * Configure and set the singleton database instance. 
     * Uses the values set in the Config.php file.
     */
    private static function setInstance()
    {
        $pdo_options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
                             PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING);
        try
        {
            self::$instance = new PDO(
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
}