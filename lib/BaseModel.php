<?php


class BaseModel
{
    /**
     * @var mysqli
     */
    public $connection;

    public function __construct()
    {
        $this->connection = Connection::get();
    }

    public function getAll($query) {
        $result = $this->connection->query($query);

        $resultSet = [];

        while ($itemSet = $result->fetch_assoc()) {
            $resultSet[] = $itemSet;
        }

        return $resultSet;
    }
}