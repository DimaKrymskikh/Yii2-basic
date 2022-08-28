После клонирования нужно выполнить

    composer install

Базовая команда для восстановления базы

    pg_restore -d newdb dvdrental.dump

Нужно поправить файл protected/config/db.php для фактического сервера progtest

База данных состоит из двух схем: public, info

Схема public взята из [PostgreSQL Sample Database](https://www.postgresqltutorial.com/postgresql-getting-started/postgresql-sample-database/)

Всё, что добавлено, в схеме info

Для запуска тестов нужно в двух разных окнах командной строки запустить два сервера при помощи комманд

    composer serve

    selenium-standalone install && selenium-standalone start

Затем запустить сами тесты

    composer test

Источник от авторов [selenium-standalone]https://github.com/webdriverio/selenium-standalone для установки

(У меня selenium-standalone установлен глобально)

Отдельный тест можно запустить так 

    composer test unit models\RegistrationFormTest

На данный момент не настроено обновление тестовой базы для приёмочных тестов


Отправка почты опробована в команде MailController

Секретная информация храниться в переменных окружения в файле .env.
Используется PHP-библиотека [PHP dotenv]https://github.com/vlucas/phpdotenv
В файле .env.example перечислены используемые переменные окружения.
