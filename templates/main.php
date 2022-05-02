<?php
//Соединение с БД "readme"
$link = mysqli_connect("127.0.0.1", "root", "", "readme");
//Проверка соединения
if ($link == false) {
    print("Ошибка подключения: " . mysqli_connect_error()); //В случае неудачного подключения выводить ошибку
}
else {
    //Выполнение запросов
    mysqli_set_charset($link, "utf8"); //Установка кодировки
    //Формирование запроса на чтение из таблицы постов
    $sqlToPosts = "SELECT p.dt_add, title, content, quote_autor, image, reference, name_class_icon, login, avatar_path, view FROM posts p
    JOIN types_content t ON p.type_content_id = t.id
    JOIN users u ON p.user_id = u.id
    ORDER BY view DESC";
    $resultPosts = mysqli_query($link, $sqlToPosts);
    //Обработка ошибки запроса
    if (!$resultPosts) {
        $error = mysqli_error($link);
        print("Ошибка MySQL: " . $error);
    }
    $rowsPosts = mysqli_fetch_all($resultPosts, MYSQLI_ASSOC); //Преобразование объекта результата в массив
}
?>

<div class="container">
	<h1 class="page__title page__title--popular">Популярное</h1>
</div>
<div class="popular container">
	<div class="popular__filters-wrapper">
		<div class="popular__sorting sorting">
			<b class="popular__sorting-caption sorting__caption">Сортировка:</b>
			<ul class="popular__sorting-list sorting__list">
				<li class="sorting__item sorting__item--popular">
					<a class="sorting__link sorting__link--active" href="#">
						<span>Популярность</span>
						<svg class="sorting__icon" width="10" height="12">
							<use xlink:href="#icon-sort"></use>
						</svg>
					</a>
				</li>
				<li class="sorting__item">
					<a class="sorting__link" href="#">
						<span>Лайки</span>
						<svg class="sorting__icon" width="10" height="12">
							<use xlink:href="#icon-sort"></use>
						</svg>
					</a>
				</li>
				<li class="sorting__item">
					<a class="sorting__link" href="#">
						<span>Дата</span>
						<svg class="sorting__icon" width="10" height="12">
							<use xlink:href="#icon-sort"></use>
						</svg>
					</a>
				</li>
			</ul>
		</div>
		<div class="popular__filters filters">
			<b class="popular__filters-caption filters__caption">Тип контента:</b>
			<ul class="popular__filters-list filters__list">
				<li class="popular__filters-item popular__filters-item--all filters__item filters__item--all">
					<a class="filters__button filters__button--ellipse filters__button--all filters__button--active" href="#">
						<span>Все</span>
					</a>
				</li>
				<li class="popular__filters-item filters__item">
					<a class="filters__button filters__button--photo button" href="#">
						<span class="visually-hidden">Фото</span>
						<svg class="filters__icon" width="22" height="18">
							<use xlink:href="#icon-filter-photo"></use>
						</svg>
					</a>
				</li>
				<li class="popular__filters-item filters__item">
					<a class="filters__button filters__button--video button" href="#">
						<span class="visually-hidden">Видео</span>
						<svg class="filters__icon" width="24" height="16">
							<use xlink:href="#icon-filter-video"></use>
						</svg>
					</a>
				</li>
				<li class="popular__filters-item filters__item">
					<a class="filters__button filters__button--text button" href="#">
						<span class="visually-hidden">Текст</span>
						<svg class="filters__icon" width="20" height="21">
							<use xlink:href="#icon-filter-text"></use>
						</svg>
					</a>
				</li>
				<li class="popular__filters-item filters__item">
					<a class="filters__button filters__button--quote button" href="#">
						<span class="visually-hidden">Цитата</span>
						<svg class="filters__icon" width="21" height="20">
							<use xlink:href="#icon-filter-quote"></use>
						</svg>
					</a>
				</li>
				<li class="popular__filters-item filters__item">
					<a class="filters__button filters__button--link button" href="#">
						<span class="visually-hidden">Ссылка</span>
						<svg class="filters__icon" width="21" height="18">
							<use xlink:href="#icon-filter-link"></use>
						</svg>
					</a>
				</li>
			</ul>
		</div>
	</div>

    <div class="popular__posts">
        <?php foreach ($rowsPosts as $row) : ?>
            <article class="popular__post post <?= $row['name_class_icon']; ?>">
                <header class="post__header">
                    <h2>
                        <?= $row['title']; ?>
                    </h2>
                </header>
                <div class="post__main">

                    <!-- Карточка поста цитаты -->
                    <?php if ($row['name_class_icon'] == 'post-quote') : ?>
                        <blockquote>
                            <p>
                                <?= htmlspecialchars($row['content']) ?>
                            </p>
                            <cite><?= $row['quote_autor']; ?></cite>
                        </blockquote>

                        <!-- Карточка поста ссылки -->
                    <?php elseif ($row['name_class_icon'] == 'post-link') : ?>
                        <div class="post-link__wrapper">
                            <a class="post-link__external" href="http://" title="Перейти по ссылке">
                                <div class="post-link__info-wrapper">
                                    <div class="post-link__icon-wrapper">
                                        <img src="https://www.google.com/s2/favicons?domain=vitadental.ru" alt="Иконка">
                                    </div>
                                    <div class="post-link__info">
                                        <h3>
                                            <?= $row['title']; ?>
                                        </h3>
                                    </div>
                                </div>
                                <span>
                                    <?= htmlspecialchars($row['reference']) ?>
                                </span>
                            </a>
                        </div>

                        <!-- Карточка поста фото -->
                    <?php elseif ($row['name_class_icon'] == 'post-photo') : ?>
                        <div class="post-photo__image-wrapper">
                            <img src="img/<?= htmlspecialchars($row['image']) ?>" alt="Фото от пользователя" width="360" height="240">
                        </div>

                        <!-- Карточка поста текста -->
                    <?php elseif ($row['name_class_icon'] == 'post-text') : ?>
                        <p>
                            <!-- Вызов функции, обрабатывающей текст -->
                            <?= sizePost(htmlspecialchars($row['content'] ?? '')) ?>
                        </p>

                        <!-- Карточка поста видео -->
                    <?php else : ?>
                        <div class="post-video__block">
                            <div class="post-video__preview">
                                <?= embed_youtube_cover('https://www.youtube.com/watch?v=lbtozW0anQ4'); ?>
                                <img src="img/coast-medium.jpg" alt="Превью к видео" width="360" height="188">
                            </div>
                            <a href="post-details.html" class="post-video__play-big button">
                                <svg class="post-video__play-big-icon" width="14" height="14">
                                    <use xlink:href="#icon-video-play-big"></use>
                                </svg>
                                <span class="visually-hidden">Запустить проигрыватель</span>
                            </a>
                        </div>

                    <?php endif; ?>
                </div>
                <footer class="post__footer">
                    <div class="post__author">
                        <a class="post__author-link" href="#" title="Автор">
                            <div class="post__avatar-wrapper">
                                <img class="post__author-avatar" src="img/<?= $row['avatar_path']; ?>" alt="Аватар пользователя">
                            </div>
                            <div class="post__info">
                                <b class="post__author-name">
                                    <?= $row['login']; ?>
                                </b>
                                <!-- Информация о дате публикации -->
                                <time class="post__time" datetime="<?= $row['dt_add']; ?>" title="<?= date('d.m.Y H:i', strtotime($row['dt_add'])) ?>">
                                    <p>
                                        <!-- Вывод даты поста в относительном формате -->
                                        <?= dateCreatePost($row['dt_add']); ?>
                                    </p>
                                </time>
                            </div>
                        </a>
                    </div>
                    <div class="post__indicators">
                        <div class="post__buttons">
                            <a class="post__indicator post__indicator--likes button" href="#" title="Лайк">
                                <svg class="post__indicator-icon" width="20" height="17">
                                    <use xlink:href="#icon-heart"></use>
                                </svg>
                                <svg class="post__indicator-icon post__indicator-icon--like-active" width="20" height="17">
                                    <use xlink:href="#icon-heart-active"></use>
                                </svg>
                                <span>0</span>
                                <span class="visually-hidden">количество лайков</span>
                            </a>
                            <a class="post__indicator post__indicator--comments button" href="#" title="Комментарии">
                                <svg class="post__indicator-icon" width="19" height="17">
                                    <use xlink:href="#icon-comment"></use>
                                </svg>
                                <span>0</span>
                                <span class="visually-hidden">количество комментариев</span>
                            </a>
                        </div>
                    </div>
                </footer>
            </article>
        <?php endforeach; ?>
    </div>
</div>
