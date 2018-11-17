<?php
include "../database/database.php";

class ProvidersService
{
    private $connection;

    public function __construct()
    {
        $this->connection = getDatabaseConnection();
    }

    public function __destruct()
    {
        $this->connection->close();
    }

   public function getProvidersList() {
        $select = $this->connection->query("SELECT name FROM providers");
        return  $select->fetch_all(MYSQLI_ASSOC);
    }
}