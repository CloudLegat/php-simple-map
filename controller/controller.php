<?php
require_once 'model/model.php';
require_once 'model/database.php';

class Controller
{
    /** @var Model */
    private $model;

    // Dependency Injection
    public function __construct()
    {
        $this->model = new Model();
    }

    public function run()
    {
        session_start();
        $map = '';

        // Логика обработки запросов пользователя. Использую GET-метод для наглядности
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            if (isset($_GET['address'], $_GET['csrf_token'])) {
                // Проверка CSRF-токена
                $csrfToken = $_GET['csrf_token'];
                if ($_SESSION['csrf_token'] !== $csrfToken) {
                    throw new Error('Invalid CSRF-token');
                }

                $selectedAddress = $_GET['address'];

                // Получение карты с googleapis
                $map = $this->model->getMap($selectedAddress);

                // Сохранение запроса в истории
                $this->model->saveRequest($selectedAddress);
            }
        }

        $history = $this->model->getHistory();
        $csrfToken = $this->model->getCsrfToken();
        // Подключение представления с параметрами
        include('view/view.php');
    }
}
