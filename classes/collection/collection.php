<?php
  namespace classes\collection;
  use classes\collection\accounts;
  use classes\collection\todos;
  use classes\pdo\dbConn; 
  use \PDO;
  abstract class collection {

     static public function create() {
        $model = new static::$modelName;
	return $model;
     }  

     static public function findAll() {
        $tableName = get_called_class();
        $tableName = str_replace("classes\collection\\","",$tableName);
        $sql = 'SELECT * FROM ' . $tableName;
	$db = dbConn::getConnection();
	$statement = $db->prepare($sql);
	$statement->execute();
	$class = static::$modelName;
	$statement->setFetchMode();
	$resultSet = $statement->fetchAll(PDO::FETCH_ASSOC);
	return $resultSet;
	//print_r($resultSet);
     }

     static public function findOne($id) {
        $tableName = get_called_class();
        $tableName = str_replace("classes\collection\\","",$tableName);
        $sql = 'SELECT * FROM ' . $tableName . ' WHERE id =' . $id;
        $db = dbConn::getConnection();
        $statement = $db->prepare($sql);
        $statement->execute();
        $class = static::$modelName;
        $statement->setFetchMode();
        $resultSet = $statement->fetchAll(PDO::FETCH_ASSOC);
	return $resultSet;
     }
  }
?>
