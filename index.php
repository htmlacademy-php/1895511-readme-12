<?php

//Подключение сценария с ф-циями
require_once('helpers.php');

//Установка часового пояса по умолчанию
date_default_timezone_set('Europe/Kiev');

//Установка моего имени
$user_name = 'Тарас Самойленко';

//Выбор числа 0 или 1 (для отображения шапки)
$is_auth = rand(0, 1);

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
    $sqlToPosts = "SELECT p.id, p.dt_add, title, content, quote_autor, image, reference, name_class_icon, login, avatar_path, view FROM posts p
    JOIN types_content t ON p.type_content_id = t.id JOIN users u ON p.user_id = u.id WHERE p.type_content_id = '1'";
}
elseif ($types_content_id == 2) {
    $sqlToPosts = "SELECT p.id, p.dt_add, title, content, quote_autor, image, reference, name_class_icon, login, avatar_path, view FROM posts p
    JOIN types_content t ON p.type_content_id = t.id JOIN users u ON p.user_id = u.id WHERE p.type_content_id = '2'";
}
elseif ($types_content_id == 3) {
    $sqlToPosts = "SELECT p.id, p.dt_add, title, content, quote_autor, image, reference, name_class_icon, login, avatar_path, view FROM posts p
    JOIN types_content t ON p.type_content_id = t.id JOIN users u ON p.user_id = u.id WHERE p.type_content_id = '3'";
}
elseif ($types_content_id == 4) {
    $sqlToPosts = "SELECT p.id, p.dt_add, title, content, quote_autor, image, reference, name_class_icon, login, avatar_path, view FROM posts p
    JOIN types_content t ON p.type_content_id = t.id JOIN users u ON p.user_id = u.id WHERE p.type_content_id = '4'";
}
elseif ($types_content_id == 5) {
    $sqlToPosts = "SELECT p.id, p.dt_add, title, content, quote_autor, image, reference, name_class_icon, login, avatar_path, view FROM posts p
    JOIN types_content t ON p.type_content_id = t.id JOIN users u ON p.user_id = u.id WHERE p.type_content_id = '5'";
}
else {
    $sqlToPosts = "SELECT p.id, p.dt_add, title, content, quote_autor, image, reference, name_class_icon, login, avatar_path, view FROM posts p
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

//Функция, обрабатывающая текст (длину до 300 символов)
function sizePost($text, $length = 300)
{
    $textLength = strlen($text); //Кол-во символов в тексте поста
    if ($textLength <= $length) { //Выводим тескт, если кол-во символов не превышает 300
        return $text;
    }
    $symbols = explode(" ", $text); //Разбиваем текст, с пробелами
    $count = 0; //Переменная счётчик, для подсчёта символов
    foreach ($symbols as $i => $value) { //Проходимся по массиву
        $count += strlen($value) + 1; //Суммируем символы элементов массива, учитывая пробелы
        $arrayWords[] =  $symbols[$i]; //Массив, содержаший слова, которые будут выведены в карточке
        if ($count > $length) { //Выход из цикла по условию превышения текста в 300 символов
            break;
        }
    }
    $correctPost = implode(" ", $arrayWords) . "..."; //Склеиваем слова в строку
    return $correctPost . '<a class="post-text__more-link" href="#">Читать далее</a>'; //Вывод кнопки - Читать далее
}

//Функция для вывода даты публикации поста в относительном формате
function dateCreatePost($datePublish)
{
    $dateCurrentStamp = strtotime('now'); //метка для текущей даты
    $datePublishStamp = strtotime($datePublish); //метка для даты публикации

    $interval = $dateCurrentStamp - $datePublishStamp; //вычисление разницы между метками

    //Выбор диапазона и форматирование разницы между метками
    if ($datePublishStamp > strtotime('-60 minutes')) { //меньше часа
        $intervalFormat = floor(date('i', $interval)); //форматирование к нужному формату (минуты)
        $date = $intervalFormat . get_noun_plural_form($intervalFormat, ' минуту ', ' минуты ', ' минут ') . 'назад';
    } elseif ($datePublishStamp <= strtotime('-60 minutes') and $datePublishStamp > strtotime('-24 hours')) { //больше часа, но меньше суток
        $intervalFormat = floor(date('h', $interval)); //часы
        $date = $intervalFormat . get_noun_plural_form($intervalFormat, ' час ', ' часа ', ' часов ') . 'назад';
    } elseif ($datePublishStamp <= strtotime('-24 hours') and $datePublishStamp > strtotime('-7 days')) { //больше суток, но меньше недели
        $intervalFormat = floor(date('d', $interval)); //дни
        $date = $intervalFormat . get_noun_plural_form($intervalFormat, ' день ', ' дня ', ' дней ') . 'назад';
    } elseif ($datePublishStamp <= strtotime('-7 days') and $datePublishStamp > strtotime('-5 weeks')) { //больше недели, но меньше месяца
        $intervalFormat = floor(date('W', $interval)); //недели
        $date = $intervalFormat . get_noun_plural_form($intervalFormat, ' неделю ', ' недели ', ' недель ') . 'назад';
    } elseif ($datePublishStamp <= strtotime('-5 weeks')) { //больше месяца
        $intervalFormat = floor(date('m', $interval)); //месяцы
        $date = $intervalFormat . get_noun_plural_form($intervalFormat, ' месяц ', ' месяца ', ' месяцев ') . 'назад';
    }

    return $date; //вывод даты в относительном формате
}

//Включение шаблона страницы со списком популярных постов
$page_content = include_template('main-popular.php', ['rowsPosts' => $rowsPosts, 'types_content_id' => $types_content_id]);

//Включение лейаута с основым содержимым страницы со списком популярных постов
$layout_content = include_template('layout-popular.php', ['content' => $page_content, 'title' => 'readme: популярное', 'is_auth' => $is_auth]);

//Вывод итогового содержимого лейаута популярных постов
print($layout_content);
