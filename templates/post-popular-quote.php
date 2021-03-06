<header class="post__header">
    <h2>
        <a href="http://1895511-readme-12/post.php/?id=<?= $row['id']; ?>">
            <?= $row['title']; ?>
        </a>
    </h2>
</header>
<div class="post__main">
    <blockquote>
        <p>
            <?= htmlspecialchars($row['content']) ?>
        </p>
        <cite><?= $row['quote_autor']; ?></cite>
    </blockquote>
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
