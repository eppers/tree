{% extends 'layout.php' %}

{% block page_title %}Strona główna{% endblock %}
{% block content %}
                     {% include 'left-boxes.php' %}
                    <div id="main-container" class="transport">
                        <h2>
                            Transport
                        </h2>
                        <div id="transport-container">
                            <p>
                                Zapraszamy do skorzystania z oferty transportu wybranych drzewek i krzewów zakupionych
                                w naszej szkółce.
                            </p>
                            <div class="transport-option">
                                <div class="left">
                                    <ul id="transport-price">
                                        <li>do 10 km - 35 zł</li>
                                        <li>do 30 km  - 85 zł</li>
                                        <li>od 30 km  - 2,5zł/km</li>
                                    </ul>
                                </div>
                                <div class="right">
                                    <img src="/public/images/transport_merc.jpg" alt="transport drzewek" id="merc"/>
                                </div>

                            </div>
                            <div class="transport-option">
                                <div class="left">
                                    <img src="/public/images/transport_promo.jpg" alt="tranposrt promocja" id="promocja"/>
                                </div>
                                <div class="right">
                                    <img src="/public/images/transport_przyczepa.jpg" alt="trasport przyczepa" id="przyczepa"/>
                                </div>
                            </div>
                        </div>
                    </div>
{% endblock %}
