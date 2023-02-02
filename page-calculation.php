<?php get_header('default'); ?>
<input type="hidden" name="results-input" id="results-input" value = "{}">
<section class="calc-section">
    <div class="container">
        <div class="calc-block calc-start" id="calc-start">
            <h4 class="headline">Страница расчёта</h4>
            <p class="typeset">На этой странице вы действительно сможете посчитать цену сайта, и в конце опроса вам реально покажут стоимость. Но она лишь примерная. Окончательную стоимость можно будет узнать только после нашего с вами общения и составления технического задания. К тому же, короткий опрос просто не может предусмотреть всё и вся, т.к. разные типы сайтов могут иметь совершенно разный необходимый набор программных решений. Поэтому кнопка для направления заявки тоже будет ожидать вас в конце. Расчёт будет более точен, если у вас уже есть дизайн-макет. Нажмите на кнопку ниже и приготовьтесь пройти небольшой опрос</p>
        </div>
        <div class="calc-block get-type" id="calc-get-type">
            <h4 class="headline">Какого типа сайт и сколько на нём разных страниц?</h4>
            <p class="typeset">Интересует именно количество разных по структуре страниц</p>
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
            <p class="typeset">Макет делает дизайнер, как правило, в таких программах как Figma или Photoshop</p>
            <div class="btns">
                <button class="btn calc-btn" data-btn-result="true">Да</button>
                <button class="btn calc-btn" data-btn-result="false">Нет</button>
            </div>
        </div>
        <div class="calc-block get-pages" id="calc-get-pages">
            <h4 class="headline">Укажите параметры для страниц в макете</h4>
            <p class="typeset">Чем точнее будет указано, тем точнее будет результат расчёта</p>
            <div class="calc-block-pages-grid">
                <div class="calc-block-page">
                    <p class="typeset-big">Страница ...</p>
                    <label class="typeset" name="simpleSectionsAmount">Сколько экранов страницы вы бы оценили как простые:<input type="number"></label>
                    <label class="typeset" name="hardSectionsAmount">Сколько экранов страницы вы бы оценили как сложные:<input type="number"></label>
                    <label class="typeset" name="simpleHasAnim">Будут ли анимации на простых страницах<input type="checkbox"></label>
                    <label class="typeset" name="simpleSectionsAnimAmount">Сколько всего элементов простых экранов<br> будут подвергнуты анимации:<input disabled type="number"></label>
                    <label class="typeset" name="hardHasAnim">Будут ли анимации на сложных страницах<input type="checkbox"></label>
                    <label class="typeset" name="hardSectionsAnimAmount">Сколько всего элементов сложных экранов<br> будут подвергнуты анимации:<input disabled type="number"></label>
                </div>
            </div>
        </div>
        <div class="calc-block get-has-adaptive" id="calc-design-has-adaptive">
            <h4 class="headline">Есть ли в макете адаптивный дизайн?</h4>
            <p class="typeset">Адаптивный дизайн - это дизайн одной и той же страницы для различных разрешений экранов (телефон, планшет, монитор)</p>
            <div class="btns">
                <button class="btn calc-btn" data-btn-result="true">Да</button>
                <button class="btn calc-btn" data-btn-result="false">Нет</button>
            </div>
        </div>
        <div class="calc-block get-has-adaptive" id="calc-need-adaptive">
            <h4 class="headline">Нужен ли будет адаптивный дизайн?</h4>
            <p class="typeset">Адаптивный дизайн - это дизайн одной и той же страницы для различных разрешений экранов (телефон, планшет, монитор)</p>
            <div class="btns">
                <button class="btn calc-btn" data-btn-result="true">Да</button>
                <button class="btn calc-btn" data-btn-result="false">Нет</button>
            </div>
        </div>
        <div class="calc-block get-offcanvas" id="calc-get-offcanvas">
            <h4 class="headline">Должны ли быть на сайте модальные окна, перекрывающие собой контент при определённых условиях?</h4>
            <p class="typeset">Например, форма обратной связи, всплывающие окошки, чат с оператором</p>
            <div class="btns">
                <button class="btn calc-btn" data-btn-result="true">Да</button>
                <button class="btn calc-btn" data-btn-result="false">Нет</button>
            </div>
        </div>
        <div class="calc-block get-has-backend" id="calc-get-has-backend">
            <h4 class="headline">Нужен ли сайту бэкенд или админпанель?</h4>
            <p class="typeset">Изменять содержимое сайта без наличия бэкенда может только знакомый с HTML разметкой человек</p>
            <div class="btns">
                <button class="btn calc-btn" data-btn-result="true">Да</button>
                <button class="btn calc-btn" data-btn-result="false">Нет</button>
            </div>
        </div>
        <div class="calc-block get-backend-type" id="calc-get-backend-type">
            <h4 class="headline">Какой будет бэкенд?</h4>
            <p class="typeset">Бэкенд - это то, что наполняет контентом сайт, забирая и размещая у себя данные из управляемой пользователем базы данных</p>
            <div class="inner">
                <select name="" id="calc-backend-type">
                    <option value="none">--Выбрать--</option>
                    <option value="WordPress">CMS WordPress</option>
                    <option value="OpenCart">CMS OpenCart</option>
                    <option value="Joomla">CMS Joomla</option>
                    <option value="Flask">Собственный движок на Python Flask</option>
                    <option value="Spring">Собственный движок на Java Spring Boot</option>
                    <option value="noidea">Нужна консультация/Мне без разницы</option>
                </select>
            </div>
        </div>  
        <button class="btn calc-btn" id="calc-start-btn">Начать опрос</button>
        <button class="btn calc-btn" id="calc-next-btn">Далее</button>
        <button class="btn calc-btn" id="calc-finish-btn">Завершить опрос</button>
        <div class="calc-block calc-finish" id="calc-finish">
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
        <button class="btn calc-btn" data-action="openOrderForm">Оставить заявку</button>

        </div>
    </div>
</section>
<div class="container">
</div>
<?php get_footer(); ?>