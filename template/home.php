{% extends 'layout.php' %}

{% block page_title %}Strona główna{% endblock %}
{% block content %}
                 {% include 'left-boxes.php' %}
                    <div id="main-container">
                        <h2 style="text-transform: uppercase;">
                            Każdego roku produkujemy<br />
                            <span>kilkanaście tysięcy drzew i krzewów ozdobnych</span>
                        </h2>
                        <img src="/public/images/home_trees.jpg" />
                        <p>W ofercie posiadmy jendoroczne sadzonki jak i kilkuletnie drzewka</p>
                    </div>
{% endblock %}