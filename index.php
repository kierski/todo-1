<?php 

try {
  $pdo = new PDO('mysql:host=hostname', 'user', 'password');
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $pdo->exec('SET NAMES "utf8"');
}
catch (PDOException $e) {
  $error = 'Problem with connect';
  include 'views/error.php';
  exit();
}

if (isset($_POST['todoItem'])) {
  try {
    $sql = 'INSERT INTO items SET
        item = :item,
        dateItem = CURDATE()';
    $s = $pdo->prepare($sql);
    $s->bindValue(':item', $_POST['todoItem']);
    $s->execute();
  } catch (PDOException $e) {
    $error = 'Error add item: ' . $e->getMessage();
    include 'error.html.php';
    exit();
  }

  header('Location: .');
  exit();
}

if (isset($_GET['deleteItem'])) {
  try {
    $sql = 'DELETE FROM items WHERE id = :id';
    $s = $pdo->prepare($sql);
    $s->bindValue(':id', $_POST['id']);
    $s->execute();
  } catch (PDOException $e) {
    $error = 'Error with delete item: ' . $e->getMessage();
    include 'views/error.php';
    exit();
  }
  header('Location: .');
  exit();
}

try {
  $sql = 'SELECT id, item FROM items';
  $result = $pdo->query($sql);
} catch (PDOException $e) {
  $error = 'Error get list of items ' . $e->getMessage();
  include 'views/error.php';
  exit();
}

while ($row = $result->fetch()) {
  $itemsEl[] = array('id' => $row['id'], 'text' => $row['item']);
}

include 'views/home.php';