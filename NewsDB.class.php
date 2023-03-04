<?php

require_once "INewsDB.class.php";


class newsDB implements INewsDB {
    const DB_NAME = "news.db";

    private $_db = null;

    public $sql_msgs = "CREATE TABLE IF NOT EXISTS msgs(id INTEGER PRIMARY KEY AUTOINCREMENT,title TEXT,category INTEGER,description TEXT,source TEXT,datetime INTEGER)";
    public $sql_category = "CREATE TABLE IF NOT EXISTS category(id INTEGER,name TEXT)";

    function __construct()
    {
        if (!file_exists(self::DB_NAME)) {
        $this->_db = new PDO("sqlite:" . self::DB_NAME);
        $this->_db->exec($this->sql_msgs);
        $this->_db->exec($this->sql_category);
        $this->_db->exec("INSERT INTO category(id, name)
        SELECT 1 as id, 'Политика' as name
        UNION SELECT 2 as id, 'Культура' as name
        UNION SELECT 3 as id, 'Спорт' as name ");
        } else {
            $this->_db = new PDO("sqlite:" . self::DB_NAME);
        }

    }

    function __destruct()
    {
        $this->_db = null;
    }


    /**
     *	Добавление новой записи в новостную ленту
     *
     *	@param string $title - заголовок новости
     *	@param string $category - категория новости
     *	@param string $description - текст новости
     *	@param string $source - источник новости
     *
     *	@return boolean - результат успех/ошибка
     */
    function saveNews($title, $category, $description, $source):bool {
        $datetime = time();
        $sql = "INSERT INTO msgs(title, category, description, source, datetime) VALUES('$title', '$category', '$description', '$source', $datetime)";
        $result = $this->_db->exec($sql);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    // function remove() {
    //     $sql = "DELETE FROM msgs";
    //     $this->_db->exec($sql);
    // }


    /**
     *	Выборка всех записей из новостной ленты
     *
     *	@return array - результат выборки в виде массива
     */
    function getNews():array {
        $sql = "SELECT msgs.id as id, title, category.name as category, description, source, datetime FROM msgs, category WHERE category.id = msgs.category ORDER BY msgs.id DESC";
        $stmt = $this->_db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    


    /**
     *	Просмотр записи из новостной ленты
     *
     *	@param integer $id - идентификатор просматриваемой записи
     *
     *  return array - результат выборки в виде массива
     */
    function showNews($id):array {
        $sql = "SELECT id, title, category, description, source, datetime FROM msgs WHERE id = $id";
        $stmt = $this->_db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

