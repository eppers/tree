{% extends 'layout.php' %}

{% block page_title %}O szkółce{% endblock %}
{% block content %}
                  {% include 'left-boxes.php' %}
                     <div id="main-container" class="gallery">
                        <h2>
                            Galeria
                        </h2>
                         <div>
                             <ul>
                                 {% for file in files %}
                                 <li><a href="/public/images/gallery/{{file.url}}" rel="gallery"  class="pirobox_gall" title="{{file.alt}}"><img src="/public/images/gallery/thumbs/{{file.url}}" alt="{{file.alt}}" /></a></li>
                                 {% endfor %}
                             </ul>
                         </div>
                    </div>
<script type="text/javascript">
$(document).ready(function() {
	$().piroBox_ext({
	piro_speed : 700,
		bg_alpha : 0.5,
		piro_scroll : true // pirobox always positioned at the center of the page
	});
});
</script>
{% endblock %}