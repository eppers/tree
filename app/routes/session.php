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

$app->get('/internet-bezprzewodowy', function () use ($app) {

    $app->render('bezprzewodowy.php');
});

/*
 * Wyświetlenie strone
 */
$app->get('/:link', function ($link) use ($app) {
    $site=Model::factory('Site')->where('link', $link)->find_one();
    if($site instanceof Site)
    $app->render('page.php', array('content' => $site->content, 'title' => $site->title, 'link' => $site->link));
    else $app->redirect('/');
    //TODO jezeli nie instance of Site wywalic 404 
});


/*
 * Wyświetl listę programów
 */

$app->post('/view/programy', function () use ($app) {
   
    $channels=Model::factory('Program')->filter('getCategoryChannels',$app->request()->post('idKat'),$app->request()->post('idTematyka'))->find_many();
    
    if(count($channels)>0) {
        foreach ($channels as $key=>$channel) {
            $channelTab[$key]['id']=$channel->id_tv;
            $channelTab[$key]['img']=$channel->img;
            $channelTab[$key]['name']=$channel->name;
        }
        echo json_encode($channelTab);
    }
    else echo json_encode('NULL');
    
});

/*
 * Lista najnowszych plików (przedział czasowy miesiąc)
 */
$app->get('/najnowsze', function () use ($app) {
    $files = Model::factory('File')->filter('newest')->find_many();
    $app->render('new.php', array('files' => $files));
});

/*
 * Najlepiej oceniane pliki
 */
$app->get('/najlepiej-oceniane', function () use ($app) {

    $app->render('popular.php');
});

/*
 * Wyświetlanie nieswojego pliku
 */
$app->get('/plik/:name/:id', function () use ($app) {

    return$app->render('login.php');
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
