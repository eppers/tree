<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Tematyka
 *
 * @author Peter
 */

require_once 'Pakiet.php';
require_once 'PakietTematyka.php';

class Tematyka extends Model{
    
    public static $_table = 'tv_tematyka';
    public static $_id_column = 'id_tv_tematyka';

    public function pakiet() {
        return $this->has_many_through('Pakiet');
    }
}


?>
