<?php
require_once('helpers.php'); //Подключение сценария с ф-циями

date_default_timezone_set('Europe/Kiev'); //Установка часового пояса по умолчанию

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
function dateCreatePost($date1, $date2, $index)
{
	$dateNow = date_create($date1); // Создание экземпляра текущей даты
	$datePost = date_create($date2); // Создание экземпляра даты размещения поста

	$diff = date_diff($dateNow, $datePost); // Вычисление экземпляра временного промежутка 

	//Выбор форматирования экземпляра временного промежутка для постов
	switch ($date2) {
	case $index == 0:
		$minutes_count = date_interval_format($diff, "%i"); //Приводим интервал к нужному формату
		return $minutes_count . get_noun_plural_form($minutes_count, ' минуту ', ' минуты ', ' минут ') . 'назад'; //Выводим дату в нужном формате
		break;
	case $index == 1:
		$hours_count = date_interval_format($diff, "%h");
		return $hours_count . get_noun_plural_form($hours_count, ' час ', ' часа ', ' часов ') . 'назад';
		break;
	case $index == 2:
		$days_count = date_interval_format($diff, "%d");
		return $days_count . get_noun_plural_form($days_count, ' день ', ' дня ', ' дней ') . 'назад';
		break;
	case $index == 3:
		$month_count = date_interval_format($diff, "%m");
		return $month_count . get_noun_plural_form($month_count, ' месяц ', ' месяца ', ' месяцев ') . 'назад';
		break;
	case $index == 4:
		$year_count = date_interval_format($diff, "%y");
		return $year_count . get_noun_plural_form($year_count, ' год ', ' года ', ' лет ') . 'назад';
		break;
	}
}

$page_content = include_template('main.php', ['arrayPopular' => $arrayPopular]); //Включение шаблона страницы со списком постов

//Включение лейаута с основым содержимым страницы, title для страницы
$layout_content = include_template('layout.php', ['content' => $page_content, 'title' => 'readme: популярное', 'is_auth' => $is_auth]);

print($layout_content); //Вывод итогового содержимого лейаута
