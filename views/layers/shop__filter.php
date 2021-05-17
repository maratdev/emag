<section class="shop__filter filter">
    <form>
        <div class="filter__wrapper">
            <b class="filter__title">Категории</b>
            <ul class="filter__list">
                <li>
                    <a class="filter__list-item active" href="#">Все</a>
                </li>
                <li>
                    <a class="filter__list-item" href="#">Женщины</a>
                </li>
                <li>
                    <a class="filter__list-item" href="#">Мужчины</a>
                </li>
                <li>
                    <a class="filter__list-item" href="#">Дети</a>
                </li>
                <li>
                    <a class="filter__list-item" href="#">Аксессуары</a>
                </li>
            </ul>
        </div>
        <div class="filter__wrapper">
            <b class="filter__title">Фильтры</b>
            <div class="filter__range range">
                <span class="range__info">Цена</span>
                <div class="range__line" aria-label="Range Line"></div>
                <div class="range__res">
                    <span class="range__res-item min-price">350 руб.</span>
                    <span class="range__res-item max-price">32 000 руб.</span>
                </div>
            </div>
        </div>

        <fieldset class="custom-form__group">
            <input type="checkbox" name="new" id="new" class="custom-form__checkbox">
            <label for="new" class="custom-form__checkbox-label custom-form__info" style="display: block;">Новинка</label>
            <input type="checkbox" name="sale" id="sale" class="custom-form__checkbox">
            <label for="sale" class="custom-form__checkbox-label custom-form__info" style="display: block;">Распродажа</label>
        </fieldset>
        <button class="button" type="submit" style="width: 100%">Применить</button>
    </form>
</section>
