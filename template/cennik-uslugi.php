{% extends 'layout.php' %}

{% block page_title %}Strona główna{% endblock %}
{% block content %}
                     {% include 'left-boxes.php' %}
                    <div id="main-container" class="cennik-uslugi">
                        <h2>
                            Cennik <span>(cena za m2)</span>
                        </h2>
                        <div id="cennik-uslugi-container">
                            <div class="scrollbar"><div class="track"><div class="thumb"><div class="end"></div></div></div></div>
                            <div class="viewport">
                                <div class="overview">
                                    <div class="service-container">
                                        <h4>Pielegnacja ogrodu</h4>
                                        <ul class="service-list">
                                            <li>
                                                <p>Pielęgnacja ogrodu</p>
                                                <p class="service-price">od 100 zl</p>
                                            </li>
                                            <li>
                                                <p>Strzyżenie</p>
                                                <p class="service-price">od 25 zl</p>
                                            </li>
                                            <li>
                                                <p>Wycinka</p>
                                                <p class="service-price">od 25 zl</p>
                                            </li>
                                            <li>
                                                <p>Podlewanie trawników</p>
                                                <p class="service-price">od 25 zl</p>
                                            </li>
                                            <li>
                                                <p>Wypędzanie kretów</p>
                                                <p class="service-price">od 225 zl</p>
                                            </li>
                                            <li>
                                                <p>Odbieranie prania</p>
                                                <p class="service-price">od 15 zl</p>
                                            </li>
                                        </ul>
                                    </div>
                                     <div class="service-container">
                                        <h4>Pielegnacja ogrodu</h4>
                                        <ul class="service-list">
                                            <li>
                                                <p>Pielęgnacja ogrodu</p>
                                                <p class="service-price">od 100 zl</p>
                                            </li>
                                            <li>
                                                <p>Strzyżenie</p>
                                                <p class="service-price">od 25 zl</p>
                                            </li>
                                            <li>
                                                <p>Wycinka</p>
                                                <p class="service-price">od 25 zl</p>
                                            </li>
                                            <li>
                                                <p>Podlewanie trawników</p>
                                                <p class="service-price">od 25 zl</p>
                                            </li>
                                            <li>
                                                <p>Wypędzanie kretów</p>
                                                <p class="service-price">od 225 zl</p>
                                            </li>
                                            <li>
                                                <p>Odbieranie prania</p>
                                                <p class="service-price">od 15 zl</p>
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
