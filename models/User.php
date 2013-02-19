<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of User
 *
 * @author piotrm
 */

require_once './models/Gallery.php';
require_once './models/Message.php';

class User extends Model{
    
    public static $_table = 'User';
    public static $_id_column = 'idUser';
    
    public function galleries() {
        return $this->has_many('Gallery', 'idUser'); // Note we use the model name literally - not a pluralised version
    }
    
    public function messages() {
        return $this->has_many('Message', 'idUser'); // Note we use the model name literally - not a pluralised version
    }
    
    /**
     * Funkcja wyszukująca loginy użytkowników na podstawie ich ID.
     * Zwraca tablicę obiektów
     * 
     * @param array $ids
     * @return array of obj
     */
    public static function getUserLogin($orm, array $ids) {

        return $orm->where_in(self::$_id_column,$ids)->find_many();
    }
    
    public static function getUserByLogin($orm, $name, $limit, $exactly) {
        if ($exactly==0)
            $string=$name.'%';
        else 
            $string=$name;
        
        return $orm->where_like('login', $string)->limit($limit);
    }

}



?>
