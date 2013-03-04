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
                                 <li><a href="/public/images/gallery/1.png" rel="gallery"  class="pirobox_gall" title="Lights"><img src="/public/images/gallery/thumbs/1.png"  /></a></li>
                                 <li><a href="/public/images/gallery/2.png" rel="gallery"  class="pirobox_gall" title="Lights"><img src="/public/images/gallery/thumbs/2.png"  /></a></li>
                                 <li><a href="/public/images/gallery/3.png" rel="gallery"  class="pirobox_gall" title="Lights"><img src="/public/images/gallery/thumbs/3.png"  /></a></li>
                                 <li><a href="/public/images/gallery/4.png" rel="gallery"  class="pirobox_gall" title="Lights"><img src="/public/images/gallery/thumbs/4.png"  /></a></li>
                                 <li><a href="/public/images/gallery/5.png" rel="gallery"  class="pirobox_gall" title="Lights"><img src="/public/images/gallery/thumbs/5.png"  /></a></li>
                                 <li><a href="/public/images/gallery/6.png" rel="gallery"  class="pirobox_gall" title="Lights"><img src="/public/images/gallery/thumbs/6.png"  /></a></li>
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