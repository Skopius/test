<?php
$servername = 'localhost';
$database = 'test_base';
$username =  'root';
$password = 'root';

$result = 'succes';

try {
  $conn = new PDO('mysql:host='.$servername.';dbname='.$database, $username, $password);

  $conn->exec('set names utf8');

  if (!$conn) {
    die('Connection failed');
  }

  $data = array();

  foreach($_POST as $key => $value) {
    if (!empty($value)) {
      $data[$key] = $value;
    } else {
      die('epmpty-fields');
    }
  }

  $code = crypt(trim($data['capcha']), '$1$itchief$7');

  if ($code != $data['code']) {
    die('bad-capcha');
  }
  
  unset($data['capcha']);  
  unset($data['code']);
  $data['postdate'] = time();

  $query = $conn->prepare('INSERT INTO `comments` (username, message, postdate) values (:username, :message, :postdate)');
  $query->execute($data);
  
  
} catch (PDOExeption $e) {
  die("Error:" . $e->getMessage() . '<br/>') ;
}

echo json_encode($data);
