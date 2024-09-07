

<?php


// Функции для работы с символами в PHP | Базовый курс PHP-7

$str = "function is a great instrument for solution kata in PHP";
$res = substr($str, strpos($str, "sol")); // solution kata in PHP
var_dump($res);

$str_new = str_replace("PHP", "Java", $str); // "function is a great instrument for solution kata in Java"
var_dump($str_new);

$ex = "   hello     word     
";
var_dump(trim($ex)); // "hello     word" - используется для форм
echo PHP_EOL;


// Работа с НТМL-кодом в PHP | Базовый курс PHP-7

// работает в браузере как html
$str_html = "<p>Строка, которая <strong>содержит</strong> теги</p>";
echo $str_html;

?>
// php работает html
<h2><?php echo $str_html; ?></h2>;

<?php


// 06.09 - 60 мин Функции для работы с символами в PHP | Базовый курс PHP-7 и Работа с НТМL-кодом в PHP | Базовый курс PHP-7 
Посмотреть ещё раз видео про работу с формами Работа с НТМL-кодом в PHP | Базовый курс PHP-7 
