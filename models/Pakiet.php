<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Pakiet
 *
 * @author Peter
 */
require_once 'Tematyka.php';
require_once 'PakietTematyka.php';

class Pakiet extends Model{
    
    public static $_table = 'tv_kategorie';
    public static $_id_column = 'id_tv_kategorie';

    public function tematyka() {
        return $this->has_many_through('Tematyka');
    }
    
}




?>
