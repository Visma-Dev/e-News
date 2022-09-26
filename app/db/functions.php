<?php

require('connect.php');

function pre($value){
    echo '<pre>';
    print_r($value);
    echo '</pre>';
}

// проверка выполнения запроса
function checkError($query){
    $error = $query->errorInfo();
    if ($error[0] !== PDO::ERR_NONE){
        echo $error[2];
        exit();
    }
    return true;
}
// Запрос на получение данных из всей таблицы
function selectAll($table, $params = []){
    global $pdo;
    $sql = "SELECT * FROM $table";

    if(!empty($params)){
        $i = 0;
        foreach ($params as $key => $value){
            if(!is_numeric($value)){
                $value = "'".$value."'";
            }
            if($i === 0){
                $sql = $sql . " WHERE $key=$value";
            }else{
                $sql = $sql . " AND $key=$value";
            }
            $i++;
        }
    }

    $query = $pdo->prepare($sql);
    $query->execute();

    checkError($query);
    return $query->fetchAll();
}

// Запрос на получение данных из определенной строки
function selectOne($table, $params = []){
    global $pdo;
    $sql = "SELECT * FROM $table";

    if(!empty($params)){
        $i = 0;
        foreach ($params as $key => $value){
            if(!is_numeric($value)){
                $value = "'".$value."'";
            }
            if($i === 0){
                $sql = $sql . " WHERE $key=$value";
            }else{
                $sql = $sql . " AND $key=$value";
            }
            $i++;
        }
    }
    $query = $pdo->prepare($sql);
    $query->execute();

    checkError($query);
    return $query->fetch();
}

// Запись в таблицу
function insert($table, $params){
    global $pdo;
    $i = 0;
    $col = '';
    $mask = '';
    foreach ($params as $key => $value) {
        $col = $col . $key;
        $mask = $mask . $value;
        $i++;
    }

    $sql = "INSERT INTO $table ($col) VALUES ($mask)";

    pre($sql);
    exit();

    /*$sql = "INSERT INTO $table (admin, username, email, pass) VALUES (:adm, :user, :email, :pass)";*/

    $query = $pdo->prepare($sql);
    $query->execute($arrData);
    checkError($query);
}

$arrData = [
    'adm' => '0',
    'user' => 'turbogen19',
    'email' => 'vasiliykrul19@rambler.ru',
    'pass' => 'VeryStrongpASSword'
];

insert('users', '$arrData');