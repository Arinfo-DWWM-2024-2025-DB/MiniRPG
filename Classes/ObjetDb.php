<?php

require_once 'DbConnection.php';

abstract class ObjetDb {
    protected readonly DbConnection $db;    
    protected readonly array $data;

    private int $id;   

    abstract public function save() : int;

    public function __construct(array $data) {
        $this->id = $data['id'];
        $this->data = $data;
        $this->db = new DbConnection();
    }    

    public function getId(): int
    {
        return $this->id;
    }
}

?>