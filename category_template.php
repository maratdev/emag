<li>

    <a class="filter__list-item" href="?category=<?=$category['id'] ?>"><?=$category['title'] ?></a>

    <?php // проверяем есть ли в списке вложеный список
    if (isset($category['childs'])): ?>
        <span class="arrow"></span>
    <ul>
        <?=categories_to_string($category['childs']) //вызываем функцию снова ?>
    </ul>
    <?php endif;?>
</li>