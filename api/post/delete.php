<?php

// Headers
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");

include_once '../../config/Database.php';
include_once '../../models/Post.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instatiate blog posts object
$post = new Post($db);

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));

$post->id = $data->id;

// Delete post
if ($post->delete()) {
  echo json_encode(
    array('message' => 'post deleted')
  );
} else {
  echo json_encode(
    array('message' => 'post not deleted')
  );
}