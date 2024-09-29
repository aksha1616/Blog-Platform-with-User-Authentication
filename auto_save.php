<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   $data = json_decode(file_get_contents("php://input"), true);
   $content = mysqli_real_escape_string($conn, $data['content']);

   // Save draft logic here (you can add a draft column in the posts table)
   // For simplicity, we're just returning a success message.
   echo json_encode(['status' => 'success']);
}
?>