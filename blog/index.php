<?php
require_once '../class/Post.php';
require_once '../config/pdoInit.php';
$error = null;
try {
    if (isset($_POST['name'], $_POST['content'])) {
        $query = $pdo->prepare('INSERT INTO posts (name, content, created_at) VALUES (:name, :content, :created)');
        $query->execute([
            'name' => $_POST['name'],
            'content' => $_POST['content'],
            'created' => time()
        ]);
        header('Location: /blog/edit.php?id=' . $pdo->lastInsertId());
        exit();
    }
$query = $pdo->query('SELECT * FROM posts');
$posts = $query->fetchAll(PDO::FETCH_CLASS, 'Post');

} catch (PDOException $e) {
    $error = $e-> getMessage();
}

require '../elements/header.php';
?>

<div class="container">

    <?php if ($error): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php else: ?>
        <ul>
            <?php foreach ($posts as $post): ?>
                    <span class="d-flex align-items-center">
                        <h2><a href="blog/edit.php?id=<?= $post->id ?>"><?= htmlentities($post->name)?></a></h2>
                        <a class="btn btn-outline-danger" href="blog/delete.php?id=<?= $post->id ?>">X</a>
                      </span>
                <p class="small text-muted">Ecrit le <?= $post->created_at->format('d/m/Y à H:i') ?></p>
                <p> <?= nl2br(htmlentities($post->getExcerpt())) ?></p>
            <?php endforeach ?>
        </ul>

        <form action="" method="post">
            <div class="form-group">
                <input type="text" class="form-control" name="name" placeholder="Titre de l'article">
            </div>
            <div class="form-group">
                <textarea class="form-control" name="content" placeholder="Votre contenu"></textarea>
            </div>
            <button class="btn btn-primary">Sauvegarder</button>
        </form>

    <?php endif ?>

</div>



<?php
require '../elements/footer.php';
?>
