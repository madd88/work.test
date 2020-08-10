# Задание
## PHP
Создать страницу с авторизацией пользователя: логин и пароль и реализовать в ней:
возможность регистрации пользователя (email, логин, пароль, ФИО),
при входе в "личный кабинет" возможность сменить пароль и ФИО.
использовать "чистый" PHP 5.6 и выше (без фреймворков) и MySQL 5.5 и выше, дизайн не важен, верстка тоже простая. Наворотов не нужно, хотим посмотреть просто Ваш код.
### Сервер
* MySQL 5.7
* Apache 2.4
* PHP 7.3

### Установка
Загружаем репозиторий
```
git clone https://github.com/madd88/work.test
```
В папке с файлами запустить Composer
```
composer install
```
В файле config.php прописать конфиг для подключения к БД
```
define('DB_HOST', 'localhost');
define('DB_LOGIN', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'vork');
```
Все готово)

## SQL
Есть 2 таблицы

таблица пользователей:
users
```
`id` int(11)
`email` varchar(55)
`login` varchar(55)
```
и таблица заказов
orders
```
`id` int(11)
`user_id` int(11)
`price` int(11)
```

Необходимо :\
составить запрос, который выведет список email'лов встречающихся более чем у одного пользователя
```
SELECT email FROM users
GROUP BY email
HAVING COUNT(email) > 1;
```
вывести список логинов пользователей, которые не сделали ни одного заказа
```
SELECT login FROM users u
LEFT JOIN orders o ON o.user_id = u.id
WHERE o.user_id IS NULL
```
вывести список логинов пользователей которые сделали более двух заказов
```
SELECT u.login FROM orders o
JOIN users u ON u.id = o.user_id
GROUP BY o.user_id
HAVING COUNT(o.user_id) > 2
```