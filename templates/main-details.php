<div class="container">
    <?php foreach ($rowsPosts as $row_posts): ?>
        <h1 class="page__title page__title--publication"><?=$row_posts['title'];?></h1>
        <section class="post-details">
            <h2 class="visually-hidden">Публикация</h2>
            <div class="post-details__wrapper <?=$row_posts['name_class_icon'];?>">
                <div class="post-details__main-block post post--details">
                    <!-- Шаблон поста "Фото" -->
                    <?php if ($row_posts['name_class_icon'] == 'post-photo'):
                        require('templates/post-details-photo.php');
                    ?>

                        <!-- Шаблон поста "Цитаты" -->
                    <?php elseif ($row_posts['name_class_icon'] == 'post-quote'):
                        require('templates/post-details-qoute.php');
                    ?>

                        <!-- Шаблон поста "Ссылки" -->
                    <?php elseif ($row_posts['name_class_icon'] == 'post-link'):
                        require('templates/post-details-link.php');
                    ?>

                        <!-- Шаблон поста "Текста" -->
                    <?php elseif ($row_posts['name_class_icon'] == 'post-text'):
                        require('templates/post-details-text.php');
                    ?>

                        <!-- Шаблон поста "Видео" -->
                    <?php else:
                        require('templates/post-details-video.php');
                    ?>

                    <?php endif; ?>
                    <div class="post__indicators">
                        <div class="post__buttons">
                            <?php foreach ($rowsLikes as $row_likes): ?>
                            <a class="post__indicator post__indicator--likes button" href="#" title="Лайк">
                                <svg class="post__indicator-icon" width="20" height="17">
                                    <use xlink:href="#icon-heart"></use>
                                </svg>
                                <svg class="post__indicator-icon post__indicator-icon--like-active" width="20" height="17">
                                    <use xlink:href="#icon-heart-active"></use>
                                </svg>
                                <span><?=$row_likes['total_likes'];?></span>
                                <span class="visually-hidden">количество лайков</span>
                            </a>
                            <?php endforeach; ?>
                            <?php foreach ($rowsNumComments as $row_num_comments): ?>
                            <a class="post__indicator post__indicator--comments button" href="#" title="Комментарии">
                                <svg class="post__indicator-icon" width="19" height="17">
                                    <use xlink:href="#icon-comment"></use>
                                </svg>
                                <span><?=$row_num_comments['total_num_comments'];?></span>
                                <span class="visually-hidden">количество комментариев</span>
                            </a>
                            <?php endforeach; ?>
                            <a class="post__indicator post__indicator--repost button" href="#" title="Репост">
                                <svg class="post__indicator-icon" width="19" height="17">
                                    <use xlink:href="#icon-repost"></use>
                                </svg>
                                <span>100</span>
                                <span class="visually-hidden">количество репостов</span>
                            </a>
                        </div>
                        <span class="post__view"><?=$row_posts['view'];?> просмотров</span>
                    </div>
                    <ul class="post__tags">
                        <?php foreach ($rowsHashtags as $row_hashtags): ?>
                        <li><a href="#"><?=$row_hashtags['name'];?></a></li>
                        <?php endforeach; ?>
                    </ul>
                    <div class="comments">
                        <form class="comments__form form" action="#" method="post">
                            <div class="comments__my-avatar">
                                <img class="comments__picture" src="/img/userpic-medium.jpg" alt="Аватар пользователя">
                            </div>
                            <div class="form__input-section form__input-section--error">
                                <textarea class="comments__textarea form__textarea form__input" placeholder="Ваш комментарий"></textarea>
                                <label class="visually-hidden">Ваш комментарий</label>
                                <button class="form__error-button button" type="button">!</button>
                                <div class="form__error-text">
                                    <h3 class="form__error-title">Ошибка валидации</h3>
                                    <p class="form__error-desc">Это поле обязательно к заполнению</p>
                                </div>
                            </div>
                            <button class="comments__submit button button--green" type="submit">Отправить</button>
                        </form>
                        <div class="comments__list-wrapper">
                            <ul class="comments__list">
                                <?php foreach ($rowsComments as $row_comments): ?>
                                <li class="comments__item user">
                                    <div class="comments__avatar">
                                        <a class="user__avatar-link" href="#">
                                            <img class="comments__picture" src="/img/<?=$row_comments['avatar_path'];?>" alt="Аватар пользователя">
                                        </a>
                                    </div>
                                    <div class="comments__info">
                                        <div class="comments__name-wrapper">
                                            <a class="comments__user-name" href="#">
                                                <span><?=$row_comments['login'];?></span>
                                            </a>
                                            <time class="comments__time" datetime="<?=$row_comments['dt_add'];?>"><?=dateCreateComments($row_comments['dt_add']);?></time>
                                        </div>
                                        <p class="comments__text">
                                            <?=$row_comments['content'];?>
                                        </p>
                                    </div>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                            <?php foreach ($rowsNumComments as $row_num_comments): ?>
                            <a class="comments__more-link" href="#">
                                <span>Показать все комментарии</span>
                                <sup class="comments__amount"><?=$row_num_comments['total_num_comments'];?></sup>
                            </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <div class="post-details__user user">
                    <div class="post-details__user-info user__info">
                        <div class="post-details__avatar user__avatar">
                            <a class="post-details__avatar-link user__avatar-link" href="#">
                                <img class="post-details__picture user__picture" src="/img/<?=$row_posts['avatar_path'];?>" alt="Аватар пользователя">
                            </a>
                        </div>
                        <div class="post-details__name-wrapper user__name-wrapper">
                            <a class="post-details__name user__name" href="#">
                                <span><?=$row_posts['login'];?></span>
                            </a>
                            <?php foreach ($rowsAddUsers as $row_add_users): ?>
                            <time class="post-details__time user__time" datetime="<?=$row_add_users['dt_add'];?>"><?=dateCreateUser($row_add_users['dt_add']);?> на сайте</time>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="post-details__rating user__rating">
                        <?php foreach ($rowsSubscriptions as $row_sub): ?>
                        <p class="post-details__rating-item user__rating-item user__rating-item--subscribers">
                            <span class="post-details__rating-amount user__rating-amount"><?=$row_sub['total_subscriptions'];?></span>
                            <span class="post-details__rating-text user__rating-text">подписчиков</span>
                        </p>
                        <?php endforeach; ?>
                        <?php foreach ($rowsPublications as $row_posts): ?>
                        <p class="post-details__rating-item user__rating-item user__rating-item--publications">
                            <span class="post-details__rating-amount user__rating-amount"><?=$row_posts['total_publications'];?></span>
                            <span class="post-details__rating-text user__rating-text">публикаций</span>
                        </p>
                        <?php endforeach; ?>
                    </div>
                    <div class="post-details__user-buttons user__buttons">
                        <button class="user__button user__button--subscription button button--main" type="button">Подписаться</button>
                        <a class="user__button user__button--writing button button--green" href="#">Сообщение</a>
                    </div>
                </div>
            </div>
        </section>
    <?php endforeach; ?>
</div>
