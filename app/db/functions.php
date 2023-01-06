<?php

require('connect.php');

//ultraDebugSys
function pre($value){
    echo '<pre>';
    print_r($value);
    echo '</pre>';

    exit();
}

// Проверка выполнения запроса
function checkError($query){
    $error = $query->errorInfo();
    if ($error[0] !== PDO::ERR_NONE){
        echo $error[2];
        exit();
    }
    return true;
}

// Запрос на получение данных из одной таблицы
function selectAll($table, $params = []){
    global $pdo;
    $sql = "SELECT * FROM $table";

    if(!empty($params)){ //проверка на наличие доп.параметров в запросе

        $i = 0; // создаем локальную переменную, для подсчета итераций
        foreach ($params as $key => $value){
            if(!is_numeric($value)){ // буковки обрамляем кавычками
                $value = "'".$value."'";
            }
            if($i === 0){ //если переменная $params содержит данные,
                        //то во время первой итерации к тексту запроса добавляем WHERE и сам параметр (пример - admin = 1),
                        // после чего итерация оканчивается и $i++
                $sql = $sql . " WHERE $key=$value";

            }else{ // на всех последующих итерациях к запросу добавляется AND и текст след. параметра
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
    $coll = '';
    $mask = '';
    foreach ($params as $key => $value){ // здесь используем 2 переменные, для того чтобы просто, скомпоновать параметры sql запроса в одно целое
        if ($i===0){
            $coll = $coll . "$key";
            $mask = $mask . "'" . "$value" . "'";
        } else{ // после первой итерации добавляем запятые
            $coll = $coll . ", $key";
            $mask = $mask . ", '" . "$value" . "'";
        }
        $i++;
    }

    $sql = "INSERT INTO $table ($coll) VALUES ($mask)";// 2 переменные нужны только для того чтобы вставить результат в двух разных местах

    $query = $pdo->prepare($sql);
    $query->execute($params);
    checkError($query);
    return $pdo->lastInsertId(); // возвращаем id добавленной записи, с помощью pdo метода
}

// Обновление данных
function update($table, $id, $params){
    global $pdo;
    $i = 0;
    $str = '';
    foreach ($params as $key => $value){ //
        if ($i===0){
            $str = $str . $key . " = '" . $value . "'";
        } else{ // после первой итерации добавляем запятые
            $str = $str . ", ". $key . " = '" . $value . "'";
        }
        $i++;
    }

    $sql = "UPDATE $table SET $str WHERE id = $id"; // здесь например нужна лишь одна переменная,
                                                    // так как вставляем параметры лишь в одном месте sql запроса
    $query = $pdo->prepare($sql);
    $query->execute($params);
    checkError($query);
}

// Удаление строк
function delete($table, $id){
    global $pdo;
    $sql = "DELETE FROM $table WHERE id = $id";

    $query = $pdo->prepare($sql);
    $query->execute();
    checkError($query);
}

// Поиск на главной
function search($text, $table1, $table2){
    $text = trim(strip_tags(stripcslashes(htmlspecialchars($text))));
    global $pdo;
    $sql= "SELECT p.*, u.username FROM $table1 AS p JOIN $table2 as u ON p.author_id = u.id WHERE p.status=1 AND p.title LIKE '%$text%' OR p.content LIKE '%$text%'";

    $query = $pdo->prepare($sql);
    $query->execute();
    checkError($query);
    return $query->fetchAll();
}


function countRows($table){
    global $pdo;
    $sql = "SELECT COUNT(*) FROM $table WHERE status = 1";

    $query = $pdo->prepare($sql);
    $query->execute();
    checkError($query);
    return $query->fetchColumn();
}

// функция вывода постов с заданными лимитом и смещением
function selectAllWithLimit($table, $limit, $offset) {
    global $pdo;
    $sql = "SELECT * FROM $table  WHERE status = 1 ORDER BY date DESC LIMIT $limit OFFSET $offset";

    $query = $pdo->prepare($sql);
    $query->execute();

    checkError($query);
    return $query->fetchAll();
}

