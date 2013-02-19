{% extends 'layout.php' %}

{% block page_title %}Wszystkie wiadomości{% endblock %}
{% block content %}
                <div id="page-top">
                    <h1>Galerie</h1>
                    <p>+ <span class="blue">12</span> wzorów</p>
                </div>
                <div id="main-buttons">
                    <a href="/profil/wiadomosci/dodaj" class="button">Stwórz wiadomość</a>
                </div>

                <div id="main-topvote">
                    <div class="title">Wiadomości</div>
                    <div class="content">
                        {% for group in groups %}
                            <p {%if(group.opened==1)%}style="font-weight: bold;"{%endif%}> 
                                {{ group.idUser }}<br/> 
                                <span style="color: red">{{ logins[group.idUserSend] }}</span><br/>
                                {{ group.idUserSend }}<br/>
                                {{ group.date_send }}<br/>
                                {{ group.text }}<br/>
                                {{ group.idMessageGroup }}<br/>
                                <a href="/profil/wiadomosci/{{ group.idMessageGroup }}">{{ group.title }}</a><br/><br/>
                            </p>
                        {% else %}  
                            <p>There are currently no groups.</p>
                        {% endfor %}
                    </div>
                </div>
{% endblock %}
