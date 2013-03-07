<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>{% block page_title %} {% endblock %}</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="/public/css/reset.css"></link>
<link rel="stylesheet" href="/public/css/bjqs.css"></link>
<link rel="stylesheet" href="/public/css/demo.css"></link>
<link rel="stylesheet" href="/public/css/style.css"></link>

<link href="/public/css/css_pirobox/style_1/style.css" rel="stylesheet" type="text/css" />

<script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
<script type="text/javascript" src="/public/js/jquery-ui-1.8.2.custom.min.js"></script>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>

<script src="/public/js/bjqs-1.3.min.js"></script>
<script src="/public/js/forms.js"></script>
<script src="/public/js/googleMap.js"></script>
<script src="/public/js/pirobox_extended.js"></script>



 
<script src="/public/js/jquery.scripts.js"></script>
</head>
<body>

	<div id="top-bg">
            <div id="top-site-bg" class="site">
                <div class="page">
                    <h1><a href="/" id="logo">Grasston</a></h1>
                    <p id="telephone-top">662 049 323 <span>608 848 428</span></p>
                </div>
            </div>
        </div>
    
	<div id="menu-bg">
            <div id="menu-site-bg" class="site">
                <div class="page">
                    <ul>
                        <li><a href="./home">Strona główna</a></li>
                        <li><a href="./o-szkolce">O szkółce</a></li>
                        <li><a href="./cennik">Cennik krzewów</a></li>
                        <li><a href="./cennik-uslugi">Cennik Usług</a></li>
                        <li><a href="http://allegro.pl/listing/user/listing.php?us_id=27977212" target="_blank">Allegro</a></li>
                        <li><a href="./kontakt">Kontakt</a></li>
                    </ul>
                </div>
            </div>
        </div>
    
	<div id="middle-bg">
            <div id="middle-site-bg" class="site">
                <div class="page">
                    <div id="slider">
                        <div id="left-container">
                            <div id="top">
                                <!--  Outer wrapper for presentation only, this can be anything you like -->
                                <div id="banner-fade">

                                    <!-- start Basic Jquery Slider -->
                                    <ul class="bjqs">
                                    <li><img src="/public/images/slider-top.jpg" title=""></li>
                                    <li><img src="/public/images/slider-top2.jpg" title=""></li>
                                    <li><img src="/public/images/slider-top3.jpg" title=""></li>
                                    <li><img src="/public/images/slider-top4.jpg" title=""></li>
                                    </ul>
                                    <!-- end Basic jQuery Slider -->

                                </div>
                                <!-- End outer wrapper -->

                                <script class="secret-source">
                                    jQuery(document).ready(function($) {

                                    $('#banner-fade').bjqs({
                                        height      : 138,
                                        width       : 375,
                                        responsive  : true,
                                        showcontrols : false,
                                        showmarkers : false,
                                        usecaptions : false
                                    });

                                    });
                                </script>
                                <div class="scrollingtext-container">
                                    <div class="scrollingtext">
                                        <ul>
                                            <li>Smaragd</li>
                                            <li>Jodła kaukaska</li>
                                            <li>Kórnik</li>
                                            <li>Brabant</li>
                                            <li>Jodła koreańska</li>
                                            <li>Conica</li>
                                            <li>Blue Carpet</li>
                                            <li>Cyprysik Lawsona 'Ivonne'</li>
                                            <li>Kosodrzewina mughus</li>
                                            <li>Sosna bośniacka</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div id="bottom">
                                <h2>Szkółka drzewek i krzewów ozdobnych</h2>
                                <p>Szymon i Tomasz Czudek</p>
                                <p id="grey">Zapraszamy do odwiedzin</p>
                            </div>
                        </div>
                        <div id="right-container">
                            <img src="/public/images/{% if sliderfoto is defined %}{{sliderfoto}}{% else %}slider-homepage-trees.jpg{% endif %}" alt="Szkółka drzewek i krzewów ozdobnych" width="525" />
                        </div>
                    </div>
                </div>        
            </div>
        </div>
		
	<div id="content-bg">
            <div id="content-site-bg" class="site">
                <div class="page">
                    {% block content %} {% endblock %}
                </div>  
            </div>
	</div>
    
	<div id="footer-bg">
            <div id="footer-site-bg" class="site">
                <div class="page">
                    <div id="footer-left">
                        <p class="title">Kontakt</p>
                        <div>
                            <p id="footer-address">
                                ul. B. Prusa 21<br />
                                43-400 Cieszyn
                            </p>
                            <p id="footer-telephone">
                                662 049 323<br />
                                608 848 428
                            </p>
                        </div>
                        <p id="footer-email">kontakt@grasston.pl</p>
                    </div>
                    <div id="footer-right">
                        <p class="title">Nasze usługi</p>
                        <ul id="footer-uslugi-container">
                            <li>
                                <ul>
                                    <li><a href="">wykop dziur pod sadzonki</a></li>
                                    <li><a href="">sadzenie drzew i krzewów</a></li>
                                    <li><a href="">porządkowanie terenu</a></li>
                                </ul>
                            </li>
                            <li>
                                <ul>
                                    <li><a href="">koszenie zarośli i nieużytków</a></li>
                                    <li><a href="">wycinka, pielęgnacja i zrywka drzew</a></li>
                                    <li><a href="">kształtowanie i niwelacja terenu</a></li>
                                </ul>                                
                            </li>
                            <li>
                                <ul>
                                    <li><a href="">dowóz ziemi ogrodowej, piasku, żwiru</a></li>
                                    <li><a href="">jesienne uprzątanie liści i ich wywóz</a></li>
                                    <li><a href="">pielęgnacja trawników</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>        
            </div>
        </div>

</body>
</html>