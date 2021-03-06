{% extends 'layout.php' %}

{% block content %} 
<!-- start content-outer -->
<div id="content-outer">
<!-- start content -->
<div id="content">


<div id="page-heading"><h1>{% if form=='edit' %}Edytuj{% else %}Dodaj{% endif %} produkt</h1></div>


<table border="0" width="100%" cellpadding="0" cellspacing="0" id="content-table">
<tr>
	<th rowspan="3" class="sized"><img src="/public/admin/img/shared/side_shadowleft.jpg" width="20" height="300" alt="" /></th>
	<th class="topleft"></th>
	<td id="tbl-border-top">&nbsp;</td>
	<th class="topright"></th>
	<th rowspan="3" class="sized"><img src="/public/admin/img/shared/side_shadowright.jpg" width="20" height="300" alt="" /></th>
</tr>
<tr>
	<td id="tbl-border-left"></td>
	<td>
	<!--  start content-table-inner -->
	<div id="content-table-inner">
	
	<table border="0" width="100%" cellpadding="0" cellspacing="0">
	<tr valign="top">
	<td>
        {% if error is defined %}
            {% include 'error.php' %}
        {% endif %}
		<!-- start id-form -->
   <form name="site-form" action="{% if form=='edit' %}/admin/drzewka/produkt/edytuj/{{cena.id_cennik_drzewka_ceny}} {% else %} /admin/drzewka/produkt/dodaj {% endif %}" method="post" enctype="multipart/form-data">        
       
       
        <table border="0" cellpadding="0" cellspacing="0"  id="id-form">
                <tr>
                    <th valign="top">Nazwa:</th>
                    <td>
                        <div class="control-group">
                            <select id="selectError" data-rel="chosen" name="idProd">
                                    {% for produkt in produkty %}
                                    <option value="{{ produkt.id_cennik_drzewka_produkty }}" {% if produkt.id_cennik_drzewka_produkty==cena.id_cennik_drzewka_produkty %} selected {% endif %} >{{ produkt.nazwa }}</option>
                                    {% endfor %}
                            </select>
                        </div>
                    </td>
                </tr>	
                <tr>
                    <th valign="top">Wysokość:</th>
                    <td><input type="text" name="wysokosc" class="inp-form" value="{{cena.wysokosc}}"/></td>
                    <td></td>
                </tr>
                <tr>
                    <th valign="top">Rozmiar:</th>
                    <td><input type="text" name="rozmiar" class="inp-form" value="{{cena.rozmiar}}"/></td>
                    <td></td>
                </tr>
                <tr>
                    <th valign="top">Cena:</th>
                    <td><input type="text" name="cena" class="inp-form" value="{{cena.cena}}"/></td>
                    <td></td>
                </tr>        
                <tr>
                    <th valign="top">Pozycja:</th>
                    <td><input type="text" name="pozycja" class="inp-form" value="{{cena.pozycja}}"/></td>
                    <td></td>
                </tr>	
                <tr>
                    <th>&nbsp;</th>
                    <td valign="top">
                            <button type="submit" class="btn btn-primary" >Zapisz</button>
                            <input type="reset" value="" class="form-reset"  />
                    </td>
                    <td></td>
                </tr>
	</table>
	<!-- end id-form  -->

    </form>
	</td>
	<td>

</td>
</tr>
<tr>
<td><img src="/public/admin/img/shared/blank.gif" width="695" height="1" alt="blank" /></td>
<td></td>
</tr>
</table>
 
<div class="clear"></div>
 

</div>
<!--  end content-table-inner  -->
</td>
<td id="tbl-border-right"></td>
</tr>
<tr>
	<th class="sized bottomleft"></th>
	<td id="tbl-border-bottom">&nbsp;</td>
	<th class="sized bottomright"></th>
</tr>
</table>









 





<div class="clear">&nbsp;</div>

</div>
<!--  end content -->
<div class="clear">&nbsp;</div>
</div>
<!--  end content-outer -->
{% endblock %}