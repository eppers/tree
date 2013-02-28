{% extends 'layout.php' %}

{% block page_title %}Strona główna{% endblock %}
{% block content %}
                     {% include 'left-boxes.php' %}
                    <div id="main-container" class="cennik-uslugi">
                        <h2>
                            Cennik <span>USŁUG</span>
                        </h2>
                        <p>Zapytaj nas o usługę, która Państwa interesuje, a nie znajduje się na poniższej liście.</p>
                        <div id="cennik-uslugi-container">
                            <div class="scrollbar"><div class="track"><div class="thumb"><div class="end"></div></div></div></div>
                            <div class="viewport">
                                <div class="overview">
                                    <div class="service-container">
                                        <h4>Pielegnacja ogrodu</h4>
                                        <p>Usługi wyceniane są indywidualnie.</p>
                                        <ul class="service-list">
                                            <li>
                                                <p>Wiercenie otworów pod sadzonki – do 25cm</p>
                                                <p class="service-price">2,00 – 5,00 zł/szt</p>
                                            </li>
                                            <li>
                                                <p>Wiercenie otworów pod słupki do 120 cm</p>
                                                <p class="service-price">5,00 – 12,00 zł/szt</p>
                                            </li>
                                            <li>
                                                <p>Karczowanie, usuwanie samosiewów</p>
                                                <p class="service-price">3,00-15,00 zł/szt</p>
                                            </li>
                                            <li>
                                                <p>Sadzenie (robocizna + podłoże + nawozy)</p>
                                                <p class="service-price">4,00-20,00 zł/szt</p>
                                            </li>
                                            <li>
                                                <p>Koszenie</p>
                                                <p class="service-price">0,20-0,70 zł/m2</p>
                                            </li>
                                            <li>
                                                <p>Nawożenie</p>
                                                <p class="service-price">0,35-0,50 zł/m2</p>
                                            </li>
                                            <li>
                                                <p>Wertykulacja , piaskowanie</p>
                                                <p class="service-price">0,20-1,50 zł/m2</p>
                                            </li>
                                            <li>
                                                <p>Formowanie krzewów</p>
                                                <p class="service-price">1,00-30,00 zł/szt</p>
                                            </li>
                                            <li>
                                                <p>Prześwietlanie owocówek</p>
                                                <p class="service-price">od 15zł/szt</p>
                                            </li>
                                            <li>
                                                <p>Cięcie żywopłotu</p>
                                                <p class="service-price">2,00-5,00 zł/m2</p>
                                            </li>
                                            <li>
                                                <p>Równanie terenu</p>
                                                <p class="service-price">6,00-10,00 zł/m2</p>
                                            </li>
                                            <li>
                                                <p>Trawnik z siewu</p>
                                                <p class="service-price">5,00-15,00 zł/m2</p>
                                            </li>
                                            <li>
                                                <p>Plecakowym oprysk</p>
                                                <p class="service-price">1szy 70zl zbiornik, kolejny 50zł</p>
                                            </li>
                                            <li>
                                                <p>Pielenie</p>
                                                <p class="service-price">0,30-1,20 zł/m2</p>
                                            </li>
                                            <li>
                                                <p>Korowanie</p>
                                                <p class="service-price">10,00 zł/m2</p>
                                            </li>
                                            <li>
                                                <p>Mycie mchu i glonów z kostki</p>
                                                <p class="service-price">6,00-20,00 zł/m2</p>
                                            </li>
                                            <li>
                                                <p>Grabienie</p>
                                                <p class="service-price">0,60-2,00 zł/m2</p>
                                            </li>
                                            <li>
                                                <p>Odśnieżanie</p>
                                                <p class="service-price">1,50-5,00 zł/m2</p>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
        
                        
         
		<script type="text/javascript">
		$('#cennik-uslugi-container').tinyscrollbar();
		</script>
{% endblock %}
