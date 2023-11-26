<?php 
    define('DATABASE_SERVER','localhost');
    define('DATABASE_USER','root');
    define('DATABASE_PASSWORD','');
    define('DATABASE_NAME','ecomerce');
    $connection = null;
    try {
        $connection = new PDO(
            "mysql:host = ".DATABASE_SERVER.";
            dbname=".DATABASE_NAME,DATABASE_USER,DATABASE_PASSWORD);
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
    } catch (\Throwable $th) {
        //throw $th;
        echo $th->getMessage();
        $connection = null;
    }
    
    function Query($sql, $connection)
    {
        $statement = $connection->prepare($sql);
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_ASSOC);
        $data = $statement->fetchAll();
        return $data;
    }
    
?>