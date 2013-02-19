{% extends 'layout.php' %}

{% block page_title %}Wszystkie pliki{% endblock %}
{% block content %}
                   <div id="page-top">
                    <h1>{{gallery.title}}</h1>
                    <p>edytuj</p>
                </div>

                <div id="main-topvote">
                    <div class="title"><a href="">Pliki w galerii</a></div>
                    <div class="content">
                        {% for file in files %}
                            <p><a href="/profil/plik/edytuj/{{file.idFile}}">{{ file.title }}</a><br/> {{ file.desc }}<br/><br/></p>
                        {% else %}  
                            <p>Brak plików w tym folderze</p>
                        {% endfor %}
                    </div>
                </div>
{% endblock %}
