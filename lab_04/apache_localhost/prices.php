<main>
    <div class="price_container">
        <h2 class="center">Цены</h2>
        <h3 class="center">Цены на пакетные предложения</h3>
        <ul class="price-list">
            <li>Портретная фотосъемка (за час): <span class="price">50,000 ₩ / $40</span></li>
            <li>Свадебная фотосессия (за час): <span class="price">200,000 ₩ / $160</span></li>
            <li>Корпоративная съемка (за час): <span class="price">133,333 ₩ / $107</span></li>
            <li>Фотосессия на открытом воздухе (за час): <span class="price">125,000 ₩ / $100</span></li>
            <li>Тематическая студийная съемка (за час): <span class="price">175,000 ₩ / $140</span></li>
            <li>Пакет "День со съемкой": <span class="price">1,500,000 ₩ / $1,200</span></li>
            <li>Редактирование и ретушь (за 10 фото): <span class="price">100,000 ₩ / $80</span></li>
            <li>Печать фотографий (набор из 20): <span class="price">50,000 ₩ / $40</span></li>
        </ul>
        <p class="price-note">
            Обратите внимание:<br>
            - Цены для фотосессий указаны за один час съемки, кроме пакета "День со съемкой".<br>
            - Цены указаны без учета транспортных расходов для съемок за пределами Сеула.<br>
            - Печать фотографий возможна только на территории Кореи.<br>
            - Все услуги могут быть адаптированы под ваши потребности. Свяжитесь для уточнения деталей.
        </p>
        <form id="price-calculator" class="calculator-form">
            <h3 class="center">Калькулятор примерных цен</h3>
            <ul class="form_ul">
                <li>
                    <label for="service-select">Выберите услугу:</label> <select id="service-select" name="service">
                        <option value="50000" data-usd="40">Портретная фотосъемка (за час)</option>
                        <option value="200000" data-usd="160">Свадебная фотосессия (за час)</option>
                        <option value="133333" data-usd="107">Корпоративная съемка (за час)</option>
                        <option value="125000" data-usd="100">Фотосессия на открытом воздухе (за час)</option>
                        <option value="175000" data-usd="140">Тематическая студийная съемка (за час)</option>
                        <option value="1500000" data-usd="1200">Пакет "День со съемкой"</option>
                        <option value="100000" data-usd="80">Редактирование и ретушь (за 10 фото)</option>
                        <option value="50000" data-usd="40">Печать фотографий (набор из 20)</option>
                    </select>
                </li>
                <li>
                    <label for="quantity">Количество часов/услуг:</label>
                    <input type="number" id="quantity" name="quantity" min="1" value="1">
                </li>
                <li>
                    <button type="button" id="calculate-btn">Рассчитать</button>
                </li>
        </form>

        <div id="result" class="result">
            <p>Итоговая стоимость: <span id="total-won">0</span> ₩ / <span id="total-usd">0</span> $</p>
        </div>
    </div>

    <script src="scripts/prices_calc.js"></script>

</main>