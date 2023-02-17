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
                        <form action="/signin" method="post" >
                            <div class="mb-4">
                            <label class="form-label" >Логин</label>
                            <input type="text" name="login" placeholder="Введите логин" class="form-control">
                            </div>
                            <div class="mb-4">
                            <label class="form-label" >Пароль</label>
                            <input type="password"name="password"  placeholder="Введите пароль" class="form-control">
                            </div>
                            <div class="mb-4">
                            <button type="submit" class="btn btn-secondary btn-lg btn-block">авторизируйтесь</button>
                            </div>
                            <div>
                                У вас нет аккаунта? - <a href="/register" class="text-secondary">зарегистрируйтесь</a>
                            </div>
                            <?php
                                if (isset($_SESSION['message'])) {
                                    echo ' <p class="msg"> ' . $_SESSION['message'] . ' </p>' ;
                                }
                                unset($_SESSION['message']);
                            ?>
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
