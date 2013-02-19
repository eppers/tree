{% extends 'layout.php' %}

{% block page_title %}Wszystkie pliki{% endblock %}
{% block content %}
                   <div id="page-top">
                    <h1>Galerie</h1>
                    <p>+ <span class="blue">12</span> wzorów</p>
                </div>

                <div id="main-topvote">
                    <div class="title">Wszystkie galerie</div>
                    <div class="content">
                        {% for gallery in galleries %}
                            <p> 
                                {{ gallery.idGallery }}<br/> 
                                {{ gallery.idUser }}<br/>
                                <a href="/profil/galeria/{{ gallery.idGallery }}">{{ gallery.title }}</a><br/><br/>
                            </p>
                        {% else %}  
                            <p>There are currently no articles.</p>
                        {% endfor %}
                    </div>
                </div>
{% endblock %}
