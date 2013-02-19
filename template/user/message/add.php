{% extends 'layout.php' %}

{% block page_title %}{{message.title}}{% endblock %}
{% block content %}
                   <div id="page-top">
                    <h1>Tworzenie wiadomości</h1>
                    
                </div>
                <div id="main-topvote">
                    
                    <div id="message-container">
                        <div class="error"></div>                        
                        <div class="block" id="user-select-container">
                            <div id="usersList"></div>
                            <label for="user-select" />Do kogo chcesz wysłać wiadomość?</label><input type="text" id="user-select" rel="1">


                        </div>
                        <div class="block">    
                            <label for="message-title" />Tytuł Twojej wiadomości</label><input type="text" name="message-title" id="title">
                        </div>
                        <div class="block">
                            <label for="message-text" />Tekst wiadomości</label><textarea name="message-text"></textarea>
                        </div>

                    </div>
                    <div class="button-container"><span id="back" class="button">Powrót</span><span id="reply" class="button">Wyślij</span></div>

                </div>
{% endblock %}
