<?php

echo "=========== Работа с SQL <br> <br> =========";

// подключаемся к базе данных через PDO, но можно и через mySQLi. PDO и mySQLi встроено в php 

// узнаём хост
$link = "http://127.0.0.1/openserver/phpmyadmin/index.php?route=/table/sql&db=wayup&table=articles";
// parse_url — Разбирает URL и возвращает его компоненты. PHP_URL_HOST - хост
// var_dump(parse_url($link, PHP_URL_HOST)); // 127.0.0.1
$host = parse_url($link, PHP_URL_HOST); // 127.0.0.1



echo "=========== подключаемся к бд <br> <br> =========";

// подключаемся к бд wayup
// создаём экземляр класса PDO (объект)
// $db = new PDO("mysql:host=хост;dbname=название_бд", "логин", "пароль"); 
$db = new PDO("mysql:host=$host;dbname=wayup", "root", "");



echo "=========== Добавление новых полей в таблицу INSERT <br> <br> =============================";

// Добавляем в таблицу articles новое поле, в котором поля title, body , category, created_at имеют значения: Заголовок, Основной текст, Новая категория, CURRENT_TIMESTAMP, соответственно
// ковычки здесь внутри двойных сначала обратные (или без кавычек), а потом обычные (обязательно), иначе ошибка!!!!
// этот метод небезопасен!
// $db->query("INSERT INTO `articles` (`title`, `body`, `category`, `created_at`) VALUES ('Заголовок', 'Основной текст', 'Новая категория', CURRENT_TIMESTAMP)");

// безопасный метод добавления prepare()
// метод execute используется для добавления данных (execute - выполнять)
// :title, :body, :category - ключи 
$insert = $db->prepare("INSERT INTO `articles` (`title`, `body`, `category`, `created_at`) VALUES (:title, :body, :category, CURRENT_TIMESTAMP)");
$insert->execute([
    ":title" => "TEST_title",
    ":body" => "TEST_body",
    ":category" => "TEST_category",
]);



echo "=============== Получаем данные SELECT <br> <br> ===============================";

// получаем данные под id = 45. fetch - принести
$id = 9;
// обратные ковычки писать не обязательно
$article = $db->prepare("SELECT * FROM articles WHERE id=:id");
$article->execute([':id' => $id]);
$arr = $article->fetch(PDO::FETCH_ASSOC);
echo "<pre>";
print_r($arr);
echo "</pre>";

// Array
// (
// [id] => 45
// [title] => TEST_title
// [body] => TEST_body
// [category] => TEST_category
// [created_at] => 2024-10-31 21:52:10
// ) 

// выполняем sql запрос к базе данных wayup ($db), далее это всё перезаписываем в переменную $articles
$articles = $db->query("SELECT * FROM `articles`");

// print_r печатает любую перемнную (массивы и т.д.)
print_r($articles); // PDOStatement Object ( [queryString] => SELECT * FROM `articles` )
var_dump($articles); // PDOStatement Object ( [queryString] => SELECT * FROM `articles` )
echo "<br> <br>";

// получаем все данные из таблицы (fetchAll())
$articles = $db->query("SELECT * FROM `articles`")->fetchAll();

// чтобы убрать индексные массивы, которые повторяют даные, к предыдущей записи добавляем fetchAll(PDO::FETCH_ASSOC)
$articles = $db->query("SELECT * FROM `articles`")->fetchAll(PDO::FETCH_ASSOC);

foreach ($articles as $article) {
    echo "<div style='background: antiquewhite; margin: 10px;'>";
    echo "ID: {$article['id']} <br>";
    echo "title: {$article['title']} <br>";
    echo "body: {$article['body']} <br>";
    echo "<br>";
    echo "</div>";
}

echo "<pre>";
print_r($articles);
echo "</pre>";

// Array
// (
// [0] => Array
// (
// [id] => 1
// [title] => test
// [body] => some text some text
// [category] => test category
// [created_at] => 2024-10-30 15:53:40
// )
// 
// [1] => Array
// (
// [id] => 5
// [title] => выфвыф
// [body] => sadsad
// [category] => Без категории
// [created_at] => 2024-10-30 16:18:37
// )
// 
// [2] => Array
// (
// [id] => 8
// [title] => sadsad
// [body] => qwe12
// [category] => Без категории
// [created_at] => 2024-10-30 16:18:58
// )
// 
// [3] => Array
// (
// [id] => 9
// [title] => 21ed
// [body] => 12de21
// [category] => Без категории
// [created_at] => 2024-10-30 16:19:10
// )
// 
// ) 




echo "================= Изменяем данные UPDATE <br> <br> ===================";

$update = $db->prepare("UPDATE `articles` SET `title` = :title, `body` = :body, `category` = :category WHERE `id` = :id");
$update->execute([
    ":title" => "Title_TEST",
    ":body" => "<p style='color:red;'>Кусочек текста</p>",
    ":category" => "category_TEST",
    ":id" => 8,
]);



echo "================= УДАЛЕНИЕ ЗАПИСЕЙ DELETE <br> <br> ===================";

$delete = $db->prepare("DELETE FROM articles WHERE id = :id");
$delete->execute([
    ":id" => 80
]);
