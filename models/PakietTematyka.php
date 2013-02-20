<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PakietTematyka
 *
 * @author Peter
 */

require_once 'TematykaProgram.php';

class PakietTematyka extends Model{
    
    public static $_table = 'kategorie_tematyka';
    public static $_id_column = 'id_kategorie_tematyka';

    public function tematykaProgram() {
        return $this->has_many_through('TematykaProgram');
    }
}


?>
