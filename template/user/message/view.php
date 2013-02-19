{% extends 'layout.php' %}

{% block page_title %}{{message.title}}{% endblock %}
{% block content %}
                   <div id="page-top">
                    <h1>{{ title }}</h1>
                    
                </div>

                <div id="main-topvote">
                    
                    <div class="content">
                        <div id="messages-container">
                        {% for message in messages %}
                            <p class="{% if (message.idUser==session.user_id) %}me{% else %}sender{% endif %}" > 
                                {{ message.idUser }}<br/> 
                                {{ message.idUserSend }}<br/>
                                {{ message.date_send }}<br/>
                                {{ message.text }}<br/>
                                {{ message.idMessageGroup }}<br/>
                                <a href="/profil/wiadomosci/{{ gallery.idGallery }}">{{ message.text }}</a><br/><br/>
                            </p>
                        {% else %}  
                            <p>There are currently no articles.</p>
                        {% endfor %}
                        </div>
                    </div>
                    <div class="button-container"><span id="back" class="button">Powrót</span><span id="reply" class="button">Odpowiedz</span></div>
                    <div class="hide">
                        <textarea id="text" name="text">Wpisz wiadomość</textarea><label for="text" class="text">Usuń znaki specjalne takie jak "<>?!" itp.</label>
                        <div class="button-container"><span id="send" class="button">Wyślij</span></div>
                        <input type="hidden" id="idUser" value="{{ messages[0].idUser}}"/>
                        <input type="hidden" id="idMessageGroup" value="{{ messages[0].idMessageGroup }}"/>
                        <input type="hidden" id="title" value="{{ title }}"/>
                    </div>
                </div>
{% endblock %}
