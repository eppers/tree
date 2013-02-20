{% extends 'layout.php' %}
 
{% block page_title %}Logowanie{% endblock %}
 
{% block content %}
                <div id="page-top">
                    <h1>Logowanie</h1>
                </div>

                <div id="main-topvote">
                    <div class="title">Logowanie</div>
                    <div class="content">
                        {{info}}{{login}}{{pass}}
                        <form action="/logowanie" method="post">
	                    <p>
                                    <label for="title">Login: </label><br />
                                    <input type="text" name="login" value="" id="login" />
                            </p>

                            <p>
                                    <label for="author">Hasło: </label><br />
                                    <input type="text" name="password" value="" id="password" />
                            </p>
                            <p>
                                    <input type="submit" value="Zaloguj" />
                            </p>
                        </form>
                    </div>
                </div>
   
{% endblock %}