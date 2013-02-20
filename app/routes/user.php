<?php

$auth=function () use($app) {
    if(!isset($_SESSION['user_id']))
    $app->redirect('/logowanie');    
};



/*
 * Jeżeli użytkownik jest zalogowany, pobiera ilość nowych wiadomości
 */

if(isset($_SESSION['user_id'])){
    $unreaded=Model::factory('Message')->filter('getCountUnreadedGroups',$_SESSION['user_id']);
    $_SESSION['unreaded']=$unreaded->opened;
    
}

// PROFIL


$app->get('/profil/edytuj',$auth ,function () use ($app) {
    $data = array(
       'heading' => 'Moja dane edytuj',
       'message' => 'To sa moje dane do edycji.'
   );
    $app->render('user/edit.php',$data);
});



// GALERIE



/**
 *Wyświetlanie wszystkie galerie użytkownika 
 */
$app->get('/profil/galeria',$auth , function () use ($app) {

    $user=Model::factory('User')->find_one($_SESSION['user_id']);
    $galleries=$user->galleries()->find_many();

    $app->render('user/gallery/all.php',array('galleries' => $galleries));
});



/*
 * TODO: 1. Czy dodawanie galerii ma być od razu dostępne czy dopiero po kliknięciu ?
 */

//Dodaj galerię
$app->get('/profil/galeria/dodaj',$auth ,function () use ($app) {
    
    $app->render('user/gallery/add.php');
});

$app->post('/profil/galeria/dodaj',$auth ,function () use ($app) {
    
    $gallery = Model::factory('Gallery')->create();
    $gallery->idUser = $_SESSION['user_id'];
    $gallery->title   = $app->request()->post('data1');
    $gallery->save();
    
    $user = Model::factory('User')->find_one($_SESSION['user_id']);
    $gallery=$user->galleries()->filter('getGalleryDesc')->find_one();
    
    $respond= array();
    if ($gallery instanceof Gallery )    {
        $respond['id']=$gallery->idGallery;
        $respond['info']='Galleria została dodana';
   
    }
    else {
        $respond['id']='NULL';
        $respond['info']='Galleria NIE została dodana';
    }

    echo json_encode($respond);


    
});

//Edytuj galerię
$app->post('/profil/galeria/edytuj/:id',$auth ,function () use ($app) {
    $data = array(
       'heading' => 'Moja dane edytuj',
       'message' => 'To sa moje dane do edycji.'
   );
    $app->render('user/gallery/edit.php',$data);
});

//Usuń galerię
$app->post('/profil/galeria/usun/:id',$auth ,function () use ($app) {
    $data = array(
       'heading' => 'Moja dane edytuj',
       'message' => 'To sa moje dane do edycji.'
   );
    $app->render('user/gallery/delete.php',$data);
});

//Wyświetla pliki w danej galerii
$app->get('/profil/galeria/:id',$auth ,function ($id) use ($app) {
    
    $gallery=Model::factory('Gallery')->find_one($id);
    $files=$gallery->files()->find_many();
    
    $app->render('user/gallery/view.php',array('gallery' => $gallery, 'files' => $files ));
});




// PLIKI



//Dodaj plik
$app->get('/profil/plik/dodaj',$auth ,function () use ($app) {
    
    $user = Model::factory('User')->find_one($_SESSION['user_id']);
    $galleries = $user->galleries()->find_many();
    
    $app->render('user/file/input_form.php',array('action_url'=>'/profil/plik/dodaj', 'galleries' => $galleries));
});


$app->post('/profil/plik/dodaj',$auth ,function () use ($app) {
    
    $typeAllowed = array('jpg', 'png', 'gif', 'jpeg');  
    $WORKSPACE = 'upload/'.$app->request()->post('idGallery').'/';
    $unique_id = md5(uniqid(rand(), true));
    $media = $_FILES['file']['name'];
    $filetype = substr(strrchr($media,'.'),1);
    $new_upload = $WORKSPACE . $unique_id . '.' . $filetype;
    $fileSize = @filesize($_FILES['file']['tmp_name']);
    
  
    $MAX_FILENAME_LENGTH = 20; //długość nazwy
    $max_file_size_in_bytes = 2097152; //2MB
    $valid_chars_regex = 'A-Za-z0-9śćżźółąęń\-\s';
    
    $idGallery=$app->request()->post('idGallery');
    
    try {
        if (empty($idGallery)) 
             throw new Exception('Nie wybrano galerii');
        
// Jeżeli katalog z ID danej galerii nie istnieje, to zostaje utworzony        
        if (!file_exists($WORKSPACE)) {
            @mkdir($WORKSPACE, 0777);
        };
        if (!isset($_FILES['file']))
                throw new Exception('Nie ma pliku do przesłania');
        else if (isset($_FILES['file']['error']) && $_FILES['file']['error'] != 0)
                throw new Exception('Błąd pliku - wybierz plik');
        else if (!isset($_FILES['file']['tmp_name']) || !@is_uploaded_file($_FILES['file']['tmp_name'])) 
                throw new Exception('Błąd pliku - test us_uploaded_file');
        else if (!isset($_FILES['file']['name']))
                throw new Exception('Błąd pliku - brak nazwy');

// Walidacja rozmiaru pliku        
        if (!$fileSize || $fileSize > $max_file_size_in_bytes)
                throw new Exception('Za duży rozmiar pliku');
        if ($fileSize <= 0)
                throw new Exception('Rozmiar pliku jest za mały');

// Walidacja czy jest to obrazek na podstawie typu MIME        
         if(!preg_match('%image/%', $_FILES['file']['type']))
                throw new Exception('Niewłaściwy format pliku!');
         
// Walidacja czy jest to obrazek
        $imageinfo = getimagesize($_FILES['file']['tmp_name']);
        
        if($imageinfo['mime'] != 'image/gif' && $imageinfo['mime'] != 'image/jpeg' && $imageinfo['mime'] != 'image/png' && isset($imageinfo))
                throw new Exception('Akceptowalne pliki: jpeg, gif, png');
        
// Walidacja nazwy pliku (usunięcie niewłaściwych znaków)
        $file_name = preg_replace('/[^'.$valid_chars_regex.']+$/i', '', strtolower(basename($_FILES['file']['name'])));
        if (strlen($file_name) == 0 || strlen($file_name) > $MAX_FILENAME_LENGTH)
                throw new Exception('Niewłaściwa nazwa pliku z preg replace');

// Walidacja rozszerzenia pliku na podstawie tablicy
        
        if(!in_array($filetype, $typeAllowed))
                throw new Exception('Niewłaściwe rozszerzenie pliku'.$filetype);

        
        
        if(copy($_FILES['file']['tmp_name'], $new_upload)) {
            $uploaded_file   = $new_upload;
            @chmod($uploaded_file, 0777);
        }
        else throw new Exception('Plik nie został utworzony');
    }
    catch (Exception $e) {
        $user = Model::factory('User')->find_one($_SESSION['user_id']);
        $galleries = $user->galleries()->find_many();
        $app->render('user/file/input_form.php',array('action_url'=>'/profil/plik/dodaj', 'galleries' => $galleries, 'file' => $app->request()->post(), 'error' => $e->getMessage()));
        exit();
    }
    
    $file = Model::factory('File')->create();
    $file->title   = $app->request()->post('title');
    $file->desc  = $app->request()->post('desc');
    $file->idGallery    = $app->request()->post('idGallery');
    $file->date_add = date('Y-m-d H:i:s');
    $file->foto = $uploaded_file;
    $file->save();
        
    
    
    $app->redirect('/profil/galeria/'.$app->request()->post('idGallery'));
});


//Edytuj plik
$app->get('/profil/plik/edytuj/:id',$auth ,function ($id) use ($app) {
    
    $user = Model::factory('User')->find_one($_SESSION['user_id']);
    $galleries = $user->galleries()->find_many();
    $file = Model::factory('File')->find_one($id);
    
    if ($file instanceof File) {
        $app->render('user/file/input_form.php',array('action_url'=>'/profil/plik/edytuj/'.$id, 'galleries' => $galleries, 'file' => $file));
    }
    else {
        $app->notFound();
    }
    
});
    

$app->post('/profil/plik/edytuj/:id',$auth ,function ($id) use ($app) {
    
    $file = Model::factory('File')->find_one($id);
    
    if ($file instanceof File) {
        $file->title   = $app->request()->post('title');
        $file->desc  = $app->request()->post('desc');
        $file->idGallery    = $app->request()->post('idGallery');
        $file->save();

        $app->redirect('/profil/galeria/'.$file->idGallery);
    }
    else {
        $app->notFound();
    }

    
});

//Usuń konkrenty plik
$app->get('/profil/plik/usun/:id',$auth ,function ($id) use ($app) {

    $file = Model::factory('File')->filter('isUserFile',$_SESSION['user_id'])->find_one($id);
        
    if ($file instanceof File) {
       $file->delete();
       $app->redirect('/profil/galeria/'.$file->idGallery);
    }
    else {
       $app->notFound();
    }
   
});


// WIADOMOŚCI

//Wyświetl listę wiadomości

$app->get('/profil/wiadomosci',$auth ,function () use ($app) {

    $groups=Model::factory('Message')->filter('getGroups', $_SESSION['user_id'])->find_many();
    
    foreach ($groups as $group) {
        $users[]=$group->idUserSend;
    }

    
    $users=Model::factory('User')->filter('getUserLogin',$users);
    
    foreach($users as $user) {
        $logins[$user->idUser]=$user->login;
    }
    
    $app->render('user/message/all.php',array('groups' => $groups, 'logins' => $logins));
   
});


//Dodaj wiadmość
$app->get('/profil/wiadomosci/dodaj',$auth ,function () use ($app) {

   $app->render('user/message/add.php');
});

$app->post('/profil/wiadomosci/dodaj',$auth ,function () use ($app) {
    
    $message = Model::factory('Message')->create();
    $message->idUser   = $app->request()->post('idUser');
    $message->idUserSend  = $_SESSION['user_id'];
    $message->date_send = date('Y-m-d H:i:s');
    $message->text    = $app->request()->post('text');
    $message->title  = $app->request()->post('title');
    
    if(!$app->request()->post('idMessageGroup')) {
        $message->idMessageGroup=$message->filter('getLastIdMessageGroup')+1;
    } else
    $message->idMessageGroup  = $app->request()->post('idMessageGroup');
    
    $message->save();
    
     $app->render('user/message/response.php', array('idUser'=>$message->idUser, 'idUserSend'=>$message->idUserSend, 'date_send'=>$message->date_send, 'text'=>$message->text, 'title'=>$message->title, 'idMessageGroup'=>$message->idMessageGroup));
   
});

$app->post('/profil/szukaj', $auth, function () use ($app) {
   
    $users = Model::factory('User')->filter('getUserByLogin', $app->request()->post('name'), 3, $app->request()->post('exactly'))->find_many();
    
    if (count($users)>0) {
        foreach ($users as $key=>$user) {
            $usersTab[$key]['id']=$user->idUser;
            $usersTab[$key]['login']=$user->login;
        }
        echo json_encode($usersTab);
    }
    else echo json_encode('NULL');
    
});


//Wyświetl daną wiadomość

/**
 *TODO 1. Scroll do boxa z wiadomościami z tego samego idGroup
 *
 */
$app->get('/profil/wiadomosci/:id',$auth ,function ($id) use ($app) {
    
    $user=Model::factory('User')->find_one($_SESSION['user_id']);
    $group=$user->messages()->filter('getGroupMessages', $id)->find_one();
    
       if($group instanceof Message) {
    
        $messages=Model::factory('Message')->filter('getGroupMessages', $id)->find_many();
        $title=$messages[0]->title;

        foreach ($messages as $message) {
            if ($message->opened==1) {
                $message->opened=0;
                $message->save();
            }
        }

        $app->render('user/message/view.php',array('messages' => $messages, 'title' => $title));
        
    }
    else 
        $app->notFound();
});

//Deaktywuj daną wiadomość (sender, receiver)
$app->post('/profil/wiadomosci/usun',$auth ,function () use ($app) {
    
    
    //ajax przesyłam ID wiadomosci oraz czy Sender czy Receiver
    $message=Model::factory('Message')->find_one($id);
    
    $app->render('user/message/view.php',array('message' => $message,));
   
});


?>