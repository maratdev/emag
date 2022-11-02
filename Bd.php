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




