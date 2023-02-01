<?php get_header('default'); ?>
<section class="calc-section">
    <div class="container">
        <div class="calc-block calc-start" id="calc-start">
            <h4 class="headline">Страница расчёта</h4>
            <p class="typeset">На этой странице вы действительно сможете посчитать цену сайта, и в конце опроса вам реально покажут стоимость и даже смету. Но она лишь примерная. Окончательную стоимость можно будет узнать только после нашего с вами общения и составления технического задания. Поэтому кнопка для направления заявки тоже будет ожидать вас в конце. Расчёт будет более точен, если у вас уже есть дизайн-макет. Нажмите на кнопку ниже и приготовьтесь пройти небольшой опрос</p>
        </div>
        <div class="calc-block get-type" id="calc-get-type">
            <h4 class="headline">Какого типа сайт и сколько на нём разных страниц?</h4>
            <div class="inner">
                <select name="site-type" id="calc-site-type">
                    <option value="none">--Выбрать--</option>
                    <option value="Landing">Лэндинг</option>
                    <option value="personalBlog">Личный блог</option>
                    <option value="visit">Сайт-визитка</option>
                    <option value="portal">Корпортативный или новостной портал</option>
                    <option value="socnet">Социальная сеть</option>
                    <option value="shop">Интернет-магазин</option>
                    <option value="other">Что-то другое</option>
                </select>
                <label class="typeset">Что именно?<input type="text" name="otherTypeDesc" id="otherTypeDesc"></label>
                <label class="typeset">Количество страниц:<input type="number" name="sitePageAmount" id="sitePageAmount"></label>
            </div>
        </div>
        <div class="calc-block get-has-design" id="calc-has-design">
            <h4 class="headline">У вас уже есть дизайн-макет?</h4>
            <div class="btns">
                <button class="btn calc-btn">Да</button>
                <button class="btn calc-btn">Нет</button>
            </div>
        </div>
        <div class="calc-block get-pages">
            <h4 class="headline">Укажите параметры для страниц в макете</h4>
            <div class="calc-block-pages-grid">
                <?php for($i = 1; $i<=2; $i++) { ?>
                <div class="calc-block-page">
                    <p class="typeset-big">Страница <?php echo $i; ?></p>
                    <label class="typeset">Сколько экранов страницы вы бы оценили как простые:<input type="number" name="simpleSectionsAmount" id="simpleSectionsAmount"></label>
                    <label class="typeset">Сколько экранов страницы вы бы оценили как сложные:<input type="number" name="simpleSectionsAmount" id="simpleSectionsAmount"></label>
                    <label class="typeset">Будут ли анимации на простых страницах<input type="checkbox" name="hasAnim" id="hasAnim"></label>
                    <label class="typeset">Сколько всего элементов простых экранов<br> будут подвергнуты анимации:<input type="number" name="simpleSectionsAnimAmount" id="simpleSectionsAnimAmount"></label>
                    <label class="typeset">Будут ли анимации на сложных страницах<input type="checkbox" name="hasAnim" id="hasAnim"></label>
                    <label class="typeset">Сколько всего элементов сложных экранов<br> будут подвергнуты анимации:<input type="number" name="simpleSectionsAnimAmount" id="simpleSectionsAnimAmount"></label>
                </div>
                <?php } ?>
            </div>
        </div>
        <div class="calc-block get-has-adaptive" id="calc-has-adaptive">
            <h4 class="headline">Нужен ли будет адаптивный дизайн?</h4>
            <div class="btns">
                <button class="btn calc-btn">Да</button>
                <button class="btn calc-btn">Нет</button>
            </div>
        </div>
        <div class="calc-block get-offcanvas">
            <h4 class="headline">Должны ли быть на сайте модальные окна, перекрывающие собой весь контент при определённых условиях?</h4>
            <div class="btns">
                <button class="btn calc-btn">Да</button>
                <button class="btn calc-btn">Нет</button>
            </div>
            <div class="inner">
            <label class="typeset">Сколько таких окон будет:<input type="number" name="simpleSectionsAnimAmount" id="simpleSectionsAnimAmount"></label>
            </div>
        </div>
        <div class="calc-block get-has-backend">
            <h4 class="headline">Нужен ли сайту бэкенд или админпанель?</h4>
            <div class="btns">
                <button class="btn calc-btn">Да</button>
                <button class="btn calc-btn">Нет</button>
            </div>
        </div>
        <div class="calc-block get-backend-type">
            <h4 class="headline">Что будет использоваться для этой цели?</h4>
            <div class="inner">
                <select name="" id="">
                    <option value="none">--Выбрать--</option>
                    <option value="WP">CMS WordPress</option>
                    <option value="OC">CMS OpenCart</option>
                    <option value="Joomla">CMS Joomla</option>
                    <option value="flask">Собственный движок на Python Flask</option>
                    <option value="spring">Собственный движок на Java Spring</option>
                    <option value="noidea">Нужна консультация/Мне без разницы</option>
                </select>
            </div>
        </div>  
        <button class="btn calc-btn" id="calc-start-btn">Начать опрос</button>
        <button class="btn calc-btn" id="calc-next-btn">Далее</button>
        <button class="btn calc-btn" id="calc-finish-btn">Завершить опрос</button>
        <div class="calc-block calc-finish">
            <h4 class="headline">Результаты расчёта</h4>
            <table class="inner typeset">
                <tr>
                    <th class="typeset-big">Наименование</th>
                    <th class="typeset-big">Значение</th>
                </tr>
                </tr>
                    <td>val1</td>
                    <td>50р</td>
                </tr>
                <tr>
                    <td>val2</td>
                    <td>50р</td>
                </tr>
                <tr>
                    <td>...</td>
                    <td>...</td>
                </tr>
                <tr>
                    <td>Итого</td>
                    <td>1000 рублей</td>
                </tr>
            </table>
        </div>
    </div>
</section>
<div class="container">
</div>
<?php get_footer(); ?>