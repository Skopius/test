<?php
$servername = 'localhost';
$database = 'test_base';
$username =  'root';
$password = 'root';

$result = 'success';



try {
  $conn = new PDO('mysql:host='.$servername.';dbname='.$database, $username, $password);

  $conn->exec('set names utf8');

  if (!$conn) {
    echo 'Connection failed';
  }
  if (!isset($_POST['id'])) {
    echo 'Cannot delete without id';
  }

  $id = $_POST['id'];

  $query = "DELETE FROM `comments` WHERE `id` = $id";
  $conn->exec($query);

} catch (PDOExeption $e) {
  $result = "Error:" . $e->getMessage() . '<br/>';
}

echo $comments;

?>