<?php
require_once '../config/pdoInit.php';

if (isset($_GET['id'])) {
    $query = $pdo->prepare('DELETE FROM posts WHERE id = :id');
    $query->execute([
        'id' => $_GET['id']
    ]);
}

header('Location: /blog/index.php');
exit();