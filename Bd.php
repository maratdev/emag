<?php
include $_SERVER['DOCUMENT_ROOT'].'/config.php';

function getConnection() {
    $connect = @mysqli_connect(DB_SERVER, DB_USER, DB_PASS,DB_NAME);
    if(!$connect) {
        die (mysqli_errno().' '.mysqli_error().' Ошибка подключения.');
    }
    mysqli_character_set_name($connect);
    return $connect;
}

function getBd($query){
    $res =[];
    $arr = mysqli_query(getConnection(), $query);
    while (($row = mysqli_fetch_assoc($arr)) != false){
        $res[] = $row;
    }
    return $res;
}

function printR ($array){
    echo '<pre>';
    print_r($array);
    echo '</pre>';

}
