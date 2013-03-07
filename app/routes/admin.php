<?php
 
$app->get('/admin/', function () use ($app) {
    $app->redirect('/admin/strony/view');
});

$app->get('/admin/strony/view', function () use ($admin) {
    $sites=Model::factory('Strona')->find_many();
    $admin->render('/sites/all.php',array('sites'=>$sites));
});

$app->post('/admin/sites/view', function () use ($admin) {
    $sites=Model::factory('Site')->find_many();
    $admin->render('/sites/all.php',array('sites'=>$sites));    
});

/*
 * Edycja strony
 */
$app->get('/admin/sites/edit/:id', function ($id) use ($admin) {
    $sites=Model::factory('Site')->find_many();
    $site=Model::factory('Site')->find_one($id);
    if($site instanceof Site) {
        $title=$site->title;
        $content=$site->content;

        $admin->render('/sites/view.php',array('title'=>$title,'content'=>$content, 'sites'=>$sites, 'id'=>$id));
    }
    else $app->redirect('/admin/sites/view');
});

$app->post('/admin/sites/edit/:id', function ($id) use ($admin) {

    $site=Model::factory('Site')->find_one($id);
    if($site instanceof Site) {
        $site->title   = $admin->app->request()->post('title');
        $site->content  = $admin->app->request()->post('content');
        $site->save();

        $error['status']='0';
        $error['msg']='Strona została wyedytowana poprawnie';
        
    }
    else {
        $error['status']='1';
        $error['msg']='Strona nie została wyedytowana. Spróbuj ponownie';
    }
    $sites=Model::factory('Site')->find_many();
    
    $admin->render('/sites/view.php', array('title'=>$site->title,'content'=>$site->content, 'sites'=>$sites, 'id'=>$id, 'error'=>$error));
});

/*
 * Usuwanie strony
 */
$app->post('/admin/sites/delete/:id', function ($id) use ($admin) {
    $data = array(
       'heading' => 'Moja dane edytuj',
       'message' => 'To sa moje dane do edycji.'
   );
    $admin->render('admin/sites/view.php',$data);
});

/*
 * Slider wyswietla wszystkie strony
 */
$app->get('/admin/slider/view', function () use ($admin) {
    $slider=Model::factory('Slider')->find_many();
    $admin->render('/slider/all.php',array('slider'=>$slider));
});

/*
 * Slider edycja
 */
$app->get('/admin/slider/edit/:id', function ($id) use ($admin) {
    $slide=Model::factory('Slider')->find_one($id);

    $admin->render('/slider/view.php',array('position'=>$slide->position, 'link'=>$slide->link, 'alt'=>$slide->alt, 'obrazek'=>$slide->img, 'aktywny'=>$slide->active, 'id'=>$id, 'form'=>'edit'));
});


/*
 * Slider edycja POST
 */
$app->post('/admin/slider/edit/:id', function ($id) use ($admin) {
    $sites=Model::factory('Site')->find_many();
    $slide=Model::factory('Slider')->find_one($id);         
    
 //   print_r($_FILES);
    if($slide instanceof Slider) {
        $slide->position   = $admin->app->request()->post('position');
        $slide->link   = $admin->app->request()->post('link');
        $slide->alt  = $admin->app->request()->post('alt');
        $slide->active  = $admin->app->request()->post('active');
        
        if (isset($_FILES['file'])) {

            $error = $slide->setImage($_FILES);

            if($error['status']==1) {
                    $admin->render('/slider/view.php', array('position'=>$slide->position, 'link'=>$slide->link,'obrazek'=>$slide->img, 'alt'=>$slide->alt, 'aktywny'=>$slide->active, 'sites'=>$sites, 'id'=>$id, 'form'=>'edit', 'error'=>$error));
                exit();
            } else {

            $slide->img  = $error['uploaded_file'];

            }

        } else {

            $slide->img  = $admin->app->request()->post('obrazek');
        }

        

        $slide->save();

        $error['status']='0';
        $error['msg']='Slider został wyedytowany poprawie';
        
        //Generowanie nowego pliku slidera
        $slider = Model::factory('Slider')->where('active',1)->find_many();
        $slide->generateSlider($slider);
        
    }
    else {
        $error['status']='1';
        $error['msg']='Slider NIE został wyedytowany poprawnie. Spróbuj ponownie.';
    }
    

   

    $admin->render('/slider/view.php', array('position'=>$slide->position, 'link'=>$slide->link,'obrazek'=>$slide->img, 'alt'=>$slide->alt, 'aktywny'=>$slide->active, 'sites'=>$sites, 'id'=>$id, 'form'=>'edit', 'error'=>$error));

});


/*
 * Dodawanie slidera
 */
$app->get('/admin/slider/add', function () use ($admin) {
    $admin->render('/slider/view.php',array('form'=>'add'));
});

$app->post('/admin/slider/add', function () use ($admin) {
    $sites=Model::factory('Site')->find_many();
    
    $position = Model::factory('Slider')->where('position',$admin->app->request()->post('position'))->find_one();
    
    if($position instanceof Slider) {
        $error['status']='1';
        $error['msg']='Slide o takiej pozycji już istnieje';
        
        $admin->render('/slider/view.php', array('position'=>$admin->app->request()->post('position'), 'link'=>$admin->app->request()->post('link'), 'alt'=>$admin->app->request()->post('alt'), 'aktywny'=>$admin->app->request()->post('active'), 'sites'=>$sites, 'form'=>'add', 'error'=>$error));
        exit();
    }
    
    $slide = Model::factory('Slider')->create();
    $slide->position   = $admin->app->request()->post('position');
    $slide->link   = $admin->app->request()->post('link');
    $slide->alt  = $admin->app->request()->post('alt');
    $slide->active  = $admin->app->request()->post('active');
    

        
    if (isset($_FILES['file'])) {

        $error = $slide->setImage($_FILES);

        if($error['status']==1) {
                $admin->render('/slider/view.php', array('position'=>$admin->app->request()->post('position'), 'link'=>$admin->app->request()->post('link'), 'alt'=>$admin->app->request()->post('alt'), 'aktywny'=>$admin->app->request()->post('active'), 'sites'=>$sites, 'form'=>'add', 'error'=>$error));
            exit();
        } else {


        $slide->img  = $error['uploaded_file'];
        $slide->save();
        $error['status']='0';
        $error['msg']='Slide został dodany pomyślnie';
        
        //Generowanie nowego pliku slidera
        $slider = Model::factory('Slider')->where('active',1)->find_many();
        $slide->generateSlider($slider);

        }

    } else {

    $error['status']='1';
    $error['msg']='Plik nie został wysłany';

    }
    

   

    $admin->render('/slider/view.php', array('position'=>$slide->position, 'link'=>$slide->link,'obrazek'=>$slide->img, 'alt'=>$slide->alt, 'aktywny'=>$slide->active, 'sites'=>$sites, 'form'=>'add', 'error'=>$error));

});

$app->get('/admin/tv/pakiet', function () use ($admin) {
    
    $pakiets = Model::factory('Pakiet')->find_many();
    
    $admin->render('/tv/pakiet/all.php',array('pakiety'=>$pakiets));
});

$app->get('/admin/tv/pakiet/:idPakiet/programy', function ($idPakiet) use ($admin) {
    
    $channels = Model::factory('Program')->filter('getPakietChannels',$idPakiet)->find_many();
    
    
    $admin->render('/tv/program/all.php',array('channels'=>$channels, 'idPakiet'=>$idPakiet));
});

$app->get('/admin/tv/pakiet/:idPakiet/programy/edit/:id', function ($idPakiet, $id) use ($admin) {
    
    $tematyki = Model::factory('Tematyka')->find_many();
    $program =  Model::factory('Program')->find_one($id);
    $programTematyki = Model::factory('Program')->filter('getChannelTematyka',$idPakiet, $id)->find_many();
    $pakiet = Model::factory('Pakiet')->find_one($idPakiet);
    
    $admin->render('/tv/program/view.php', array('tematyki'=>$tematyki, 'pakiet'=>$pakiet, 'programTematyki'=>$programTematyki, 'program'=>$program, 'form'=>'edit'));
});

$app->post('/admin/tv/pakiet/:idPakiet/programy/edit/:id', function ($idPakiet, $id) use ($admin) {
  
   $program=Model::factory('Program')->find_one($id); 
    
   if($program instanceof Program) {
        $program->name   = $admin->app->request()->post('name');
        
        if (isset($_FILES['file'])) {

            $error = $program->setImage($_FILES);

            if($error['status']==1) {
                    $admin->render('/tv/program/view.php', array('tematyki'=>$tematyki, 'pakiet'=>$pakiet, 'programTematyki'=>$programTematyki, 'program'=>$program, 'form'=>'edit', 'error'=>$error));
                exit();
            } else {

            $program->img  = $error['uploaded_file'];

            }

        } else {

            $program->img  = $admin->app->request()->post('obrazek');
        }

        

        $program->save();

        $programTematyki = Model::factory('Program')->filter('getChannelTematyka',$idPakiet, $id)->find_many();
        $tematykaCheckboxArray = $admin->app->request()->post('tematykaCheckboxArray');

         foreach ($programTematyki as $rowProgramTematyki) {

                $key = array_search($rowProgramTematyki->tv_tematyka_id, $tematykaCheckboxArray);
                if(empty($key)) {

                    $pakietTematyka = Model::factory('PakietTematyka')->where('tv_tematyka_id',$rowProgramTematyki->tv_tematyka_id)->where('tv_kategorie_id',$idPakiet)->find_one();
                    $tematykaProgram = Model::factory('TematykaProgram')->where('kategorie_tematyka_id',$pakietTematyka->id_kategorie_tematyka)->find_one();
                    $tematykaProgram->delete();

                }
                unset($tematykaCheckboxArray[$key]);
               
        }
   
        if(count($tematykaCheckboxArray>0)) {
            
            $pakiet = Model::factory('Pakiet')->find_one($idPakiet);
            $pakietTematyki = $pakiet->tematyka()->find_array('id_tv_tematyka');

            //spłaszczenie tablicy z dwuwymiarowej do jednowymiarowej. Zamienienie obiektu recursive na tablice, gdzie false jako 2 argument 
            //oznacza nie zachowanie indeksow jako indeksow w splaszczonej tabeli (indeksy sie powielaly w tym wypadku)
            $pakietTematykiArray = iterator_to_array(new RecursiveIteratorIterator(new RecursiveArrayIterator($pakietTematyki)),false);

            foreach($tematykaCheckboxArray as $rowTematykaCheckboxArray) {
            
                if(!in_array($rowTematykaCheckboxArray, $pakietTematykiArray)) {
                    
                    try {
                        $pakietTematyka = Model::factory('PakietTematyka')->create();
                        $pakietTematyka->tv_kategorie_id = $idPakiet;
                        $pakietTematyka->tv_tematyka_id = $rowTematykaCheckboxArray;
                        if(!$pakietTematyka->save()) throw new Exception('Coś poszło nie tak. Tematyka nie została powiązana z pakietem') ;
                    }
                    catch (Exception $e) {
                        $error['status'] = '1';
                        $error['msg'] = $e->getMessage();
                        $admin->render('/tv/program/view.php', array('tematyki'=>$tematyki, 'pakiet'=>$pakiet, 'programTematyki'=>$programTematyki, 'program'=>$program, 'form'=>'edit', 'error'=>$error));
                        exit();
                    }
                }

                try {
                    $pakietTematyka = Model::factory('PakietTematyka')->where('tv_tematyka_id',$rowTematykaCheckboxArray)->where('tv_kategorie_id',$idPakiet)->find_one();
                    $tematykaProgram = Model::factory('TematykaProgram')->create();
                    $tematykaProgram->tv_programy_id = $id;
                    $tematykaProgram->kategorie_tematyka_id = $pakietTematyka->id_kategorie_tematyka;
                    if(!$tematykaProgram->save()) throw new Exception('Coś poszło nie tak. Program nie została powiązana z pakietem-tematyką') ;;
                } 
                catch (Exception $e) {
                    $error['status'] = '1';
                    $error['msg'] = $e->getMessage();
                    $admin->render('/tv/program/view.php', array('tematyki'=>$tematyki, 'pakiet'=>$pakiet, 'programTematyki'=>$programTematyki, 'program'=>$program, 'form'=>'edit', 'error'=>$error));
                    exit();
                }
            }

        }
        $error['status']='0';
        $error['msg']='Program został wyedytowany poprawie';
        
        $tematyki = Model::factory('Tematyka')->find_many();
        
        
        
        
    }
    else {
        $error['status']='1';
        $error['msg']='Program NIE został wyedytowany poprawnie. Spróbuj ponownie.';
    }
    
    //pobieram ponownie, aby zaktualizować listę dla programu
    $programTematyki = Model::factory('Program')->filter('getChannelTematyka',$idPakiet, $id)->find_many();
    
    $admin->render('/tv/program/view.php', array('tematyki'=>$tematyki, 'pakiet'=>$pakiet, 'programTematyki'=>$programTematyki, 'program'=>$program, 'form'=>'edit', 'error'=>$error));
});

$app->get('/admin/tv/pakiet/:idPakiet/programy/add', function ($idPakiet) use ($admin) {
  
    $tematyki = Model::factory('Tematyka')->find_many();
    $pakiet = Model::factory('Pakiet')->find_one($idPakiet);
    $programy = Model::factory('Program')->find_many();
    
    $admin->render('/tv/program/view.php', array('tematyki'=>$tematyki, 'pakiet'=>$pakiet, 'programy'=>$programy, 'form'=>'add'));
});

$app->post('/admin/tv/pakiet/:idPakiet/programy/add', function ($idPakiet) use ($admin) {
    
    //TODO sprawdzić czy dodaje poprawnie program z listy
    
    
   $tematyki = Model::factory('Tematyka')->find_many(); 
   $pakiet = Model::factory('Pakiet')->find_one($idPakiet);
   $programy = Model::factory('Program')->find_many();
   

   
   $programSelect = $admin->app->request()->post('program-select');
   
   if(!empty($programSelect)) {
       
       $program = Model::factory('Program')->find_one($admin->app->request()->post('program-select'));
       
       if($program instanceof Program) {
           
           $id = $program->id_tv;
           
       } else {
           
           $error['status']='1';
           $error['msg']='Wystąpił błąd przy dopisywaniu wybranego programu.';
           
           $admin->render('/tv/program/view.php', array('tematyki'=>$tematyki, 'programy'=>$programy, 'pakiet'=>$pakiet, 'form'=>'add', 'error'=>$error));
           exit();
       }
       
       
   } else {
       
       $programName = $admin->app->request()->post('name');
       
       $programOld = Model::factory('Program')->where('name',$programName)->find_one();   
       
       if($programOld instanceof Program) {
           
           $error['status']='1';
           $error['msg']='Program o takiej nazwie już istnieje.';
           
           $admin->render('/tv/program/view.php', array('tematyki'=>$tematyki, 'programy'=>$programy, 'pakiet'=>$pakiet, 'form'=>'add', 'error'=>$error));
           exit();
           
       } else {
       
        $program=Model::factory('Program')->create(); 

        $program->name = $admin->app->request()->post('name');

            if (isset($_FILES['file'])) {

                $error = $program->setImage($_FILES);

                if($error['status']==1) {
                        $admin->render('/tv/program/view.php', array('tematyki'=>$tematyki, 'pakiet'=>$pakiet, 'programTematyki'=>$programTematyki, 'program'=>$program, 'form'=>'edit', 'error'=>$error));
                    exit();
                } else {

                $program->img  = $error['uploaded_file'];

                }

            } 

            $program->save();
            $id = $program->id();
        
       } 
   
   }
        
        $tematykaCheckboxArray = $admin->app->request()->post('tematykaCheckboxArray');

        if(count($tematykaCheckboxArray>0)) {
            
            $pakietTematyki = $pakiet->tematyka()->find_array('id_tv_tematyka');

            //spłaszczenie tablicy z dwuwymiarowej do jednowymiarowej. Zamienienie obiektu recursive na tablice, gdzie false jako 2 argument 
            //oznacza nie zachowanie indeksow jako indeksow w splaszczonej tabeli (indeksy sie powielaly w tym wypadku)
            $pakietTematykiArray = iterator_to_array(new RecursiveIteratorIterator(new RecursiveArrayIterator($pakietTematyki)),false);

            foreach($tematykaCheckboxArray as $rowTematykaCheckboxArray) {
            
                if(!in_array($rowTematykaCheckboxArray, $pakietTematykiArray)) {
                    
                    try {
                        $pakietTematyka = Model::factory('PakietTematyka')->create();
                        $pakietTematyka->tv_kategorie_id = $idPakiet;
                        $pakietTematyka->tv_tematyka_id = $rowTematykaCheckboxArray;
                        if(!$pakietTematyka->save()) throw new Exception('Coś poszło nie tak. Tematyka nie została powiązana z pakietem') ;
                    }
                    catch (Exception $e) {
                        $error['status'] = '1';
                        $error['msg'] = $e->getMessage();
                        $admin->render('/tv/program/view.php', array('tematyki'=>$tematyki, 'pakiet'=>$pakiet, 'program'=>$program, 'form'=>'edit', 'error'=>$error));
                        exit();
                    }
                }

                try {
                    $pakietTematyka = Model::factory('PakietTematyka')->where('tv_tematyka_id',$rowTematykaCheckboxArray)->where('tv_kategorie_id',$idPakiet)->find_one();
                    $tematykaProgram = Model::factory('TematykaProgram')->create();
                    $tematykaProgram->tv_programy_id = $id;
                    $tematykaProgram->kategorie_tematyka_id = $pakietTematyka->id_kategorie_tematyka;
                    if(!$tematykaProgram->save()) throw new Exception('Coś poszło nie tak. Program nie została powiązana z pakietem-tematyką') ;;
                } 
                catch (Exception $e) {
                    $error['status'] = '1';
                    $error['msg'] = $e->getMessage();
                    $admin->render('/tv/program/view.php', array('tematyki'=>$tematyki, 'pakiet'=>$pakiet,  'program'=>$program, 'form'=>'edit', 'error'=>$error));
                    exit();
                }
            }

        }
        
        $error['status']='0';
        $error['msg']='Program został dodany poprawnie';
        
    
    //pobieram ponownie, aby zaktualizować listę dla programu
    $programTematyki = Model::factory('Program')->filter('getChannelTematyka',$idPakiet, $id)->find_many();
    
    $admin->render('/tv/program/view.php', array('tematyki'=>$tematyki, 'pakiet'=>$pakiet, 'programTematyki'=>$programTematyki, 'program'=>$program, 'form'=>'edit', 'error'=>$error));
});


//dorzucić przeskalnowanie obrazka
//zarzadzanie telewizja - kanalami tv - dodawanie, przepiannaie
//AJAX ładowanie obrazków telewizji