<?php
require_once 'class/Message.php';
require_once 'class/GuestBook.php';
$error = null;
$success = false;
$guestBook = new GuestBook(__DIR__ . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'messages');
if (isset($_POST['username']) && isset($_POST['message'])) {
    $message = new Message($_POST['username'], $_POST['message']);
    if ($message->isValid()) {
        $guestBook->addMessage($message);
        $success = true;
        $_POST = [];
    } else {
        $error = $message->getErrors();
    }
}
$messages = $guestBook->getMessages();
$title = 'Livre d\'or';
require 'elements/header.php';
?>

<div class="container">
    <h1>Livre d'or</h1>

    <?php if (!empty($error)): ?>
        <div class="alert alert-danger">
            Formulaire invalide
        </div>
    <?php endif ?>

    <?php if ($success): ?>
        <div class="alert alert-success">
            Merci pour votre message
        </div>
    <?php endif ?>

    <form action="" method="post">
    <div class="mb-3">
        <label for="username" class="form-label">Votre pseudo</label>
        <input type="text" value="<?= htmlentities($_POST['username'] ?? '') ;?> " class="form-control <?= isset($error['username']) ? 'is-invalid' : '' ;?>" id="username" name="username">
        <?php if (isset($error['username'])): ?>
        <div class="invalid-feedback"><?= $error['username'] ?></div>
        <?php endif ?>
    </div>
    <div class="mb-3">
        <label for="message" class="form-label">Votre message</label>
        <textarea class="form-control <?= isset($error['message']) ? 'is-invalid' : '' ;?>" id="message" name="message"><?= htmlentities($_POST['message'] ?? '') ;?></textarea>
        <?php if (isset($error['message'])): ?>
            <div class="invalid-feedback"><?= $error['message'] ?></div>
        <?php endif ?>
    </div>
    <button type="submit" class="btn btn-primary">Envoyer</button>
    </form>

    <?php if (!empty($messages)): ?>
    <h1 class="mt-4">Liste des messages</h1>
    <?php foreach ($messages as $message): ?>
        <?= $message->toHTML() ?>

    <?php endforeach ?>

    <?php endif ?>
</div>



<?php
require 'elements/footer.php';
?>
