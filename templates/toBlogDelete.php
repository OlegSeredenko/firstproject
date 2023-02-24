<?php
session_start();

require_once $_SERVER['DOCUMENT_ROOT'] . '/config/connect.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/functions.php';
$getMessageBlogForEdit = getMessageBlogForEdit($_GET['id']);

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
                        <form action="/templates/toBlogDeleteHandler.php" method="post" enctype="multipart/form-data">
                            <div><?php if (!isset($_SESSION['user'])) {
                            echo '<p class="msg">' . "Удалять записи в блоге могут только авторизированные пользователи" . '</p>';}
                            if ($_SESSION['user']['id'] != $getMessageBlogForEdit[0]['userId']) {
                                echo '<p class="msg">' . "Разрешено удалять только свои записи в блоге" . '</p>';}?></div>
                            <div class="mb-4">
                            <label class="form-label" >Заголовок вашего поста</label>
                            <div><?=$getMessageBlogForEdit[0]['title']?></div>
                            </div>    
                            <div class="mb-4">
                            <label for="text">Текст:</label><br>
                            <div><?=$getMessageBlogForEdit[0]['text']?></div>
                            </div>
                            <div class="mb-4">
                            <img src="<?="/" . $getMessageBlogForEdit[0]['img']?>" alt="" width="200" >
                            <label class="form-label" ></label>
                            </div>
                            <div>
                                <?php $_SESSION['id'] = $_GET['id'];?>
                            </div>
                            <div class="mb-4">
                            <?php if ($_SESSION['user']['id'] == $getMessageBlogForEdit[0]['userId']) {
                                    ?> <button type="submit" class="btn btn-secondary btn-lg btn-block">Удалить пост</button> <?php
                                } ?>
                            </div>
                            <?php
                                if (isset($_SESSION['messageFromBlog'])) {
                                    echo ' <p class="msg"> ' . $_SESSION['messageFromBlog'] . ' </p>' ;
                                }
                                unset($_SESSION['messageFromBlog']);
                            ?>
                                На страницу вашего <a href="/templates/profile.php" class="text-secondary">профиля</a>
                            </div>
                        </form>    
                    </div>
                    <div class="col-md">
                        <!--Один из трех столбцов-->
                    </div>
                </div>
            </div>
        </main>
        <?php require $_SERVER['DOCUMENT_ROOT'] . "/templates/footer.php"?>
    </body>
</html>
