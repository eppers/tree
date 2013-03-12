{% extends 'layout.php' %}

{% block page_title %}Lista stron{% endblock %}
{% block content %} 
<!-- start content-outer ........................................................................................................................START -->
<div id="content-outer">
<!-- start content -->
<div id="content">

	<!--  start page-heading -->
	<div id="page-heading">
		<h1>Cennik drzewka</h1>
	</div>
	<!-- end page-heading -->
        <a href="/admin/drzewka/dodaj" id="add-program" class="btn btn-large btn-primary">Dodaj produkt</a>
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
		<!--  start content-table-inner ...................................................................... START -->
		<div id="content-table-inner">
		
			<!--  start table-content  -->
			<div id="table-content">
                                

				<!--  start product-table ..................................................................................... -->
				<form id="mainform" action="">
				<table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
				<tr>
					<th class="table-header-check"><a id="toggle-all" ></a> </th>
					<th class="table-header-repeat line-left minwidth-1"><a href="">Nazwa grupy</a></th>
					<th class="table-header-repeat line-left minwidth-1"><a href="">Nazwa produktu</a></th>
                                        <th class="table-header-repeat line-left minwidth-1"><a href="">Wysokość</a></th>
                                        <th class="table-header-repeat line-left minwidth-1"><a href="">Rozmiar</a></th>
                                        <th class="table-header-repeat line-left minwidth-1"><a href="">Cena</a></th>
                                        <th class="table-header-repeat line-left minwidth-1"><a href="">Pozycja produktu</a></th>
                                        <th class="table-header-options line-left"><a href="">Options</a></th>
				</tr>
                           {% for produkt in cennik %}
                            <tr {% if loop.index is divisibleby(2) %} class="alternate-row" {% endif %} >
                                    <td><input  type="checkbox"/></td>
                                    <td>{{ produkt.nazwa_grupy }}</td>
                                    <td>{{ produkt.nazwa_produktu }}</td>
                                    <td>{{ produkt.wysokosc }}</td>
                                    <td>{{ produkt.rozmiar }}</td>
                                    <td>{{ produkt.cena }}</td>
                                    <td>{{ produkt.pozycja_cena }}</td>
                                    <td class="options-width">
                                    <a href="/admin/drzewka/produkt/edytuj/{{ produkt.id_cena }}" title="Edit" class="icon-1 info-tooltip"></a>
                                    </td>
                            </tr>
                            {% else %}  
                                <tr><td><p>Brak stron</p></td><td>{{test}}</td></tr>
                        {% endfor %}

				
				</table>
				<!--  end product-table................................... --> 
				</form>
			</div>
			<!--  end content-table  -->
		
	
			<!--  start paging..................................................... -->
			<table border="0" cellpadding="0" cellspacing="0" id="paging-table">
			<tr>
			<td>
				<a href="" class="page-far-left"></a>
				<a href="" class="page-left"></a>
				<div id="page-info">Page <strong>1</strong> / 15</div>
				<a href="" class="page-right"></a>
				<a href="" class="page-far-right"></a>
			</td>
			<td>
			<select  class="styledselect_pages">
				<option value="">Number of rows</option>
				<option value="">1</option>
				<option value="">2</option>
				<option value="">3</option>
			</select>
			</td>
			</tr>
			</table>
			<!--  end paging................ -->
			
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
	<div class="clear">&nbsp;</div>

</div>
<!--  end content -->
<div class="clear">&nbsp;</div>
</div>
<!--  end content-outer........................................................END -->
{% endblock %}