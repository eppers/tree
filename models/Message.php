<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Message
 *
 * @author piotrm
 */

class Message extends Model{
        
    public static $_table = 'Message';
    public static $_id_column = 'idMessage';
    
   
    public static function getGroupMessages($orm, $id) {
        return $orm->where('idMessageGroup', $id)->order_by_desc('idMessage');
    }
    
    public static function getGroups($orm, $id) {
        return $orm
                ->select('idMessage')
                ->select('idUser')
                ->select('idUserSend')
                ->select_expr('MAX(date_send)', 'date_send')
                ->select('text')
                ->select('title')
                ->select('idMessageGroup')
                ->select('seeSender')
                ->select('seeReceiver')
                ->select_expr('MAX(opened)', 'opened')
        ->where('idUser',$id)
        ->group_by('idMessageGroup')
        ->order_by_desc('date_send')
        ->order_by_desc('opened');                
    }
    
    public static function getCountUnreadedGroups($orm, $id) {
        
        return $orm
           ->raw_query('SELECT COUNT(opened) opened FROM ((SELECT MAX(opened) opened, idMessageGroup FROM Message WHERE idUser = :userId GROUP BY idMessageGroup) as Tabela) WHERE opened>0',array('userId'=>$id))->find_one();
 
    }
    
    public static function getLastIdMessageGroup($orm) {
        
        return $orm
        ->order_by_desc('idMessageGroup')->find_one();
    }

}

?>