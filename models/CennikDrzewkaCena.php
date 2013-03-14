<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */



class CennikDrzewkaCena extends Model{
        
    public static $_table = 'cennik_drzewka_ceny';
    public static $_id_column = 'id_cennik_drzewka_ceny';
    
   
    public function produkt() {
        return $this->belongs_to('CennikDrzewkaProdukt', 'id_cennik_drzewka_produkty');
    }

}
?>
