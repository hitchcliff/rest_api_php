<?php
class Category
{
  // db stuff
  private $conn;

  // category properties
  public $id;
  public $name;
  public $created_at;

  public function __construct($db)
  {
    $this->conn = $db;
  }

  public function read()
  {
    $query = "SELECT id, name, created_at FROM categories ORDER BY id DESC";

    // Prepare statement
    $stmt = $this->conn->prepare($query);

    // Execute statement
    $stmt->execute();

    return $stmt;
  }
}