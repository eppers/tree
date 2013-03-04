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

    $app->render('cennik.php');
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

    $app->render('gallery.php');
});

$app->get('/thuja_occ_danica', function () use ($app) {

    $app->render('thuja_occ_danica.php');
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
