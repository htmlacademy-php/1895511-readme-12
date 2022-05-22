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
if (isset($_GET['id'])) {
    $id = $_GET['id']; //Если параметр запроса существует
}
else {
    $id = ''; //Если праметра запроса нет
}

//Выполнение запросов БД
mysqli_set_charset($link, "utf8"); //Установка кодировки
//Формирование запроса на чтение из таблицы постов, лайков, комментариев
if ($id == 1) {
    $sqlToPosts = "SELECT * FROM posts p JOIN types_content t ON p.type_content_id = t.id JOIN users u ON p.user_id = u.id WHERE p.id = 1";
    $sqlToLikes = "SELECT COUNT(*) AS total_likes FROM likes WHERE post_id = 1";
    $sqlToNumComments = "SELECT COUNT(id) AS total_num_comments, post_id FROM comments WHERE post_id = 1 GROUP BY post_id";
    $sqlToSubscriptions = "SELECT COUNT(*) AS total_subscriptions FROM subscriptions WHERE autor_id = 1";
    $sqlToPublications = "SELECT COUNT(id) AS total_publications, user_id FROM posts WHERE id = 1 GROUP BY user_id";
    $sqlToHashtags = "SELECT post_id, hashtag_id, h.name FROM posts_hashtags p JOIN hashtags h ON p.hashtag_id = h.id WHERE post_id = 1";
    $sqlToComments = "SELECT c.dt_add, content, user_id, post_id, u.avatar_path, u.login FROM comments c JOIN users u ON c.user_id = u.id WHERE post_id = 1";
    $sqlToAddUsers = "SELECT dt_add FROM users WHERE id = 1";
}
elseif ($id == 2) {
    $sqlToPosts = "SELECT * FROM posts p JOIN types_content t ON p.type_content_id = t.id JOIN users u ON p.user_id = u.id WHERE p.id = 2";
    $sqlToLikes = "SELECT COUNT(*) AS total_likes FROM likes WHERE post_id = 2";
    $sqlToNumComments = "SELECT COUNT(id) AS total_num_comments, post_id FROM comments WHERE post_id = 2 GROUP BY post_id";
    $sqlToSubscriptions = "SELECT COUNT(*) AS total_subscriptions FROM subscriptions WHERE autor_id = 2";
    $sqlToPublications = "SELECT COUNT(id) AS total_publications, user_id FROM posts WHERE id = 2 GROUP BY user_id";
    $sqlToHashtags = "SELECT post_id, hashtag_id, h.name FROM posts_hashtags p JOIN hashtags h ON p.hashtag_id = h.id WHERE post_id = 2";
    $sqlToComments = "SELECT c.dt_add, content, user_id, post_id, u.avatar_path, u.login FROM comments c JOIN users u ON c.user_id = u.id WHERE post_id = 2";
    $sqlToAddUsers = "SELECT dt_add FROM users WHERE id = 2";
}
elseif ($id == 3) {
    $sqlToPosts = "SELECT * FROM posts p JOIN types_content t ON p.type_content_id = t.id JOIN users u ON p.user_id = u.id WHERE p.id = 3";
    $sqlToLikes = "SELECT COUNT(*) AS total_likes FROM likes WHERE post_id = 3";
    $sqlToNumComments = "SELECT COUNT(id) AS total_num_comments, post_id FROM comments WHERE post_id = 3 GROUP BY post_id";
    $sqlToSubscriptions = "SELECT COUNT(*) AS total_subscriptions FROM subscriptions WHERE autor_id = 3";
    $sqlToPublications = "SELECT COUNT(id) AS total_publications, user_id FROM posts WHERE id = 3 GROUP BY user_id";
    $sqlToHashtags = "SELECT post_id, hashtag_id, h.name FROM posts_hashtags p JOIN hashtags h ON p.hashtag_id = h.id WHERE post_id = 3";
    $sqlToComments = "SELECT c.dt_add, content, user_id, post_id, u.avatar_path, u.login FROM comments c JOIN users u ON c.user_id = u.id WHERE post_id = 3";
    $sqlToAddUsers = "SELECT dt_add FROM users WHERE id = 3";
}
elseif ($id == 4) {
    $sqlToPosts = "SELECT * FROM posts p JOIN types_content t ON p.type_content_id = t.id JOIN users u ON p.user_id = u.id WHERE p.id = 4";
    $sqlToLikes = "SELECT COUNT(*) AS total_likes FROM likes WHERE post_id = 4";
    $sqlToNumComments = "SELECT COUNT(id) AS total_num_comments, post_id FROM comments WHERE post_id = 4 GROUP BY post_id";
    $sqlToSubscriptions = "SELECT COUNT(*) AS total_subscriptions FROM subscriptions WHERE autor_id = 1";
    $sqlToPublications = "SELECT COUNT(id) AS total_publications, user_id FROM posts WHERE id = 4 GROUP BY user_id";
    $sqlToHashtags = "SELECT post_id, hashtag_id, h.name FROM posts_hashtags p JOIN hashtags h ON p.hashtag_id = h.id WHERE post_id = 4";
    $sqlToComments = "SELECT c.dt_add, content, user_id, post_id, u.avatar_path, u.login FROM comments c JOIN users u ON c.user_id = u.id WHERE post_id = 4";
    $sqlToAddUsers = "SELECT dt_add FROM users WHERE id = 1";
}
elseif ($id == 5) {
    $sqlToPosts = "SELECT * FROM posts p JOIN types_content t ON p.type_content_id = t.id JOIN users u ON p.user_id = u.id WHERE p.id = 5";
    $sqlToLikes = "SELECT COUNT(*) AS total_likes FROM likes WHERE post_id = 5 GROUP BY post_id";
    $sqlToNumComments = "SELECT COUNT(id) AS total_num_comments, post_id FROM comments WHERE post_id = 5 GROUP BY post_id";
    $sqlToSubscriptions = "SELECT COUNT(*) AS total_subscriptions FROM subscriptions WHERE autor_id = 2";
    $sqlToPublications = "SELECT COUNT(id) AS total_publications, user_id FROM posts WHERE id = 5 GROUP BY user_id";
    $sqlToHashtags = "SELECT post_id, hashtag_id, h.name FROM posts_hashtags p JOIN hashtags h ON p.hashtag_id = h.id WHERE post_id = 5";
    $sqlToComments = "SELECT c.dt_add, content, user_id, post_id, u.avatar_path, u.login FROM comments c JOIN users u ON c.user_id = u.id WHERE post_id = 5";
    $sqlToAddUsers = "SELECT dt_add FROM users WHERE id = 2";
}
else {
    http_response_code(404);
    header("HTTP/1.1 404 Not Found");
    exit;
}

//бработка запроса и соединения с БД
$resultPosts = mysqli_query($link, $sqlToPosts);
$resultLikes = mysqli_query($link, $sqlToLikes);
$resultNumComments = mysqli_query($link, $sqlToNumComments);
$resultSubscriptions = mysqli_query($link, $sqlToSubscriptions);
$resultPublications = mysqli_query($link, $sqlToPublications);
$resultHashtags = mysqli_query($link, $sqlToHashtags);
$resultComments = mysqli_query($link, $sqlToComments);
$resultAddUsers = mysqli_query($link, $sqlToAddUsers);

//Обработка ошибки запроса
if (!$resultPosts or !$resultLikes or !$resultNumComments or !$resultSubscriptions or !$resultPublications or !$resultHashtags or !$resultComments or !$resultAddUsers) {
    $error = mysqli_error($link);
    print("Ошибка MySQL: " . $error);
}

//Преобразование объекта результата в массив
$rowsPosts = mysqli_fetch_all($resultPosts, MYSQLI_ASSOC);
$rowsLikes = mysqli_fetch_all($resultLikes, MYSQLI_ASSOC);
$rowsNumComments = mysqli_fetch_all($resultNumComments, MYSQLI_ASSOC);
$rowsSubscriptions = mysqli_fetch_all($resultSubscriptions, MYSQLI_ASSOC);
$rowsPublications = mysqli_fetch_all($resultPublications, MYSQLI_ASSOC);
$rowsHashtags = mysqli_fetch_all($resultHashtags, MYSQLI_ASSOC);
$rowsComments = mysqli_fetch_all($resultComments, MYSQLI_ASSOC);
$rowsAddUsers = mysqli_fetch_all($resultAddUsers, MYSQLI_ASSOC);

//Функция для вывода даты публикации поста в относительном формате
function dateCreateComments($dateComments)
{
    $dateCurrentStamp = strtotime('now'); //метка для текущей даты
    $dateCommentsStamp = strtotime($dateComments); //метка для даты публикации

    $interval = $dateCurrentStamp - $dateCommentsStamp; //вычисление разницы между метками

    //Выбор диапазона и форматирование разницы между метками
    if ($dateCommentsStamp > strtotime('-60 minutes')) { //меньше часа
        $intervalFormat = floor(date('i', $interval)); //форматирование к нужному формату (минуты)
        $date = $intervalFormat . get_noun_plural_form($intervalFormat, ' минуту ', ' минуты ', ' минут ') . 'назад';
    } elseif ($dateCommentsStamp <= strtotime('-60 minutes') and $dateCommentsStamp > strtotime('-24 hours')) { //больше часа, но меньше суток
        $intervalFormat = floor(date('h', $interval)); //часы
        $date = $intervalFormat . get_noun_plural_form($intervalFormat, ' час ', ' часа ', ' часов ') . 'назад';
    } elseif ($dateCommentsStamp <= strtotime('-24 hours') and $dateCommentsStamp > strtotime('-7 days')) { //больше суток, но меньше недели
        $intervalFormat = floor(date('d', $interval)); //дни
        $date = $intervalFormat . get_noun_plural_form($intervalFormat, ' день ', ' дня ', ' дней ') . 'назад';
    } elseif ($dateCommentsStamp <= strtotime('-7 days') and $dateCommentsStamp > strtotime('-5 weeks')) { //больше недели, но меньше месяца
        $intervalFormat = floor(date('W', $interval)); //недели
        $date = $intervalFormat . get_noun_plural_form($intervalFormat, ' неделю ', ' недели ', ' недель ') . 'назад';
    } elseif ($dateCommentsStamp <= strtotime('-5 weeks')) { //больше месяца
        $intervalFormat = floor(date('m', $interval)); //месяцы
        $date = $intervalFormat . get_noun_plural_form($intervalFormat, ' месяц ', ' месяца ', ' месяцев ') . 'назад';
    }

    return $date; //вывод даты в относительном формате
}

//Функция для вывода даты регистрации на сайте юзера относительном формате
function dateCreateUser($dateRegistration)
{
    $dateCurrentStamp = strtotime('now'); //метка для текущей даты
    $dateRegistrationStamp = strtotime($dateRegistration); //метка для даты публикации

    $interval = $dateCurrentStamp - $dateRegistrationStamp; //вычисление разницы между метками

    //Выбор диапазона и форматирование разницы между метками
    if ($dateRegistrationStamp > strtotime('-60 minutes')) { //меньше часа
        $intervalFormat = floor(date('i', $interval)); //форматирование к нужному формату (минуты)
        $date = $intervalFormat . get_noun_plural_form($intervalFormat, ' минуту ', ' минуты ', ' минут ');
    } elseif ($dateRegistrationStamp <= strtotime('-60 minutes') and $dateRegistrationStamp > strtotime('-24 hours')) { //больше часа, но меньше суток
        $intervalFormat = floor(date('h', $interval)); //часы
        $date = $intervalFormat . get_noun_plural_form($intervalFormat, ' час ', ' часа ', ' часов ');
    } elseif ($dateRegistrationStamp <= strtotime('-24 hours') and $dateRegistrationStamp > strtotime('-7 days')) { //больше суток, но меньше недели
        $intervalFormat = floor(date('d', $interval)); //дни
        $date = $intervalFormat . get_noun_plural_form($intervalFormat, ' день ', ' дня ', ' дней ');
    } elseif ($dateRegistrationStamp <= strtotime('-7 days') and $dateRegistrationStamp > strtotime('-5 weeks')) { //больше недели, но меньше месяца
        $intervalFormat = floor(date('W', $interval)); //недели
        $date = $intervalFormat . get_noun_plural_form($intervalFormat, ' неделю ', ' недели ', ' недель ');
    } elseif ($dateRegistrationStamp <= strtotime('-5 weeks')) { //больше месяца
        $intervalFormat = floor(date('m', $interval)); //месяцы
        $date = $intervalFormat . get_noun_plural_form($intervalFormat, ' месяц ', ' месяца ', ' месяцев ');
    }

    return $date; //вывод даты в относительном формате
}


//Включение шаблона страницы поста
$page_content = include_template('main-details.php', ['rowsPosts' => $rowsPosts, 'rowsLikes' => $rowsLikes, 'rowsNumComments' => $rowsNumComments,
    'rowsSubscriptions' => $rowsSubscriptions, 'rowsPublications' => $rowsPublications, 'rowsHashtags' => $rowsHashtags, 'rowsComments' => $rowsComments,
    'rowsAddUsers' => $rowsAddUsers, 'id' => $id]);

//Включение лейаута с основым содержимым страницы поста
$layout_content = include_template('layout-details.php', ['content' => $page_content, 'title' => 'readme: публикация']);

//Вывод итогового содержимого лейаута поста
print($layout_content);
