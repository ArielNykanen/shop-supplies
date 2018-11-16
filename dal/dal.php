<?php
// Data access layer 
// IMPORTANT dal will be the only one talking with db!!

//final class no one can acces from the outside
final class DataAccessLayer 
{
	private $host = '127.0.0.1';
	private $db   = 'coffee_shop';
	private $user = 'root';
	private $pass = '';
	private $charset = 'utf8';
    private $dsn;
    private $opt = [
		PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
		PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    private static $inst;
    // private __construct so you can just use it inside the class
    private function __construct() 
    {
        $this->dsn = "mysql:host=$this->host;dbname=$this->db;charset=$this->charset";
    }
    // the result of the constractor you can bring it outside the class with the public Instance()
    public static function Instance() 
    {
        if (DataAccessLayer::$inst === null) {
            DataAccessLayer::$inst = new DataAccessLayer();
        }
        return DataAccessLayer::$inst;
    }

    public function select($query, $params = null) 
    {
        $pdo = new PDO($this->dsn, $this->user, $this->pass, $this->opt);
        $statement = $pdo->prepare($query);
        // Gets data from sql (db)
        if (!empty($params)) 
        {
            $statement->execute($params);
        } 
        else 
        {
            $statement->execute();
        }
        return $statement;
    }
    public function insert($query, $params) {
        $pdo = new PDO($this->dsn, $this->user, $this->pass, $this->opt);
        $statement = $pdo->prepare($query);
        // Send data to sql (db)
        $statement->execute($params);
    }

    public function update($query, $params) {
        $pdo = new PDO($this->dsn, $this->user, $this->pass, $this->opt);
        $statement = $pdo->prepare($query);
        // Send data to sql (db)
        $statement->execute($params);
    }

    public function delete($query, $params) {
        $pdo = new PDO($this->dsn, $this->user, $this->pass, $this->opt);
        $statement = $pdo->prepare($query);
        // Send data to sql (db)
        $statement->execute($params);
    } 
}
?>

