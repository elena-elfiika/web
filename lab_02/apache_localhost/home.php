<main>
    <div class="main_left">
        <section class="carousel" aria-label="Gallery">
            <ol class="carousel__viewport">
                <li id="carousel__slide1" tabindex="0" class="carousel__slide">
                    <img src="https://img.freepik.com/free-photo/people-walking-japan-street-nighttime_23-2148942945.jpg?t=st=1733831859~exp=1733835459~hmac=a9512ba088cb12577b2f786cba02f77ccbf521a8ce8b50b82ce46a9b63461874&w=2000">
                </li>
                <li id="carousel__slide2" tabindex="0" class="carousel__slide">
                    <img src="https://img.freepik.com/free-photo/narrow-japan-street-with-lanterns-daytime_23-2148942948.jpg?t=st=1733834587~exp=1733838187~hmac=70850814600815b355f750ad36c477f79f448fce60f856adf4cbae7598926fac&w=2000">
                </li>
                <li id="carousel__slide3" tabindex="0" class="carousel__slide">
                    <img src="https://img.freepik.com/free-photo/medium-shot-smiley-friends-reunion-cold-weather_23-2149329365.jpg?t=st=1733834706~exp=1733838306~hmac=0eb829b75020d37bcc498a9f8c752b8959a0a8b1d5f571f9a38097c8ea0cd5d1&w=2000">
                </li>
                <li id="carousel__slide4" tabindex="0" class="carousel__slide">
                    <img src="https://img.freepik.com/free-photo/young-woman-new-york-city-daytime_23-2149488495.jpg?t=st=1733834766~exp=1733838366~hmac=09f4d87216644bbe6458aa47b53f97060a777c5958ab00a622ee2a2fe1997dfd&w=2000">
                </li>
            </ol>
            <aside class="carousel__navigation">
                <ol class="carousel__navigation-list">
                    <li class="carousel__navigation-item">
                        <a href="#carousel__slide1" class="carousel__navigation-button">Go to slide 1</a>
                    </li>
                    <li class="carousel__navigation-item">
                        <a href="#carousel__slide2" class="carousel__navigation-button">Go to slide 2</a>
                    </li>
                    <li class="carousel__navigation-item">
                        <a href="#carousel__slide3" class="carousel__navigation-button">Go to slide 3</a>
                    </li>
                    <li class="carousel__navigation-item">
                        <a href="#carousel__slide4" class="carousel__navigation-button">Go to slide 4</a>
                    </li>
                </ol>
            </aside>
        </section>
    </div>
    <div class="main_right">
        <h2>Джон Доу</h2>
        <p>Добро пожаловать в мир Джона Доу — фотографа, который превращает мгновения городской суеты и природной тишины в уникальные истории. Работая на улицах Японии и Южной Кореи, он запечатлевает ритм мегаполисов, неожиданные эмоции случайных прохожих и нежность портретов, наполненных искренностью. Каждый кадр Джона — это мост между прошлым и настоящим, где традиции азиатской культуры переплетаются с динамикой современной жизни.</p>
        <p>Вдохновленный эстетикой деревенского края и природными текстурами, Джон ищет красоту в простых моментах — будь то свет утреннего солнца на старой улочке Киото или тень сакуры на стенах современного Сеула. Его работы — это взгляд 30-летнего жителя мегаполиса, который видит гармонию в контрастах и превращает обыденное в искусство..</p>
    </div>
    <div class="main_form">
        <form method="POST">
            <h2>Связаться</h2>
            <ul class="form_ul">
                <li>
                    <label for='main_name'>Ваше имя</label> <input type="text" id="main_name" placeholder="Как к вам обращаться" required>
                </li>
                <li>
                    <label for='main_contact'>Контакт для связи</label><input type="text" id="main_contact" placeholder="Телефон/Почта" required>
                </li>
                <li>
                    <textarea id='main_message' rows='4' cols='50' placeholder="Текст вашего сообщения."></textarea>
                </li>
                <li class="center">
                    <input type='submit' value="Написать">
                </li>
            </ul>
            <input type="hidden" name="status" value="new">
        </form>
    </div>
</main>