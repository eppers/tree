<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */



class CennikDrzewkaGrupa extends Model{
        
    public static $_table = 'cennik_drzewka_grupy';
    public static $_id_column = 'id_cennik_drzewka_grupy';
    
    public static $_workspace = './public/images/';
    
    public function produkt() {
        return $this->has_many('CennikDrzewkaProdukt', 'id_cennik_drzewka_grupy'); // Note we use the model name literally - not a pluralised version
    }
   

}
?>
