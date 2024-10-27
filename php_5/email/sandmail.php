<?php

if($_POST["capcha"] != 63) {
    // header - перенаправляет на страницу
    header("location: index.html");
    exit();
}

if($_POST["subject"] == 1) {
    $subject = "Вопрос по уроку";
}
else if($_POST["subject"] == 2) {
    $subject = "Личный вопрос";
}
else if($_POST["subject"] == 3) {
    $subject = "Благодарность";
}
else {
    $subject = "Вопрос по уроку";
}

// кому отправляем письмо
$to = "o.nas23@mail.ru";
// от кого отравляем письмо, других проверок не требуется, т.к. email в html5 всё учитывает
$from = trim($_POST["email"]);

// исключаем ввод кода
$message = htmlspecialchars($_POST["message"]);
// исключаем ввод адресов
$message = urldecode($message);
$message = trim($message);

$headers = "From $from" . "\r\n" . "Reply-to: $from" . "\r\n" . "X-mailer: PHP/" . phpversion();

if(mail($to, $subject, $message, $headers)) {
    echo "<p style='color:red'> Письмо отправлено </p>";
}
else {
    echo "Письмо НЕ отправлено";
}
