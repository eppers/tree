<?php

/*
 * Wyświetlenie strony głównej
 */
$app->get('/', function () use ($app) {

    $app->render('home.php');
});

/*
 * Strona główna po kliknieciu w link ' Strona Główna ' 
 */
$app->get('/home', function () use ($app) {

    $app->render('home.php');
});

$app->get('/o-szkolce', function () use ($app) {

    $app->render('o-szkolce.php');
});

$app->get('/kontakt', function () use ($app) {

    $app->render('kontakt.php');
});

$app->get('/cennik', function () use ($app) {

    $tabCennik = array();
   
    $grupy = Model::factory('CennikDrzewkaGrupa')->order_by_asc('pozycja')->find_many();
    
    foreach($grupy as $grupa) {
        
        if($grupa instanceof CennikDrzewkaGrupa) {

            $produkty = $grupa->produkt()->order_by_asc('pozycja')->find_many();
            
            foreach( $produkty as $produkt ) {
                if($produkt instanceof CennikDrzewkaProdukt) {
                            
                    $ceny = $produkt->cena()->order_by_asc('pozycja')->find_many();
                  //   print_r($tabProdukty['nazwa']);
                    foreach($ceny as $cena){
                        if($cena instanceof CennikDrzewkaCena) {
                          
                              $tabTemp['id_cena']=$cena->id_cennik_drzewka_ceny;
                              $tabTemp['wysokosc'] = $cena->wysokosc;
                              $tabTemp['rozmiar'] = $cena->rozmiar;
                              $tabTemp['cena'] = $cena->cena;
                              $tabTemp['nazwa_produktu']=$produkt->nazwa;
                              $tabTemp['pozycja_produktu']=$produkt->pozycja;
                              $tabTemp['pozycja_cena']=$cena->pozycja;
                              $tabTemp['id_prod']=$produkt->id_cennik_drzewka_produkty;
                              $tabTemp['nazwa_grupy'] = $grupa->nazwa;
                              $tabTemp['id_gr'] = $grupa->id_cennik_drzewka_grupy;
                              
                              $tabCennik[]=$tabTemp;
                              
                        }
                        
                    }
                   
                  
                }
                
            }
            
        }
    }

    
    $app->render('cennik.php',array('cennik'=>$tabCennik));
});

$app->get('/cennik-uslugi', function () use ($app) {

    $app->render('cennik-uslugi.php', array('sliderfoto'=>'slider-services.jpg'));
});

$app->get('/transport', function () use ($app) {

    $app->render('transport.php');
});

$app->get('/galeria', function () use ($app) {

    $app->render('galeria.php');
});

$app->get('/uslugi', function () use ($app) {

    $app->render('uslugi.php');
});

$app->get('/szkolka-galeria', function () use ($app) {
    
    $fileArray = array();
    
    $dir = opendir('./public/images/gallery/thumbs/');
    while(false !== ($file = readdir($dir)))
    if($file != '.' && $file != '..') 
    $fileArray[] = $file;
    
    $app->render('gallery.php', array('files'=>$fileArray));
});

$app->get('/thuja_occ_danica', function () use ($app) {

    $app->render('thuja_occ_danica.php');
});

$app->get('/thuja_occ_aureospicata', function () use ($app) {

    $app->render('thuja_occ_aureospicata.php');
});

$app->get('/thuja_occ_brabant', function () use ($app) {

    $app->render('thuja_occ_brabant.php');
});

$app->get('/thuja_occ_colens_gold', function () use ($app) {

    $app->render('thuja_occ_colens_gold.php');
});

$app->get('/thuja_occ_kornik', function () use ($app) {

    $app->render('thuja_occ_kornik.php');
});

$app->get('/thuja_occ_smaragd', function () use ($app) {

    $app->render('thuja_occ_smaragd.php');
});

$app->get('/choina_nana', function () use ($app) {

    $app->render('choina_nana.php');
});

$app->get('/cis_hicksii', function () use ($app) {

    $app->render('cis_hicksii.php');
});

$app->get('/cyprysik_alumii', function () use ($app) {

    $app->render('cyprysik_alumii.php');
});

$app->get('/cyprysik_golden', function () use ($app) {

    $app->render('cyprysik_golden.php');
});

$app->get('/jalowiec_blue_carpet', function () use ($app) {

    $app->render('jalowiec_blue_carpet.php');
});

$app->get('/jalowiec_blue_star', function () use ($app) {

    $app->render('jalowiec_blue_star.php');
});

$app->get('/swierk_conica', function () use ($app) {

    $app->render('swierk_conica.php');
});
/*
 * Logowanie - wyświetlanie formularza
 */
$app->get('/logowanie', function () use ($app) {

    return$app->render('login.php');
});

/*
 * Logowanie - wysłanie formularza
 */
$app->post('/logowanie', function () use ($app) {
    $user = Model::factory('User')->where('login',$app->request()->post('login'))->where('password', md5($app->request()->post('password')))->find_one();
$login=$app->request()->post('login');
$pass=$app->request()->post('password');
var_dump($user);
    if ( $user instanceof User) {
            $_SESSION['user_id'] = $user->idUser;
            $_SESSION['login'] = $user->login;   
            $app->redirect('/home');
		
	}
    else {
        $app->render('login.php', array('info'=>'Login lub hasło niepoprawne'));
    }

});

/*
 * Wyloguj
 */
$app->get('/wyloguj', function () use ($app) {
    
    session_destroy();
    
    $app->redirect('/home');
});










?>
