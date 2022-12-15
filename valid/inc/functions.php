<?php

    //----TEMP----
    
    foreach(glob('./classes/*.php') as $file){
        require_once $file;
    } 
    
    $controllers = new Controllers(); 

    //----TEMP----

    function runSQL(PDO $pdo, string $sql, array $args = null)
    {
         if(!$args)
         {
            return $pdo -> query($sql);
         }
                
         $statement = $pdo -> prepare($sql);
         $statement -> execute($args);
         return $statement;
    }

    function redirect(string $page, array $params = [])
    {
        $qs = $params ? '?' . http_build_query($params) : '';

        header("Location: $page.php" . $qs);
    }

    function alert($message, $type)
    {
        return  "<div class='alert alert-$type mt-4' role='alert'>$message</div>";
    }

?>