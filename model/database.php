<?php
class Database
{
    /** @var PDO  */
    private $pdo;

    /**
     * @param string $host
     * @param string $dbname
     * @param string $user
     * @param string $password
     */
    public function __construct($host, $dbname, $user, $password)
    {
        // Подключаемся к БД
        $dsn = "mysql:host=$host;dbname=$dbname";
        
        // Создаём объект PDO для взаимодействия с БД.
        $this->pdo = new PDO($dsn, $user, $password);
        
        // Устанавливаем режим обработки исключений
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    /**
     * @param string $query
     * @param array  $params
     * @return PDOStatement
     * @throws Error
     */
    public function executeQuery($query, $params = [])
    {
        // Подготовка запроса (statement)
        $stmt = $this->pdo->prepare($query);

        // Привязка параметров
        foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value);
        }

        try {
            $stmt->execute();
            return $stmt;
        } catch (PDOException $e) {
            throw new Error($e->getMessage());
        }
    }

    /**
     * @param PDOStatement $stmt
     * @return array
     */
    public function fetchAll($stmt)
    {
        // Извлечение всех строк из результата запроса в виде массива
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
