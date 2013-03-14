<?php
 
/*
 * TODO: zarzadzanie galerią
 * Usuwanie produktow, rodzajow, grup, uslug
 * 
 */

$app->get('/admin/', function () use ($app) {
    $app->redirect('/admin/strony/view');
});


/*
 * Strony ......................................................................
 */

$app->get('/admin/strony/view', function () use ($admin) {
    $sites=Model::factory('Strona')->find_many();
    $admin->render('/sites/all.php',array('sites'=>$sites));
});

$app->post('/admin/sites/view', function () use ($admin) {
    $sites=Model::factory('Strona')->find_many();
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
 * Cennik drzewka ......................................................................
 */


/*
 * Drzewka - lista grup
 */
$app->get('/admin/drzewka/grupa/lista', function () use ($admin) {
    $tabGrupy = array();
    
    $grupy = Model::factory('CennikDrzewkaGrupa')->order_by_asc('pozycja')->find_many();
    

    $admin->render('/drzewka/cennik_kategorie_lista.php',array('grupy'=>$grupy));
});

/*
 * Drzewka - dodaj grupę
 */
$app->get('/admin/drzewka/grupa/dodaj', function () use ($admin) {
    
    $admin->render('/drzewka/cennik_kategorie_edycja.php',array('form'=>'add'));
});

$app->post('/admin/drzewka/grupa/dodaj', function () use ($admin) {
   
    $grupa = Model::factory('CennikDrzewkaGrupa')->create();
    $grupa->pozycja   = $admin->app->request()->post('pozycja');
    $grupa->nazwa   = $admin->app->request()->post('nazwa');
    $grupa->alt  = $admin->app->request()->post('alt');
    
    if (isset($_FILES['file'])) {

        $error = $grupa->setImage($_FILES);

        if($error['status']==1) {
                $admin->render('/drzewka/cennik_grupa_edycja.php', array('grupa'=>$grupa, 'form'=>'add', 'error'=>$error));
            exit();
        } else {


        $grupa->img  = $error['uploaded_file'];
        $grupa->save();
        $error['status']='0';
        $error['msg']='Grupa została dodana pomyślnie';
        
        }

    } else {

    $error['status']='1';
    $error['msg']='Grupa nie została utworzona';

    }
    

    $admin->render('/drzewka/cennik_grupa_edycja.php', array('grupa'=>$grupa, 'form'=>'add', 'error'=>$error));

});

/*
 * Drzewka - edytuj grupę(kategorie)
 */
$app->get('/admin/drzewka/grupa/edytuj/:id', function ($id) use ($admin) {
    $grupa=Model::factory('CennikDrzewkaGrupa')->find_one($id);
    //edycja obrazkow
    $admin->render('/drzewka/cennik_kategorie_edycja.php',array('grupa'=>$grupa, 'form'=>'edit'));
});

$app->post('/admin/drzewka/grupa/edytuj/:id', function ($id) use ($admin) {

    $grupa=Model::factory('CennikDrzewkaGrupa')->find_one($id);
    
    if($grupa instanceof CennikDrzewkaGrupa) {
        $grupa->nazwa =  $admin->app->request()->post('nazwa');
        $grupa->pozycja =  $admin->app->request()->post('pozycja');
        $grupa->alt  = $admin->app->request()->post('alt');
           
            if (isset($_FILES['file'])) {

                $error = $grupa->setImage($_FILES);

                if($error['status']==1) {
                        $admin->render('/drzewka/cennik_kategorie_edycja.php', array('grupa'=>$grupa, 'form'=>'edit', 'error'=>$error));
                    exit();
                } else {

                $grupa->img  = $error['uploaded_file'];

                }

            } else {

                $grupa->img  = $admin->app->request()->post('obrazek');
            }
            
                $grupa->save();

                $error['status']='0';
                $error['msg']='Rodzaj został wyedytowany poprawnie';
            
        
    } else {
        $error['status']='1';
        $error['msg']='Coś poszło nie tak. Spróbuj ponownie.';
    }
    
    $admin->render('/drzewka/cennik_kategorie_edycja.php', array('grupa'=>$grupa, 'form'=>'edit', 'error'=>$error));

});


/*
 * ----------------------------------- RODZAJE ----------------------------------
 * Drzewka - lista rodzajów
 */
$app->get('/admin/drzewka/rodzaj/lista', function () use ($admin) {
    $tabProdukty = array();
    
    $grupy = Model::factory('CennikDrzewkaGrupa')->order_by_asc('pozycja')->find_many();
    
    foreach($grupy as $grupa) {
        
        if($grupa instanceof CennikDrzewkaGrupa) {

            $produkty = $grupa->produkt()->order_by_asc('pozycja')->find_many();
            
            foreach( $produkty as $produkt ) {
                if($produkt instanceof CennikDrzewkaProdukt) {
                            
                    $tabTemp['nazwa_produktu']=$produkt->nazwa;
                    $tabTemp['pozycja_produktu']=$produkt->pozycja;
                    $tabTemp['id_prod']=$produkt->id_cennik_drzewka_produkty;
                    $tabTemp['nazwa_grupy'] = $grupa->nazwa;
                    $tabTemp['id_gr'] = $grupa->id_cennik_drzewka_grupy;

                    $tabCennik[]=$tabTemp;
                  
                }
                
            }
            
        }
    }



    $admin->render('/drzewka/cennik_rodzaj_lista.php',array('produkty'=>$tabCennik));
});


/*
 * Drzewka - dodaj rodzaj
 */
$app->get('/admin/drzewka/rodzaj/dodaj', function () use ($admin) {
    
    $grupy=Model::factory('CennikDrzewkaGrupa')->find_many();

    $admin->render('/drzewka/cennik_rodzaj_edycja.php',array('grupy'=>$grupy, 'form'=>'add'));
});

$app->post('/admin/drzewka/rodzaj/dodaj', function () use ($admin) {
        
    $grupa=Model::factory('CennikDrzewkaGrupa')->find_one($admin->app->request()->post('idGr'));
    
    $grupy=Model::factory('CennikDrzewkaGrupa')->find_many();
    
       
    if($grupa instanceof CennikDrzewkaGrupa) {
            $produkt = Model::factory('CennikDrzewkaProdukt')->create();
            $produkt->id_cennik_drzewka_grupy =  $admin->app->request()->post('idGr');
            $produkt->nazwa =  $admin->app->request()->post('nazwa');
            $produkt->pozycja =  $admin->app->request()->post('pozycja');
            
            $produkt->save();
            $error['status']='0';
            $error['msg']='Rodzaj został dodany pomyślnie';
    } else {
        $error['status']='1';
        $error['msg']='Coś poszło nie tak. Spróbuj ponownie.';
            
        $admin->render('/drzewka/cennik_rodzaj_edycja.php', array('grupy'=>$grupy, 'form'=>'add', 'error'=>$error));
        exit();
    }
    
    $produkt->id_cennik_drzewka_produkty=$produkt->id();
    

    $admin->render('/drzewka/cennik_rodzaj_edycja.php', array('grupy'=>$grupy, 'produkt'=>$produkt, 'form'=>'edit', 'error'=>$error));

});


/*
 * Drzewka - edytuj rodzaj
 */
$app->get('/admin/drzewka/rodzaj/edytuj/:id', function ($id) use ($admin) {
    $produkt=Model::factory('CennikDrzewkaProdukt')->find_one($id);
    $grupy=Model::factory('CennikDrzewkaGrupa')->find_many();

    $admin->render('/drzewka/cennik_rodzaj_edycja.php',array('grupy'=>$grupy, 'produkt'=>$produkt, 'form'=>'edit'));
});

$app->post('/admin/drzewka/rodzaj/edytuj/:id', function ($id) use ($admin) {

    $produkt=Model::factory('CennikDrzewkaProdukt')->find_one($id);
    $grupa=$produkt->grupa()->find_one();
    
    $grupy=Model::factory('CennikDrzewkaGrupa')->find_many();
 
        
    
    if($produkt instanceof CennikDrzewkaProdukt) {
        $produkt->id_cennik_drzewka_grupy =  $admin->app->request()->post('idGr');
        $produkt->nazwa =  $admin->app->request()->post('nazwa');
        $produkt->pozycja =  $admin->app->request()->post('pozycja');
        
        if($grupa instanceof CennikDrzewkaGrupa) {
            
                $produkt->save();

                $error['status']='0';
                $error['msg']='Rodzaj został wyedytowany poprawie';
            
        } else {
            $error['status']='1';
            $error['msg']='Coß poszło nie tak. Spróbuj ponownie.';
        }
        
    } else {
        $error['status']='1';
        $error['msg']='Coś poszło nie tak. Spróbuj ponownie.';
    }
    
    $admin->render('/drzewka/cennik_rodzaj_edycja.php', array('grupy'=>$grupy, 'produkt'=>$produkt, 'form'=>'edit', 'error'=>$error));

});



/*
 * Drzewka - lista produktów
 */
$app->get('/admin/drzewka/lista', function () use ($admin) {
    $tabCennik = array();
    $tabGrupy = array();
    $tabProdukty = array();
    $tabCeny = array();
    
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



    $admin->render('/drzewka/cennik_lista.php',array('cennik'=>$tabCennik));
});
/*
 * Drzewka - edytuj produkt
 */
$app->get('/admin/drzewka/produkt/edytuj/:id', function ($id) use ($admin) {
    $cena=Model::factory('CennikDrzewkaCena')->find_one($id);
    $produkt=$cena->produkt()->find_one();
    
    $produkty=Model::factory('CennikDrzewkaProdukt')->find_many();

    $admin->render('/drzewka/cennik_edycja.php',array('produkty'=>$produkty, 'cena'=>$cena, 'form'=>'edit'));
});


/*
 * Drzewka edycja POST
 */
$app->post('/admin/drzewka/produkt/edytuj/:id', function ($id) use ($admin) {

    $cena=Model::factory('CennikDrzewkaCena')->find_one($id);
    $produkt=$cena->produkt()->find_one();
    
    $produkty=Model::factory('CennikDrzewkaProdukt')->find_many();
 
        
    
    if($cena instanceof CennikDrzewkaCena) {
        $cena->id_drzewka_cennik_produkty =  $admin->app->request()->post('idProd');
        $cena->wysokosc =  $admin->app->request()->post('wysokosc');
        $cena->rozmiar =  $admin->app->request()->post('rozmiar');
        $cena->cena =  $admin->app->request()->post('cena');
        $cena->pozycja =  $admin->app->request()->post('pozycja');
        
        if($produkt instanceof CennikDrzewkaProdukt) {
            
                $cena->save();

                $error['status']='0';
                $error['msg']='Produkt został wyedytowany poprawie';
            
        } else {
            $error['status']='1';
            $error['msg']='Coß poszło nie tak. Spróbuj ponownie.';
        }
        
    } else {
        $error['status']='1';
        $error['msg']='Coß poszło nie tak. Spróbuj ponownie.';
    }
    
    $admin->render('/drzewka/cennik_edycja.php', array('produkty'=>$produkty, 'cena'=>$cena, 'form'=>'edit', 'error'=>$error));

});


/*
 * Drzewka dodawanie ceny do produktu (rodzaju)
 */
$app->get('/admin/drzewka/produkt/dodaj', function () use ($admin) {
    
    $produkty=Model::factory('CennikDrzewkaProdukt')->find_many();

    $admin->render('/drzewka/cennik_edycja.php',array('produkty'=>$produkty, 'form'=>'add'));
});

$app->post('/admin/drzewka/produkt/dodaj', function () use ($admin) {
        
    $produkt=Model::factory('CennikDrzewkaProdukt')->find_one($admin->app->request()->post('idProd'));
    
    $produkty=Model::factory('CennikDrzewkaProdukt')->find_many();
    
       
    if($produkt instanceof CennikDrzewkaProdukt) {
            $cena = Model::factory('CennikDrzewkaCena')->create();
            $cena->id_cennik_drzewka_produkty =  $admin->app->request()->post('idProd');
            $cena->wysokosc =  $admin->app->request()->post('wysokosc');
            $cena->rozmiar =  $admin->app->request()->post('rozmiar');
            $cena->cena =  $admin->app->request()->post('cena');
            $cena->pozycja =  $admin->app->request()->post('pozycja');
            
            $cena->save();
            $error['status']='0';
            $error['msg']='Produkt został dodany pomyślnie';
    } else {
        $error['status']='1';
        $error['msg']='Coś poszło nie tak. Spróbuj ponownie.';
            
        $admin->render('/drzewka/cennik_edycja.php', array('produkty'=>$produkty, 'form'=>'add', 'error'=>$error));
        exit();
    }
    
    $cena->id_cennik_drzewka_ceny=$cena->id();
    

    $admin->render('/drzewka/cennik_edycja.php', array('produkty'=>$produkty, 'cena'=>$cena, 'form'=>'edit', 'error'=>$error));

});


/*
 * Cennik uslugi ......................................................................
 */

/*
 * Usługi - lista uslug
 */
$app->get('/admin/uslugi/lista', function () use ($admin) {
    
    $uslugi = Model::factory('UslugiRodzaj')->order_by_asc('pozycja')->find_many();

    $admin->render('/uslugi/cennik_lista.php',array('uslugi'=>$uslugi));
});

/*
 * Usługi - dodaj usluge
 */
$app->get('/admin/uslugi/dodaj', function () use ($admin) {
    
    $admin->render('/uslugi/cennik_edycja.php',array('form'=>'add'));
});

$app->post('/admin/uslugi/dodaj', function () use ($admin) {
   
    $usluga = Model::factory('UslugiRodzaj')->create();
    $usluga->pozycja   = $admin->app->request()->post('pozycja');
    $usluga->nazwa   = $admin->app->request()->post('nazwa');
    $usluga->cena  = $admin->app->request()->post('cena');
    
    $admin->render('/uslugi/cennik_edycja.php', array('usluga'=>$usluga, 'form'=>'add', 'error'=>$error));

});

/*
 * Usługi - edytuj usluge
 */
$app->get('/admin/uslugi/edytuj/:id', function ($id) use ($admin) {
    $usluga=Model::factory('UslugiRodzaj')->find_one($id);
    //edycja obrazkow
    $admin->render('/uslugi/cennik_edycja.php',array('usluga'=>$usluga, 'form'=>'edit'));
});

$app->post('/admin/uslugi/edytuj/:id', function ($id) use ($admin) {

    $usluga=Model::factory('UslugiRodzaj')->find_one($id);
    
    if($usluga instanceof UslugiRodzaj) {
    $usluga->pozycja   = $admin->app->request()->post('pozycja');
    $usluga->nazwa   = $admin->app->request()->post('nazwa');
    $usluga->cena  = $admin->app->request()->post('cena');
           
        $usluga->save();

        $error['status']='0';
        $error['msg']='Usługa została wyedytowana poprawnie';
            
        
    } else {
        $error['status']='1';
        $error['msg']='Coś poszło nie tak. Spróbuj ponownie.';
    }
    
    $admin->render('/uslugi/cennik_edycja.php', array('usluga'=>$usluga, 'form'=>'edit', 'error'=>$error));

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