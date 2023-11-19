<?php
require_once 'config.php';

class Model
{
    /** @var string  */
    private $apiKey = GOOGLE_MAPS_API_KEY;
    /** @var Database  */
    private $database;

    public function __construct()
    {
        $this->database = new Database(DB_HOST, DB_NAME, DB_USER, DB_PASSWORD);
    }

    /**
     * @param string $address
     * @return string HTML-код
     */
    public function getMap($address)
    {
        $address = urlencode($address);
        $url = "https://maps.googleapis.com/maps/api/staticmap?center={$address}&size=640x480&zoom=15&key={$this->apiKey}&markers=color:red%7Clabel:A%7C{$address}";

        // Возвращаем HTML-код с изображением карты и маркером
        return '<img src="' . $url . '" alt="Google Map">';
    }

    /**
     * @param string $record
     */
    public function saveRequest($record)
    {
        $this->database->executeQuery("INSERT INTO `requests_history` (`address`) VALUES (:record)", [':record' => $record]);
    }

    /**
     * @return array Массив с историей запросов.
     */
    public function getHistory()
    {
        $stmt = $this->database->executeQuery("SELECT `address`, `request_time` FROM `requests_history` ORDER BY `request_time` DESC");
        return $this->database->fetchAll($stmt);
    }

    /**
     * @return string
     */
    public function getCsrfToken()
    {
        // Возвращаем или текущий, если он есть, или новый токен
        return $_SESSION['csrf_token'] ?? $this->generateCsrfToken();
    }

    /**
     *
     * @return string
     */
    public function generateCsrfToken()
    {
        // Генерируем новый CSRF-токен и сохраняем его в сессии
        if (!isset($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }

        return $_SESSION['csrf_token'];
    }
}
