{% extends 'layout.php' %}

{% block page_title %}Strona główna{% endblock %}
{% block content %}
                    {% include 'left-boxes.php' %}
                    <div id="main-container">
                        <h2>
                            Cennik <span>(cena za m2)</span>
                        </h2>
                        <div id="cennik-container">
                            <div class="scrollbar"><div class="track"><div class="thumb"><div class="end"></div></div></div></div>
                            <div class="viewport">
                                <div class="overview">
                                    <div class="product-container">
                                        <div class="img-container">
                                            <img src="/public/images/cennik-drzewko.jpg" />
                                        </div>
                                        <div class="product-name">
                                            <h4>Abies Concolor</h4>
                                            <p>Cena od</p>
                                            <span href="" class="slide-down">Rozwiń</span>
                                            <ul>
                                                <li class="green">
                                                    <ul>
                                                        <li class="name">Abies Concolor</li>
                                                        <li class="lenght">50cm</li>
                                                        <li class="size">2l</li>
                                                        <li class="price">25zł</li>
                                                    </ul>
                                                </li>
                                                <li class="grey">
                                                    <ul>
                                                        <li class="name">Abies Concolor</li>
                                                        <li class="lenght">100cm</li>
                                                        <li class="size">4l</li>
                                                        <li class="price">50zł</li>
                                                    </ul>
                                                </li>
                                                <li class="green">
                                                    <ul>
                                                        <li class="name">Abies Concolor</li>
                                                        <li class="lenght">150cm</li>
                                                        <li class="size">6l</li>
                                                        <li class="price">75zł</li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="product-container">
                                        <div class="img-container">
                                            <img src="/public/images/cennik-drzewko.jpg" />
                                        </div>
                                        <div class="product-name">
                                            <h4>Abies Concolor</h4>
                                            <p>Cena od</p>
                                            <span href="" class="slide-down">Rozwiń</span>
                                            <ul>
                                                <li class="green">
                                                    <ul>
                                                        <li class="name">Abies Concolor</li>
                                                        <li class="lenght">50cm</li>
                                                        <li class="size">2l</li>
                                                        <li class="price">25zł</li>
                                                    </ul>
                                                </li>
                                                <li class="grey">
                                                    <ul>
                                                        <li class="name">Abies Concolor</li>
                                                        <li class="lenght">100cm</li>
                                                        <li class="size">4l</li>
                                                        <li class="price">50zł</li>
                                                    </ul>
                                                </li>
                                                <li class="green">
                                                    <ul>
                                                        <li class="name">Abies Concolor</li>
                                                        <li class="lenght">150cm</li>
                                                        <li class="size">6l</li>
                                                        <li class="price">75zł</li>
                                                    </ul>
                                                </li>
                                                <li class="grey">
                                                    <ul>
                                                        <li class="name">Abies Concolor</li>
                                                        <li class="lenght">100cm</li>
                                                        <li class="size">4l</li>
                                                        <li class="price">50zł</li>
                                                    </ul>
                                                </li>
                                                <li class="green">
                                                    <ul>
                                                        <li class="name">Abies Concolor</li>
                                                        <li class="lenght">150cm</li>
                                                        <li class="size">6l</li>
                                                        <li class="price">75zł</li>
                                                    </ul>
                                                </li>
                                                <li class="grey">
                                                    <ul>
                                                        <li class="name">Abies Concolor</li>
                                                        <li class="lenght">100cm</li>
                                                        <li class="size">4l</li>
                                                        <li class="price">50zł</li>
                                                    </ul>
                                                </li>
                                                <li class="green">
                                                    <ul>
                                                        <li class="name">Abies Concolor</li>
                                                        <li class="lenght">150cm</li>
                                                        <li class="size">6l</li>
                                                        <li class="price">75zł</li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                        
         
		<script type="text/javascript">
		$('#cennik-container').tinyscrollbar();
		</script>
{% endblock %}
