<?php
require_once('helpers.php'); //Подключение сценария с ф-циями

$user_name = 'Тарас Самойленко'; //Моё имя

$is_auth = rand(0, 1); //Выбор числа 0 или 1 (для отображения шапки)

//Массив содержащий информацию карточек постов
$arrayPopular = [
	//Массив, содержащий данные для карточки - цитаты
	[
		'header' => 'Цитата',
		'type' => 'post-quote',
		'content' => 'Мы в жизни любим только раз, а после ищем лишь похожих',
		'user' => 'Лариса',
		'avatar' => 'userpic-larisa-small.jpg',
		'index' => 0
	],
	//Массив, содержащий данные для карточки - текста
	[
		'header' => 'Игра престолов',
		'type' => 'post-text',
		'text' => 'Lorem ipsum dolor sit amet consectetur adipiscing, elit enim blandit etiam taciti, metus interdum magnis nulla lacinia. Malesuada feugiat tellus litora elementum habitant aptent quam viverra eget pellentesque hendrerit, fusce pulvinar lorem cursus mauris velit nascetur ad etiam sit, tortor facilisis eleifend nulla bibendum nec curae rutrum integer elit. Maximus sem justo sociosqu in maecenas sed nostra nec, tortor hendrerit class arcu luctus dapibus ac. Vel taciti fusce lacinia molestie integer semper morbi a, gravida libero arcu mus scelerisque vestibulum volutpat augue facilisi, placerat suscipit tempus et sed magna imperdiet. Vel consequat nibh varius justo mi posuere augue mus elementum penatibus volutpat, per enim taciti praesent suspendisse mattis dolor proin duis. Magna ultricies bibendum vestibulum condimentum fermentum etiam porta facilisi litora sapien dictumst lorem, elit amet dictum gravida augue tellus aptent ultrices himenaeos dui. Rhoncus dapibus placerat dictum vulputate consectetur congue neque sollicitudin, taciti quam commodo in finibus ad ornare, praesent fringilla enim curabitur porta',
		'user' => 'Владик',
		'avatar' => 'userpic.jpg',
		'index' => 1
	],
	//Массив, содержащий данные для карточки - фото
	[
		'header' => 'Наконец, обработал фотки!',
		'type' => 'post-photo',
		'content' => 'rock-medium.jpg',
		'user' => '	Виктор',
		'avatar' => 'userpic-mark.jpg',
		'index' => 2
	],
	//Массив, содержащий данные для карточки - фото
	[
		'header' => 'Моя мечта',
		'type' => 'post-photo',
		'content' => 'coast-medium.jpg',
		'user' => 'Лариса',
		'avatar' => 'userpic-larisa-small.jpg',
		'index' => 3
	],
	//Массив, содержащий данные для карточки - ссылки
	[
		'header' => 'Моя мечта',
		'type' => 'post-link',
		'content' => 'http://www.htmlacademy.ru/',
		'user' => '	Владик',
		'avatar' => 'userpic.jpg',
		'index' => 4
	]
];

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
	$dateCurrentStamp = strtotime('now');
	$datePublishStamp = strtotime($datePublish);

	$interval = $dateCurrentStamp - $datePublishStamp;

	if ($datePublishStamp > strtotime('-60 minutes')) {
		$intervalFormat = floor(date('i', $interval));
		$date = $intervalFormat . get_noun_plural_form($intervalFormat, ' минуту ', ' минуты ', ' минут ') . 'назад';
	} elseif ($datePublishStamp <= strtotime('-60 minutes') and $datePublishStamp > strtotime('-24 hours')) {
		$intervalFormat = floor(date('h', $interval));
		$date = $intervalFormat . get_noun_plural_form($intervalFormat, ' час ', ' часа ', ' часов ') . 'назад';
	} elseif ($datePublishStamp <= strtotime('-24 hours') and $datePublishStamp > strtotime('-7 days')) {
		$intervalFormat = floor(date('d', $interval));
		$date = $intervalFormat . get_noun_plural_form($intervalFormat, ' день ', ' дня ', ' дней ') . 'назад';
	} elseif ($datePublishStamp <= strtotime('-7 days') and $datePublishStamp > strtotime('-5 weeks')) {
		$intervalFormat = floor(date('W', $interval));
		$date = $intervalFormat . get_noun_plural_form($intervalFormat, ' неделю ', ' недели ', ' недель ') . 'назад';
	} elseif ($datePublishStamp <= strtotime('-5 weeks')) {
		$intervalFormat = floor(date('m', $interval));
		$date = $intervalFormat . get_noun_plural_form($intervalFormat, ' месяц ', ' месяца ', ' месяцев ') . 'назад';
	}

	return $date;
}

$page_content = include_template('main.php', ['arrayPopular' => $arrayPopular]); //Включение шаблона страницы со списком постов

//Включение лейаута с основым содержимым страницы, title для страницы
$layout_content = include_template('layout.php', ['content' => $page_content, 'title' => 'readme: популярное', 'is_auth' => $is_auth]);

print($layout_content); //Вывод итогового содержимого лейаута
