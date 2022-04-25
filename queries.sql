/****************************************
*Запросы для добавления данных в таблицы*
****************************************/

/*
Добавление пользователей в таблицу с пользователями, а также необходимых данных о пользователях
*/
INSERT INTO users SET dt_add = '2020-10-10 10:00:00', email = 'qwerty@gmail.com', `password` = '12345', login = 'vova',
                      avatar_path = 'https://imgur.com/gallery/CXmZzBF';
INSERT INTO users SET dt_add = '2020-11-10 10:00:00', email = 'ytrewq@gmail.com', `password` = '54321', login = 'kolya',
                      avatar_path = 'https://imgur.com/gallery/w3vlh';

/*
Добавление типов контента в соответствующую таблицу
*/
INSERT INTO types_content SET `name` = 'Текст', name_class_icon = 'text';
INSERT INTO types_content SET `name` = 'Цитата', name_class_icon = 'quote';
INSERT INTO types_content SET `name` = 'Картинка', name_class_icon = 'photo';
INSERT INTO types_content SET `name` = 'Видео', name_class_icon = 'video';
INSERT INTO types_content SET `name` = 'Ссылка', name_class_icon = 'link';


/*
Добавление постов в таблицу с постами, а также необходимых данных в соответствии с типом поста
*/
INSERT INTO posts SET dt_add = '2020-10-10 11:00:00', title = 'Цитата',
                      content = 'Мы в жизни любим только раз, а после ищем лишь похожих', quote_autor = 'Лариса',
                      user_id = '1', type_content_id = '2';/*Внешние ключи для связи с пользователем и типом контента*/
INSERT INTO posts SET dt_add = '2020-10-11 11:00:00', title = 'Игра престолов',
                      content = 'Lorem ipsum dolor sit amet consectetur adipiscing, elit enim blandit etiam taciti, metus interdum magnis nulla lacinia.',
                      user_id = '2', type_content_id = '1';
INSERT INTO posts SET dt_add = '2020-10-12 11:00:00', title = 'Наконец, обработал фотки!',
                      image = 'rock-medium.jpg',
                      user_id = '1', type_content_id = '3';
INSERT INTO posts SET dt_add = '2020-10-13 11:00:00', title = 'Моя мечта',
                      image = 'coast-medium.jpg',
                      user_id = '2', type_content_id = '3';
INSERT INTO posts SET dt_add = '2020-10-14 11:00:00', title = 'Моя мечта',
                      `reference` = 'http://www.htmlacademy.ru/',
                      user_id = '1', type_content_id = '5';

/*
Добавление комментариев в соответствующую таблицу
*/
INSERT INTO comments SET dt_add = '2020-10-10 12:00:00',
                         content = 'Мне нравится. Это лучшее, что я видел за последний месяц.',
                         user_id = '1', post_id = '3';/*Внешние ключи для связи с пользователем и постом*/
INSERT INTO comments SET dt_add = '2020-10-10 12:00:00',
                         content = 'Выдающаяся цитата великого человека. Однозначно - лайк.',
                         user_id = '1', post_id = '1';

/**************************
*Запросы на выборку данных*
**************************/

/*
Список постов с сортировкой по популярности и вместе с именами авторов и типом контента
*/
SELECT p.id, login, name, view FROM posts p JOIN users u ON p.user_id = u.id JOIN types_content t ON p.type_content_id = t.id
ORDER BY view ASC;

/*
Получить список постов для конкретного пользователя
*/
SELECT * FROM posts WHERE user_id = 1;

/*
Получить список комментариев для одного поста, в комментариях должен быть логин пользователя
*/
SELECT c.id, login, c.dt_add, content, post_id FROM comments c JOIN users u ON c.user_id = u.id;

/*
добавить лайк к посту
*/
INSERT INTO likes (user_id, post_id) VALUES ('2', '4');

/*
Подписаться на пользователя.
*/
INSERT INTO subscriptions (user_id, autor_id) VALUES ('2', '1');
