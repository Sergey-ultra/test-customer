1)Создать бд в Mysql
2)Настроить подключение к этой базе данных в файле config/db.php
3)Импортировать дамп базы из файла dump.sql
4)Входной файл public/index.php, конфиги для Apache
5)composer install
6)По роуту customer доступны следущие uri-параметры:
    customer_id[]=3 (массив значений)
    max_age=20  число
    min_age=27   число
    author=Пушкин    строка
7)По роуту customer/5   - страница клиента   