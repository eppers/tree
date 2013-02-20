<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Files
 *
 * @author piotrm
 */


class File extends Model{
        
    public static $_table = 'File';
    public static $_id_column = 'idFile';
    
    public function votes() {
        return $this->has_many('Vote'); // Note we use the model name literally - not a pluralised version
    }
  
    public function comments() {
        return $this->has_many('Comment'); // Note we use the model name literally - not a pluralised version
    }
    
    public static function newest($orm) {
        $lastMonth = date("Y-m-t", strtotime("-1 month") );
        return $orm->where_gt('date_add', $lastMonth);
    }
    
    public static function isUserFile($orm, $user_id) {
        return $orm->inner_join('Gallery', 'File.idFile = Gallery.idGallery')->where('Gallery.idUser',$user_id);
    }
    
}

?>
