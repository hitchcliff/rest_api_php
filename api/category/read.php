<?php

// headers
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json");

include_once '../../config/Database.php';
include_once '../../models/Category.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instatiate blog posts object
$category = new Category($db);

// Category query
$result = $category->read();
// Get row count
$num = $result->rowCount();

// Check if theres categories
if ($num > 0) {
  // Category array
  $category_arr = array();
  $category_arr['data'] = array();

  while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    extract($row);

    $category_item = array(
      'id' => $id,
      'name' => html_entity_decode($name),
      'created_at' => $created_at
    );

    // Push data
    array_push($category_arr['data'], $category_item);
  }

  // Turn to JSON
  echo json_encode($category_arr);
} else {
  echo json_encode(
    array(
      'message' => "no categories found"
    )
  );
}