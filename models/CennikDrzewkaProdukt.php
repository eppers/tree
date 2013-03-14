<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */



class CennikDrzewkaProdukt extends Model{
        
    public static $_table = 'cennik_drzewka_produkty';
    public static $_id_column = 'id_cennik_drzewka_produkty';
    
    public function cena() {
        return $this->has_many('CennikDrzewkaCena', 'id_cennik_drzewka_produkty'); // Note we use the model name literally - not a pluralised version
    }
    
    public function grupa() {
        return $this->belongs_to('CennikDrzewkaGrupa', 'id_cennik_drzewka_grupy'); // Note we use the model name literally - not a pluralised version
    }
}
?>
