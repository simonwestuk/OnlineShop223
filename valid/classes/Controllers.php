<?php

class Controllers
{
    protected $db = null;
    protected $members = null;
    protected $products = null;

    public function __construct(string $dsn = null, string $username = null, string $password = null)
    {
        //----TEMP----
        
        $host = '127.0.0.1';
        $dbname = 'shop';
        $port ='3306';
        $charset = 'latin1';
        $driver = 'mysql';
        $username = 'root';
        $password = '';

        //----TEMP----

        $dsn = "$driver:host=$host;dbname=$dbname;port=$port;charset=$charset"; 
        $this->db = new Database($dsn, $username, $password);
    }

    public function members()
    {
        if ($this->members === null) {
            $this->members= new MemberController($this->db);
        }
        return $this->members;
    }

    public function products()
    {
        if ($this->products === null) {
            $this->products= new ProductController($this->db);
        }
        return $this->products;
    }

}

?>