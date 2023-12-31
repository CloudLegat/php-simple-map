Описание проекта

Проект представляет PHP-приложение, построенное на архитектуре MVC, с интеграцией Google Maps API. Пользователям предоставляется функциональность помощника ввода адреса с автозаполнением и возможностью сохранения запросов в истории в базе данных MySQL.

Основные функции:

    Отображение статической карты с использованием Google Maps API.
    Помощник ввода адреса с автозаполнением, использующий Google Maps API Places Autocomplete.
    Сохранение истории запросов (адрес и время) в MySQL базе данных.

Структура приложения:

    index.php: Основной входной файл, инициализирующий контроллер и отображающий представление.
    controller.php: Контроллер, обрабатывающий запросы, управляющий моделью и представлением.
    model.php: Модель, взаимодействующая с Google Maps API, сохраняющая историю запросов и предоставляющая предложенные адреса.
    database.php: Модель для взаимодействия с MySQL БД при помощи PDO-запросов
    view.php: Представление, отображающее заголовок, помощник ввода, статическую карту и историю запросов.

Требования:

    Разделение кода на компоненты MVC.
    Использование Google Maps API через backend API.
    Основные компоненты приложения: index.php, controller.php, model.php, view.php.

Запуск:

    Установить PHP и MySQL.
    Загрузить проект на сервер.
    Создать базу данных и таблицу для истории запросов.
    Получить API-ключ Google Maps.
    Создать файл config.php и добавить туда данные
    Открыть приложение в браузере и использовать функциональность.
