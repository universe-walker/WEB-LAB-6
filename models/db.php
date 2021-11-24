<?
    class DB {
        protected $dbh;

        public function __construct($dbConfigPath='config/db.ini')
        {
            if (!($ini_db = parse_ini_file($dbConfigPath)))
            {
                throw new Exception("Ошибка парсинга файла инициализации бд", 1);
            }

            try {
                $init_str = 'mysql:host='.$ini_db['host'].';dbname='.$ini_db['name'];
                $this->dbh = new PDO($init_str, $ini_db['login'],  $ini_db['password']);
            } catch (PDOException $e) {
                die();
            }
        }

        public function getDBHandler() 
        {
            return $this->dbh;
        }
    }