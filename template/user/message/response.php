    <p class="{% if (idUser==session.user_id) %}me{% else %}sender{% endif %}" > 
        {{ idUser }}<br/> 
        {{ idUserSend }}<br/>
        {{ date_send }}<br/>
        {{ text }}<br/>
        {{ idMessageGroup }}<br/>
        <a href="/profil/wiadomosci/{{ idMessageGroup }}">{{ text }}</a><br/><br/>
    </p>
