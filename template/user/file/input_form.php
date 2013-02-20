{% extends 'layout.php' %}

{% block page_title %}Wszystkie pliki{% endblock %}
{% block content %}
                   <div id="page-top">
                    <h1>{{file.title|default('Dodaj nowy plik')}}</h1>
                    
                </div>

                <div id="main-topvote">
                    <div class="title"><a href="">Najlepiej oceniane</a><span>( ostatni tydzień )</span></div>
                    <div class="content">
                        <div class="login-top" id="login-form-top">
                            <div class="error">{{error}}</div>
                            <form action="{{action_url}}" method="post" id="formFile" name='file' enctype="multipart/form-data">
                                <p>
                                        <label for="idGallery">Galeria: </label><br />

                                        <select id="idGallery" name="idGallery">
                                        {% for gallery in galleries %}
                                            <option value="{{gallery.idGallery}}" {% if file.idGallery == gallery.idGallery %} selected {% endif %}>{{gallery.title}}</option>
                                        {% endfor %}
                                        </select>
                                        <span id="addGallery" class="button">addGallery</span><input id="galleryTitle" type="text" />
                                </p>
                                <p>
                                        <label for="title">Tytuł: </label><br />
                                        <input type="text" name="title" value="{{ file.title|default('') }}" id="title" />
                                        <label id="title_error" class="error">Wypełnij pole </label>
                                </p>

                                <p>
                                        <label for="desc">Opis: </label><br />
                                        <textarea name="desc" id="desc" rows="10" cols="20">{{ file.desc|default('') }}</textarea>
                                        <label id="desc_error" class="error">Wypełnij pole </label>
                                </p>
                                <p>
                                    <label for="photo">Photo upload: </label><br />
                                    <input type="file" name="file" value="" id="file" maxlength="20"/>
                                </p>
                                <p>
                                    <input type="submit" id="inputFormSubmit" value="Wyślij" />
                                </p>
                                
                            </form>
                        </div>
                    </div>
                </div>
{% endblock %}
