<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Tv
 *
 * @author Peter
 */
class Tv extends Model{
    
    public static $_table = 'tv_programy';
    public static $_id_column = 'id_tv';
    
    public static function getCategoryChannels($orm, $idKat, $idTematyka) {

        return $orm->raw_query('SELECT p.* FROM tv_programy p JOIN tematyka_programy tp ON p.id_tv=tp.id_tv_programy JOIN kategorie_tematyka kt ON tp.id_kategorie_tematyka=kt.id_kategorie_tematyka JOIN tv_tematyka t ON kt.id_tematyka=t.id_tv_tematyka WHERE kt.id_kategorie=:idKat AND kt.id_tematyka=:idTematyka ', array('idKat'=>$idKat, 'idTematyka'=>$idTematyka));
     
    }
    
}

?>
