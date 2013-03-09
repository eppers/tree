{% extends 'layout.php' %}

{% block content %} 
<!-- start content-outer -->
<div id="content-outer">
<!-- start content -->
<div id="content">


<div id="page-heading"><h1>{% if form=='edit' %}Edytuj{% else %}Add{% endif %} produkt</h1></div>


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
   <form name="site-form" action="{% if form=='edit' %}/admin/drzewka/produkt/edytuj/{{produkt.id_drzewka_cennik_produkty}} {% else %} /admin/drzewka/produkt/dodaj {% endif %}" method="post" enctype="multipart/form-data">        
       
       
        <table border="0" cellpadding="0" cellspacing="0"  id="id-form">
            {% if form=='add' %}
                <tr>
                    <th valign="top">Wybierz jeden z dodanych już programów:</th>
                    <td>	
                    <select name="program-select" class="styledselect_form_1">
                            <option value="">wybierz program</option>
                        {% for program in programy %}
                            <option value="{{ id_drzewka_cennik_produkty }}">{{ produkt.nazwa }}</option>
                        {% endfor %}
                    </select>
                    </td>
                    <td></td>
		</tr> 
                <tr><td colspan="2" style="line-height: 40px; text-align: center; font-size: 13px; font-weight: bold;">lub wprowadź nowy</td></tr>
           {% endif %}
           
                <tr>
                    <th valign="top">Nazwa:</th>
                    <td><input type="text" name="name" class="inp-form" value="{{nazwa}}"/></td>
                    <td></td>
                </tr>	
                <tr>
                    <th valign="top">Pozycja:</th>
                    <td><input type="text" name="name" class="inp-form" value="{{pozycja}}"/></td>
                    <td></td>
                </tr>	
                <tr>
                    <th valign="top">Grupa:</th>
                    <td>
                        <div class="control-group">
                                <select id="selectError" data-rel="chosen">
                                    {% for grupa in grupy %}
                                    <option value="{{ grupa.id_cennik_drzewka_grupy }}" {% if grupa.id_cennik_drzewka_grupy==idGrupy %} selected {% endif %} >{{ grupa.nazwa }}</option>
                                    {% endfor %}
                                </select>
                            </div>
                        </div>
                    </td>
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