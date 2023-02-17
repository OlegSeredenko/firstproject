<?php
if (isset($_SESSION['user'])) {
    header('Location: /profile');
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
                        <!--Один из трех столбцов-->
                    </div>
                    <div class="col-md">
                        <form action="/templates/signup.php" method="post" enctype="multipart/form-data" >
                            <div class="mb-4">
                            <label class="form-label" >ФИО</label>
                            <input type="text" name="fullname" placeholder="Введите своё полное имя" class="form-control">
                            </div>
                            <div class="mb-4">
                            <label class="form-label" >Логин</label>
                            <input type="text" name="login" placeholder="Введите логин" class="form-control">
                            </div>
                            <div class="mb-4">
                            <label class="form-label" >Email</label>
                            <input type="email" name="email" placeholder="Введите свою почту" class="form-control">
                            <div id="emailHelp" class="form-text">Мы никогда никому не передадим вашу электронную почту.</div>
                            </div>
                            <div class="mb-4">
                            <label class="form-label" >Изображение профиля</label>
                            <input type="file" name="avatar" class="form-control">
                            </div>
                            <div class="mb-4">
                            <label class="form-label" >Пароль</label>
                            <input type="password" name="password"  placeholder="Введите пароль" class="form-control">
                            <div id="passwordHelpBlock" class="form-text">
                            Ваш пароль должен быть длиной от 4 символов, содержать только буквы или цифры (не должен содержать пробелов, специальных символов или эмодзи).
                            </div>
                            </div>
                            <div class="mb-4">
                            <label class="form-label" >Подтверждение пароля</label>
                            <input type="password" name="password_confirm" placeholder="Введите пароль ещё раз" class="form-control">
                            </div>
                            <div class="mb-4">
                            <button type="submit" class="btn btn-secondary btn-lg btn-block">Зарегистрироваться</button>
                            </div>
                            <div>
                                У вас уже есть аккаунт? - <a href="/signin" class="text-secondary">авторизируйтесь</a>
                            </div>
                            <div>
                            <?php
                                if (isset($_SESSION['message'])) {
                                    echo ' <p class="msg"> ' . $_SESSION['message'] . ' </p>' ;
                                }
                                unset($_SESSION['message']);
                            ?>
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