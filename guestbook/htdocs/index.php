<?php
$connection = mysqli_connect('localhost', 'root', '', 'guestbook');
$queryDB = "SELECT * FROM usercomments;";
$queryResult = mysqli_query($connection, $queryDB);

if(!empty($_GET["nameUser"]) && !empty($_GET["userMessage"]))
{
    date_default_timezone_set('Europe/Moscow');
    $date = date('d.m.Y h:i', time());

    $nameUser = mysqli_real_escape_string($connection, $_GET['nameUser']);
    $userMessage = mysqli_real_escape_string($connection, $_GET['userMessage']);

    $queryDB = "INSERT INTO usercomments VALUES ('', '$nameUser', '$userMessage', '$date');";
    mysqli_query($connection, $queryDB);
    header("Location: {$_SERVER['PHP_SELF']}"); // Перенаправление сюда же, но без параметров
}

?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <title>Guest Book</title>
</head>
<body>
<div class="field">
    <?php
    while ($res = mysqli_fetch_assoc($queryResult)) {
        echo "
        <div class=\"comment\">
        <div class=\"comment_info\">
            <div class=\"comment_time\">{$res["user_time"]}</div>
            <div class=\"comment_name\">{$res["user_name"]}</div>
        </div>
        <div class=\"comment_text\" >{$res["user_comment"]}</div>
    </div>";
    }
    ?>

    <form class="formStyle" method="get">
        <input class="formStyle_user" type="text" id="nameUser" name="nameUser" placeholder="Ваше имя">
        <input class="formStyle_comment" type="text" id="userMessage" name="userMessage" placeholder="Ваше сообщение">
        <input class="formStyle_btnSubmit" type="submit" id="submit" name="submit" value="Отправить">
    </form>

</div>
</body>
</html>