<?php
include "../database/database.php";

class AccountService
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

    function createAccount($type, $name, $amount)
    {
        $account_type = $this->getAccountType($type);
        $owner = $this->getUserId();
        $sql = "INSERT INTO account (owner, name, account_type, amount, ID) VALUES (?,?,?,?,?)";
        $statement = $this->connection->prepare($sql);
        $statement->bind_param("sssss", $owner, $name, $account_type, $amount, $ID );
        $statement->execute();
    }

    private function getUserId() {
        $userEmail = $_SESSION['email'];
        $selectUser = $this->connection->prepare("SELECT ID FROM user WHERE email = ?");
        $selectUser->bind_param("s", $userEmail);
        $selectUser->execute();
        $result = $selectUser->get_result()->fetch_all();
        return $result[0][0];
    }

    private function getAccountType($type) {
        $selectType = $this->connection->prepare("SELECT ID FROM account_type WHERE type = ?");
        $selectType->bind_param("s", $type);
        $selectType->execute();
        $result = $selectType->get_result()->fetch_all();
        return $result[0][0];
    }

    function getAccounts() {
        $owner = $this->getUserId();
        $selectAccount = $this->connection->prepare("SELECT account.ID as id, type, amount, name FROM account JOIN account_type ON account.account_type = account_type.ID WHERE owner = ? ");
        $selectAccount->bind_param("s", $owner);
        $selectAccount->execute();
        $result = $selectAccount->get_result()->fetch_all(MYSQLI_ASSOC);
        return $result;
    }

    function receiveDeposit($id, $amount) {
        $deposit = $this->connection->prepare("UPDATE account SET amount = amount + ? WHERE ID = ?");
        $deposit->bind_param("ss", $amount, $id);
        $deposit->execute();
        return $deposit->affected_rows == 1;

    }
}