<?php

class Database extends PDO
{
    public function __construct($dsn, $username, $password, $options = [])
    {
    
        $default_options = 
                        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, 
                         PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                         PDO::ATTR_EMULATE_PREPARES => false,];
                         
        $options = array_replace($default_options, $options);
        parent::__construct($dsn, $username, $password, $options);
    }

    public function runSQL(string $sql, array $args = null)
    {
        if(!$args) { return $this->query($sql); }
        $statement = $this->prepare($sql);
        $statement->execute($args);
        return $statement;
    }

}

?>
