        <div class="login-top" id="login-form-top">
            <div id="welcome">Witaj, <span>John Doe</span></div>
            <p id="last-login">Ostatnie logowanie:</p>
            <div id="logout-msg-container">
                <div class="logut"><a href="/wyloguj" class="logout">Wyloguj</a></div>
                <a id="msg-number" href="/profil/wiadomosci">
                    <span class="number">{% if session.unreaded >0 %}{{ session.unreaded }}{{ unreaded.opened }}{% else %}0{% endif %}</span>
                </a>
            </div>
        </div>
        <div class="menu">
            <p class="header">Profil użytkownika</p>
            <ul>
                <li><a href="/profil/edytuj">Twoje Dane</a></li>
                <li><a href="/profil/galeria">Twoje zbiory</a></li>
                <li><a href="/profil/wiadomosci">Twoje wiadomości</a></li>
            </ul>
        </div>