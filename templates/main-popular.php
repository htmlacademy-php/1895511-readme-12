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

                <!-- Шаблон фильтра "Все" -->
                <?php require_once('templates/filter-popular-all.php'); ?>

                <!-- Шаблон фильтра "Фото" -->
                <?php require_once('templates/filter-popular-photo.php'); ?>

                <!-- Шаблон фильтра "Видео" -->
                <?php require_once('templates/filter-popular-video.php'); ?>

                <!-- Шаблон фильтра "Текст" -->
                <?php require_once('templates/filter-popular-text.php'); ?>

                <!-- Шаблон фильтра "Цитаты" -->
                <?php require_once('templates/filter-popular-quote.php'); ?>

                <!-- Шаблон фильтра "Ссылки" -->
                <?php require_once('templates/filter-popular-link.php'); ?>

            </ul>
        </div>
    </div>

    <div class="popular__posts">
        <!-- Массив с постами -->
        <?php foreach ($rowsPosts as $row) : ?>
            <article class="popular__post post <?= $row['name_class_icon']; ?>">

                <!-- Шаблон поста "Фото" -->
                <?php if ($row['name_class_icon'] == 'post-photo'):
                    require('templates/post-popular-photo.php');
                ?>

                <!-- Шаблон поста "Цитаты" -->
                <?php elseif ($row['name_class_icon'] == 'post-quote'):
                    require('templates/post-popular-quote.php');
                ?>

                <!-- Шаблон поста "Ссылки" -->
                <?php elseif ($row['name_class_icon'] == 'post-link'):
                    require('templates/post-popular-link.php');
                ?>

                <!-- Шаблон поста "Текста" -->
                <?php elseif ($row['name_class_icon'] == 'post-text'):
                    require('templates/post-popular-text.php');
                ?>

                <!-- Шаблон поста "Видео" -->
                <?php else:
                    require('templates/post-popular-video.php');
                ?>

                <?php endif; ?>

            </article>
        <?php endforeach; ?>
    </div>
</div>
