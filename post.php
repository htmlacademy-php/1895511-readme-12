<?php

//Подключение сценария с ф-циями
require_once('helpers.php');

//Соединение с БД "readme"
$link = mysqli_connect("127.0.0.1", "root", "", "readme");
//Проверка соединения
if ($link == false) {
    print("Ошибка подключения: " . mysqli_connect_error()); //В случае неудачного подключения выводить ошибку
    exit;//Прекратить выполнение скрипта
}

//Проверка существования параметра запроса с ID поста
if (isset($_GET['types_content_id'])) {
    $types_content_id = $_GET['types_content_id']; //Если параметр запроса существует
}
else {
    $types_content_id = ''; //Если праметра запроса нет
}

//Выполнение запросов БД
mysqli_set_charset($link, "utf8"); //Установка кодировки
//Формирование запроса на чтение из таблицы постов
if ($types_content_id == 1) {
    $sqlToPosts = "SELECT p.dt_add, title, content, quote_autor, image, reference, name_class_icon, login, avatar_path, view FROM posts p
    JOIN types_content t ON p.type_content_id = t.id JOIN users u ON p.user_id = u.id WHERE p.type_content_id = '1'";
}
elseif ($types_content_id == 2) {
    $sqlToPosts = "SELECT p.dt_add, title, content, quote_autor, image, reference, name_class_icon, login, avatar_path, view FROM posts p
    JOIN types_content t ON p.type_content_id = t.id JOIN users u ON p.user_id = u.id WHERE p.type_content_id = '2'";
}
elseif ($types_content_id == 3) {
    $sqlToPosts = "SELECT p.dt_add, title, content, quote_autor, image, reference, name_class_icon, login, avatar_path, view FROM posts p
    JOIN types_content t ON p.type_content_id = t.id JOIN users u ON p.user_id = u.id WHERE p.type_content_id = '3'";
}
elseif ($types_content_id == 4) {
    $sqlToPosts = "SELECT p.dt_add, title, content, quote_autor, image, reference, name_class_icon, login, avatar_path, view FROM posts p
    JOIN types_content t ON p.type_content_id = t.id JOIN users u ON p.user_id = u.id WHERE p.type_content_id = '4'";
}
elseif ($types_content_id == 5) {
    $sqlToPosts = "SELECT p.dt_add, title, content, quote_autor, image, reference, name_class_icon, login, avatar_path, view FROM posts p
    JOIN types_content t ON p.type_content_id = t.id JOIN users u ON p.user_id = u.id WHERE p.type_content_id = '5'";
}
else {
    $sqlToPosts = "SELECT p.dt_add, title, content, quote_autor, image, reference, name_class_icon, login, avatar_path, view FROM posts p
    JOIN types_content t ON p.type_content_id = t.id
    JOIN users u ON p.user_id = u.id
    ORDER BY view DESC";
}
$resultPosts = mysqli_query($link, $sqlToPosts);
//Обработка ошибки запроса
if (!$resultPosts) {
    $error = mysqli_error($link);
    print("Ошибка MySQL: " . $error);
}
$rowsPosts = mysqli_fetch_all($resultPosts, MYSQLI_ASSOC); //Преобразование объекта результата в массив

//Включение шаблона страницы поста
$page_content = include_template('main-details.php', ['rowsPosts' => $rowsPosts, 'types_content_id' => $types_content_id]);

//Включение лейаута с основым содержимым страницы поста
$layout_content = include_template('layout-details.php', ['content' => $page_content, 'title' => 'readme: публикация']);

//Вывод итогового содержимого лейаута поста
print($layout_content);
