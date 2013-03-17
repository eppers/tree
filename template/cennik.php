{% extends 'layout.php' %}

{% block page_title %}Strona główna{% endblock %}
{% block content %}
                    {% include 'left-boxes.php' %}
                    <div id="main-container">
                        <h2>
                            Cennik <span>drzew i krzewów</span>
                        </h2>
                        <div id="cennik-container">
                            <div class="scrollbar"><div class="track"><div class="thumb"><div class="end"></div></div></div></div>
                            <div class="viewport">
                                <div class="overview">
                                    {% for grupa in grupy %}
                                    <div class="product-container">
                                        <div class="img-container">
                                            <img src="/public/images/{{grupa.img}}" alt="{{ grupa.nazwa }}"/>
                                        </div>
                                        <div class="product-name">
                                            <h4>{{ grupa.nazwa }}</h4>
                                            <p>Cena od</p>
                                            <span href="" class="slide-down">Rozwiń</span>
                                            <ul>
                                                
                                                {% for produkt in grupa.produkty %}
                                                <li class="{% if loop.index is divisibleby(2) %} grey {% else %} green {% endif %}">
                                                    <ul>
                                                        <li class="name"><a href="/thuja_occ_danica" title="Thuja occidentalis Żywotnik zachodni Danica" target="_blank">{{ produkt.nazwa_produktu }}</a></li>
                                                        <li class="lenght">{{ produkt.wysokosc }}</li>
                                                        <li class="size">{{ produkt.rozmiar }}</li>
                                                        <li class="price">{{ produkt.cena }}</li>
                                                    </ul>
                                                </li>
                                                {% else %}  
                                                <li>Brak produktów</li>
                                                {% endfor %}
                                                
                                            </ul>
                                        </div>
                                    </div>
                                    {% endfor %}
                         
                                </div>

                            </div>
                        </div>
                    </div>

                        
         
		<script type="text/javascript">
		$('#cennik-container').tinyscrollbar();
		</script>
{% endblock %}
