{% extends 'layout.php' %}

{% block page_title %}Strona główna{% endblock %}
{% block content %}
        {% include 'left-boxes.php' %}
                    <div id="main-container" class="kontakt">
                        <h2>
                            Kontakt
                        </h2>
                        <div id="kontakt-container">
                            <div id="left">
                                <div id="map"></div>
                                <div class="address">
                                    <span>
                                            ul. Prusa 21,
                                            43-400 Cieszyn.
                                    </span>
                                    <p>
                                            Telefon: <span >662 049 323</span><br>
                                            Telefon: <span >608 848 428</span><br>
                                            E-mail: <a class="mailLink" href="mailto:">kontakt@grasston.pl</a>
                                    </p>
                                </div>
                            </div>
                            <div id="right">
                                <form id="form1">
                                    <div class="success">Formularz wysłany<br>
                                        <strong>Skontaktujemy się z Tobą.</strong> 
                                    </div>
                                        <fieldset>
                                                <label class="name">
                                                        <input type="text" value="Imię:">
                                                        <span class="error">*To nie jest poprawne imie.</span> <span class="empty">*To pole jest wymagane.</span> </label>
                                                <br>
                                                <label class="email">
                                                        <input type="email" value="E-mail:">
                                                        <span class="error">*To nie jest poprawny adres email.</span> <span class="empty">*To pole jest wymagane.</span> </label>
                                                <br>
                                                <label class="phone">
                                                                    <input type="tel" value="Telefon:">
                                                                    <span class="error">*To nie jest poprawny numer telefonu.</span> <span class="empty">*To pole jest wymagane.</span> </label>
                                                <br>
                                                <label class="message">
                                                        <textarea>Wiadmość:</textarea>
                                                        <span class="error">*Wiadomość jest za krótka.</span> <span class="empty">*To pole jest wymagane.</span> </label>
                                                <br>
                                                <div class="btns"><a href="#" class="grey" data-type="reset">wyczyść</a><a href="#" class="more" data-type="submit">wyślij</a></div>
                                        </fieldset>
                                </form>
                            </div>
                                
                        </div>
                    </div>
 <script type="text/javascript">
     $(document).ready(function(){
      var map = new GMaps({
        div: '#map',
        lat: 49.736733,
        lng: 18.636525,
        disableDefaultUI: true,
        navigationControl: true
      });
      map.addMarker({
        lat: 49.736733,
        lng: 18.636525,
        title: 'Grasston'
      });
     
    });
  </script>
{% endblock %}
