<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/connect.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/functions.php';

$messages = getMessages();

if (isset($_GET['delete'])) {
    $deleteId = (int)$_GET['delete'];
    blogDelete($deleteId);
    header('Location: /toBlogShow');
    die();
}

?>
<!doctype html>
<html lang="ru">
    <?php require $_SERVER['DOCUMENT_ROOT'] . "/templates/head.php"?>
    <body>
        <?php require $_SERVER['DOCUMENT_ROOT'] . "/templates/header.php"?>
        <main>
            <div class="container">
                <div class="row">
                    <div class="col-md">
                        <form action="/templates/blog/toBlogHandler.php" method="post" enctype="multipart/form-data">
                            <div class="mb-4">
                            <?php if (!empty($messages)) : ?>
                                <?php foreach ($messages as $message) : ?>
                                    <div class="message">
                                        <p>Заголовок: <?=$message['title']?> | Дата: <?= $message['insertedOn'] ?></p>
                                        <div><?=nl2br(htmlspecialchars($message['text']))?></div>
                                        <div><img src="<?php echo "/" . $message['img']?>" alt="" width="200" > </div>
                                        <div><?php echo $message['fullname'];?></div>
                                        <div><a href="/templates/blog/toBlogEdit.php?id=<?=$message['id']?>" class="text-dark">Редактирование</a></div>
                                        <div>
                                            <a href="javascript:void(0)" onclick="if(confirm('Вы хотите удалить?'))
                                        {location.href = '/templates/blog/toBlogShow.php?delete=<?=$message['id']?>'}" class="text-dark">Удаление</a>
                                        </div>
                                        <hr>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </form>    
                    </div>
                </div>
            </div>
        </main>
        <?php require $_SERVER['DOCUMENT_ROOT'] . "/templates/footer.php"?>
    </body>
</html>
