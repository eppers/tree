<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Gallery
 *
 * @author piotrm
 */

require_once './models/File.php';

class Gallery extends Model{
    
        
    public static $_table = 'Gallery';
    public static $_id_column = 'idGallery';
    
    public function files() {
        return $this->has_many('File', 'idGallery'); 
    }
    
    public static function getGalleryDesc($orm) {
        return $orm->order_by_desc('idGallery');
    }
}

?>
