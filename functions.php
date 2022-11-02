<?php
/**
 ********************************************************* Служебные функции
 **/

//Возврат запрса в ассоциативный массив
function getBd($query){
    $res =[];
    $arr = mysqli_query(getConnection(), $query);
    while (($row = mysqli_fetch_assoc($arr)) != false){
        $res[] = $row;
    }
    return $res;
}

//Распечатка массива
function printR ($array){
    echo '<pre>';
    print_r($array);
    echo '</pre>';

}

/**
 ********************************************************* Реализация вывода каталога меню
 **/

//Получение массива категорий
function getCat(){
    $query = 'SELECT * FROM categories';

    $arr = mysqli_query(getConnection(), $query);
    $arr_cat =[];
    while (($row = mysqli_fetch_assoc($arr)) != false){
        $arr_cat[$row['id']] = $row; //присвоить ключам массива id
    }
    return $arr_cat;

}

//Построение дерева
function map_tree($dataset) {
    $tree =[];
    foreach ($dataset as $id=>&$node) {
        if (!$node['parent']){
            $tree[$id] = &$node;
        }else{
            $dataset[$node['parent']]['childs'][$id] = &$node;
        }
    }
    return $tree;
}

//Построение дерева в строку HTML
function categories_to_string($data){
    $string = '';
    foreach ($data as $item){
        $string .= categories_to_template($item);
    }
    return $string;
}

//Шаблон вывода категорий
function categories_to_template($category){
    ob_start();
    include 'category_template.php';
    return ob_get_clean();
}

/**
 ********************************************************* Реализация хлебных крошек
 **/

$array = '';
$id = '';

function breadcrumbs($array, $id){ // $id это GET параметр, $array = массив категорий
    if (!$id) return false;
    $count = count($array);
    $breadcrumbs_array = [];

    for ($i=0; $i < $count; $i++){
        if (!empty($array[$id])){
            $breadcrumbs_array[$array[$id]['id']] = $array[$id]['title']; // заполнение массива, вставляем в масссив ключ $array[$id](массив категорий) далее создаем еще id и вставляем в него название категории
            $id = $array[$id]['parent']; // перезапишем id значением parent
        }else break; //ограничить итераций
    }
    return array_reverse($breadcrumbs_array, true ); // массив в обратном порядке c сохранением ключей
}


/**
 ********************************************************* Получение ID катгорий
 **/

function cats_id($array, $id){
    $data = '';
    if (!$id) return false;
    foreach ($array as $item){
        if ($item['parent'] == $id){
            $data .= $item['id'] . ",";
            $data .= cats_id($array, $item['id']);
        }
    }
    return $data;
}

/**
 ********************************************************* Получение товаров
 **/

function get_products($ids, $start_pos, $perpage){
    if($ids){
        $query = "SELECT * FROM products WHERE categories_id IN ($ids) ORDER BY title LIMIT $start_pos, $perpage";
    }else{
        $query = "SELECT * FROM products ORDER BY title LIMIT $start_pos, $perpage";
    }
    $res = mysqli_query(getConnection(), $query);
    $products = [];
    while (($row = mysqli_fetch_assoc($res))){
        $products[] = $row;
    }
    return $products;
}

/**
 ********************************************************* Кол-во товаров
 **/

    function count_goods($ids){
        if (!$ids){
            $query = "SELECT COUNT(*) FROM products";
        }else{
            $query = "SELECT COUNT(*) FROM products WHERE categories_id IN($ids)";
        }
        $res = mysqli_query(getConnection(), $query);
        $count_goods = mysqli_fetch_row($res);
        return $count_goods[0];
    }

/**
 ********************************************************* Постраничная навигация
 **/
function pagination($page, $count_pages){

    // << < 3 4 5 6> >>
    $back = '';  //ссылка назад <
    $forward = ''; // ссылка вперед >
    $startpage = ''; // ссылка в начало
    $endpage = ''; // ссылка в конец
    $page2left = '';  // вторая страница слева
    $page1left = '';  // первая страница слева
    $page2right = '';  // вторая страница справа
    $page1right = '';  // первая страница справа

    $uri = "?";
    //если  есть параметры в запросе
    if ($_SERVER['QUERY_STRING']){
        foreach ($_GET as $key => $value){
            if($key !='page') $uri .= "{$key}=$value&";
        }
    }
    if($page > 1){
        $back = "<a class='paginator__item'  href='{$uri}page=".($page-1)."'><</a>";
    }
    if($page < $count_pages){
        $forward = "<a class='paginator__item' href='{$uri}page=".($page+1)."'>></a>";
    }
    if($page > 3){
        $startpage = "<a class='paginator__item' href='{$uri}page=1'>&laquo;</a>";
    }
    if($page < ($count_pages - 2)){
        $endpage = "<a class='paginator__item' href='{$uri}page={$count_pages}'>&raquo;</a>";
    }
    if($page -2  > 0){
        $page2left = "<a class='paginator__item' href='{$uri}page=".($page-2)."'>".($page-2)."</a>";
    }
    if($page -1  > 0){
        $page1left = "<a class='paginator__item' href='{$uri}page=".($page-1)."'>".($page-1)."</a>";
    }
    if($page + 1 <= $count_pages){
        $page1right = "<a class='paginator__item' href='{$uri}page=".($page+1)."'>".($page+1)."</a>";
    }
    if($page + 2 <= $count_pages){
        $page2right = "<a class='paginator__item' href='{$uri}page=".($page+2)."'>".($page+2)."</a>";
    }

    return $startpage.$back.$page2left.$page1left."<a class='paginator__item disabled' >".$page."</a>".$page1right.$page2right.$forward.$endpage;

}




























