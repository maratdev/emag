<div class="shop__wrapper">

    <section class="shop__sorting">
        <div class="container">
            <div class="row row-cols-3">
                <div class="shop__sorting-item custom-form__select-wrapper col">
                    <select class="custom-form__select" name="category">
                        <option hidden="">Сортировка</option>
                        <option value="price">По цене</option>
                        <option value="name">По названию</option>
                    </select>
                </div>
            <div class="shop__sorting-item custom-form__select-wrapper col">
                <select class="custom-form__select" name="prices">
                    <option hidden="">Порядок</option>
                    <option value="all">По возрастанию</option>
                    <option value="woman">По убыванию</option>
                </select>
            </div>
                <p class="shop__sorting-res col">Найдено <span class="res-sort">858</span> моделей</p>
                <div class="shop__sorting-item col-md-auto">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <?= isset($breadcrumbs) ? $breadcrumbs : '' ?>
                            <hr>
                            <hr>

                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <section class="shop__list">
        <?php
        //var_dump($ids);
        ?>
        <?php if(!empty($products)): ?>
            <?php foreach ($products as $product): ?>
                <article class="shop__item product" tabindex="0">
                <div class="product__image">
                    <img src="<?=$product['img']?>" alt="product-name">
                </div>
                <p class="product__name"><?=$product['title']?></p>
                <span class="product__price"><?=$product['price']?> руб.</span>
                </article>
            <?php endforeach;?>
        <?php else: ?>
            <p>Здесь товаров нет!</p>
        <?php endif;?>
    </section>

    <ul class="shop__paginator paginator">
        <li>
            <?=$pagination?>
        </li>
    </ul>
</div>

