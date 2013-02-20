{% extends 'layout.php' %}

{% block content %} 
<!-- start content-outer -->
<div id="content-outer">
<!-- start content -->
<div id="content">


<div id="page-heading"><h1>{% if form=='edit' %}Edytuj{% else %}Add{% endif %} kanał</h1></div>


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
   <form name="site-form" action="{% if form=='edit' %}/admin/tv/pakiet/{{pakiet.id_tv_kategorie}}/programy/edit/{{program.id_tv}} {% else %} /admin/tv/pakiet/{{pakiet.id_tv_kategorie}}/programy/add {% endif %}" method="post" enctype="multipart/form-data">        
       
       
        <table border="0" cellpadding="0" cellspacing="0"  id="id-form">
            {% if form=='add' %}
                <tr>
                    <th valign="top">Wybierz jeden z dodanych już programów:</th>
                    <td>	
                    <select name="program-select" class="styledselect_form_1">
                            <option value="">wybierz program</option>
                        {% for program in programy %}
                            <option value="{{ program.id_tv }}">{{ program.name }}</option>
                        {% endfor %}
                    </select>
                    </td>
                    <td></td>
		</tr> 
                <tr><td colspan="2" style="line-height: 40px; text-align: center; font-size: 13px; font-weight: bold;">lub wprowadź nowy</td></tr>
           {% endif %}
                <tr>
                    <th valign="top">Nazwa:</th>
                    <td><input type="text" name="name" class="inp-form" value="{{program.name}}"/></td>
                    <td></td>
                </tr>	
                <tr>
                    <th valign="top">Obrazek:</th>
                    <td><input type="text" name="obrazek" class="inp-form" value="{{program.img}}"/></td>
                    <td style="display: block"><a href="#" title="Pliki 2MB, jpeg, png, gif." id="upload-file-enable" class="btn btn-danger">Wyślij obrazek</a></td>
                </tr>
                <tr id="upload-file">
                    <th valign="top">Wybierz obrazek:</th>
                    <td><input type="file" name="file" class="file_1" disabled="disabled"/></td>
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
        	<table border="0" width="50%" cellpadding="0" cellspacing="0" id="content-table">
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
		<!--  start content-table-inner ...................................................................... START -->
		<div id="content-table-inner">
		
			<!--  start table-content  -->
			<div id="table-content">
                                

				<!--  start product-table ..................................................................................... -->
				<form id="mainform" action="">
				<table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
				<tr>
					<th class="table-header-check"><a id="toggle-all" ></a> </th>
					<th class="table-header-repeat line-left minwidth-1"><a href="">Nazwa tematyki</a></th>
				</tr>
                           {% for tematyka in tematyki %}
				<tr {% if loop.index is divisibleby(2) %} class="alternate-row" {% endif %} >
                                    
					<td><input name="tematykaCheckboxArray[]" value="{{tematyka.id_tv_tematyka}}"  type="checkbox" {% for programTematyka in programTematyki %}{% if programTematyka.tv_tematyka_id==tematyka.id_tv_tematyka%}  checked="checked" {% endif %} {% endfor %}/></td>
                                    
					<td>{{ tematyka.name }}</td>
				</tr>
                        {% else %}  
                            <tr><td><p>Brak tematyki</p></td></tr>
                        {% endfor %}

				
				</table>
				<!--  end product-table................................... --> 
				</form>
			</div>
			<!--  end content-table  -->
		
	
			
			<div class="clear"></div>
		 
		</div>
		<!--  end content-table-inner ............................................END  -->
		</td>
		<td id="tbl-border-right"></td>
	</tr>
	<tr>
		<th class="sized bottomleft"></th>
		<td id="tbl-border-bottom">&nbsp;</td>
		<th class="sized bottomright"></th>
	</tr>
	</table>

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