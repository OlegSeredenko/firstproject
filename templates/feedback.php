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
                    <br>
                        <div class="form-group">
                            <div class="text-success"><?php if (isset($_SESSION['success_mail_feedbakc'])) {
                                echo $_SESSION['success_mail_feedbakc']; } ?></div><br>
                            <form action="/templates/feedbackHandler.php" method="post" name="form">
                            <input name="name_feedback" type="text" class="form-control"  placeholder="Ваше имя" />
                            <br>
                            <div class="text-danger"><?php if (isset($_SESSION['error_name_feedback'])) {
                                echo $_SESSION['error_name_feedback']; } ?></div><br>
                            <input name="email_feedback" type="email" class="form-control" placeholder="Ваша почта" />
                            <br>
                            <div class="text-danger"><?php if (isset($_SESSION['error_email_feedback'])) {
                                echo $_SESSION['error_email_feedback']; } ?></div><br>
                            <input size="30" name="header_feedback" class="form-control" type="text" placeholder="Тема" />
                            <br>
                            <div class="text-danger"><?php if (isset($_SESSION['error_header_feedback'])) {
                                echo $_SESSION['error_header_feedback']; }  ?></div><br>
                            <textarea cols="32" name="message_feedback" rows="5" class="form-control"> Текст сообщения
                            </textarea>
                            <br>
                            <input type="submit" value="Отправить" class="btn btn-secondary btn-lg btn-block"/>
                            </form>
                        </div>
                        <div>
                            Вернуться на - <a href="/signin" class="text-secondary">страницу авторизации</a>
                        </div>
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
