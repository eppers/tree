{% extends 'layout.php' %}

{% block page_title %}Wszystkie pliki{% endblock %}
{% block content %}
                   <div id="page-top">
                    <h1>Strona Główna</h1>
                    <p>+ <span class="blue">12</span> wzorów</p>
                </div>

                <div id="main-topvote">
                    <div class="title"><a href="">Najlepiej oceniane</a><span>( ostatni tydzień )</span></div>
                    <div class="content">
                        {% for gallery in galleries %}
                            <p>{{ gallery.idGallery }}<br/> {{ gallery.idUser }}<br/> {{ gallery.title }}<br/><br/></p>
                        {% else %}  
                            <p>There are currently no articles.</p>
                        {% endfor %}
                    </div>
                </div>
{% endblock %}
