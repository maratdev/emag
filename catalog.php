<?php


$categories = getCat();
$categories_tree = map_tree($categories);
$categories_menu = categories_to_string($categories_tree);
$ids='';

/**
 ********************************************************* ХЛЕБНЫЕ КРОШКИ
 **/
    $id = (int) isset($_GET['category'])? $_GET['category']:''; //перевод GET в int

    //$id = (int) $_GET['category'];

    // return true (array not empty) || return false
    $breadcrumbs_array = breadcrumbs($categories, $id);
    $breadcrumbs = "";

    if ($breadcrumbs_array) {
        $breadcrumbs = "<li class='breadcrumb-item active'><a href='/'>Каталог</a></li>";
        foreach ($breadcrumbs_array as $id => $title) {
            $breadcrumbs .= "<li class='breadcrumb-item active'><a href='?category={$id}'>{$title}</a></li>";
        }
        $breadcrumbs = rtrim($breadcrumbs, ' / ');
        $breadcrumbs = preg_replace("#(.+)?<a.+>(.+)</a>$#", "$1$2", $breadcrumbs); // последняя хлебная крошка не подчеркивается!
    } else {
        $breadcrumbs = "<li class='breadcrumb-item '><a href='/'>Все</a> / Каталог </li>";
    }
    // ID дочерних категорий
    $ids = cats_id($categories, $id);
    $ids = !$ids ? $id : rtrim($ids, ",");

/**
 ********************************************************* ПАГИНАЦИЯ
 **/
// Колл товаров на странице 5
$perpage = 5;
// Общее колл товаров
$count_goods = count_goods($ids);

// Необходимое колл стриниц
$count_pages = ceil($count_goods / $perpage);
// минимум 1 стриница
if (!$count_pages) $count_pages = 1;

// получение текущей стриницы
if(isset($_GET['page'])){
    $page = (int) $_GET['page'];
    if ($page < 1) $page = 1;
    if ($page > $count_pages) $page = $count_pages;
}else{
    $page = 1;
}

// начальная позиция запроса
$start_pos =($page -1) * $perpage;

$pagination = pagination($page, $count_pages);

// Передачав функции
$products = get_products($ids, $start_pos, $perpage);





























