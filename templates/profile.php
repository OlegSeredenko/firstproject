<?php
if (!isset($_SESSION['user'])) {
    header('Location: /signin');
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
                        <form>
                            <div class="mb-4">
                                <img src="<? if (isset($_SESSION['user']['avatar'])) 
                                { echo $_SESSION['user']['avatar']; }?>" 
                                class="rounded mx-auto d-block" width="250" alt="avatar">
                                <div><h2><? if (isset($_SESSION['user']['fullname'])) 
                                { echo $_SESSION['user']['fullname']; }?> </h2></div>
                                <div><a href="#" class="text-dark"><? if (isset($_SESSION['user']['email'])) 
                                { echo $_SESSION['user']['email']; } ?></a></div>
                                <div><a href="/profileEdit" class="text-dark">Редактировать профиль</a></div>
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
