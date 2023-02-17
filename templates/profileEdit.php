<?php
//почему-то если раскомментировать 3 строки ниже, то происходит зацикливание (потом проверю)
/*
if (isset($_SESSION['user'])) {
    header('Location: /profileEdit');
}*/

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
                        <!--Один из трех столбцов-->
                    </div>
                    <div class="col-md">

                            <div class="mb-4">
                            <form action="/templates/profileEditHandler.php" method="post" enctype="multipart/form-data" >
                                <div><h3>Редактирование профиля</h3></div>
                                <img src="<?= $_SESSION['user']['avatar'] ?>" class="rounded mx-auto d-block" width="250" alt="avatar">
                                <div class="mb-4">
                                <label class="form-label" >Загрузить новое изображение профиля</label>
                                <input type="file" name="newAvatar" class="form-control">
                                </div>
                                <div><h2><?= $_SESSION['user']['fullname'] ?> </h2></div>
                                <div class="mb-4">
                                    <label class="form-label" >Вы можете изменить имя пользователя (логин,с помощью которого вы авторизовались, не изменится)</label>
                                    <input type="text" name="newFullname"  placeholder="Введите новое имя" class="form-control">
                                </div>
                                <div><a href="#" class="text-dark"><?= $_SESSION['user']['email']?></a></div>
                                <div class="mb-4">
                                    <label class="form-label" >Вы можете изменить почту пользователя</label>
                                    <input type="email" name="newEmail"  placeholder="Введите новую почту" class="form-control">
                                </div>
                                <div class="mb-4">
                                <button type="submit" class="btn btn-secondary btn-lg btn-block">Отправить новые данные</button>
                                </div>
                                <a href="/templates/logout.php" class="logout text-dark" >Выход</a>
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
