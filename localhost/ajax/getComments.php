<?php
include('../databaseconnect.php');

$result = '';

try {
  $conn = new PDO('mysql:host='.$servername.';dbname='.$database, $username, $password);

  $conn->exec('set names utf8');

  if (!$conn) {
    echo 'Connection failed';
  }

  $comments = '';

  $query = $conn->prepare('SELECT * FROM `comments` ORDER BY `postdate`');
  $query->execute();
  $data = $query->fetchAll(PDO::FETCH_ASSOC);
  foreach($data as $value) {
    $comments .= '<div class="comment">
                    <div class="comment__content">
                        <div class="comment__username">'.$value["username"].'</div>
                        <div class="comment__text">
                          '.$value["message"].'
                        </div>
                    </div>
                    <div class="comment__additional-content">
                        <div class="comment__remove" data-id="'.$value["id"].'">Удалить комментарий</div>
                        <div class="comment__date">'.date("d.m.Y H:i",$value["postdate"]).'</div>
                    </div>
                </div>';    
  }

} catch (PDOExeption $e) {
  echo "Error:" . $e->getMessage() . '<br/>';
}

echo json_encode($data);

?>