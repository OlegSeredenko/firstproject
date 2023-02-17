<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/connect.php';

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
                        <form action="/templates/toBlogHandler.php" method="post" enctype="multipart/form-data">
                            <div><?php if (!isset($_SESSION['user'])) {
                            echo '<p class="msg">' . "Записи в блог могут оставлять только авторизированные пользователи" . '</p>';}?></div>
                            <div class="mb-4">
                            <label class="form-label" >Заголовок вашего поста</label>
                            <input type="text" name="titleBlog" placeholder="Введите заговолок" class="form-control">
                            </div>    
                            <div class="mb-4">
                            <label for="text">Текст:</label><br>
			                <textarea type="text" name="textareaBlog" placeholder="Введите ваш текст" class="form-control" rows="15" cols="45"></textarea>
                            </div>
                            <div class="mb-4">
                            <label class="form-label" >Изображение для поста (обязательно для загрузки)</label>
                            <input type="file" name="imageBlog" class="form-control">
                            </div>
                            <div class="mb-4">
                            <button type="submit" class="btn btn-secondary btn-lg btn-block">Отправить пост</button>
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
