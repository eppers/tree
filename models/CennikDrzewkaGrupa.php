<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */



class CennikDrzewkaGrupa extends Model{
        
    public static $_table = 'cennik_drzewka_grupy';
    public static $_id_column = 'id_cennik_drzewka_grupy';
    
    public function produkt() {
        return $this->has_many('CennikDrzewkaProdukt', 'id_cennik_drzewka_grupy'); // Note we use the model name literally - not a pluralised version
    }
   
    public function setImage($_FILES) {
        
        $typeAllowed = array('jpg', 'png', 'gif', 'jpeg');  
        $WORKSPACE = './public/images/';
    // $unique_id = md5(uniqid(rand(), true));
        $media = $_FILES['file']['name'];
        $filetype = substr(strrchr($media,'.'),1);
        //$new_upload = $WORKSPACE . $unique_id . '.' . $filetype;
        $fileSize = @filesize($_FILES['file']['tmp_name']);


        $MAX_FILENAME_LENGTH = 20; //długość nazwy
        $max_file_size_in_bytes = 2097152; //2MB
        $valid_chars_regex = 'A-Za-z0-9śćżźółąęń\-\s';



        try {


    // Jeżeli katalog z ID danej galerii nie istnieje, to zostaje utworzony        
            if (!file_exists($WORKSPACE)) {
                @mkdir($WORKSPACE, 0777);
            };
            if (!isset($_FILES['file']))
                    throw new Exception('Nie ma pliku do przesłania');
            else if (isset($_FILES['file']['error']) && $_FILES['file']['error'] != 0)
                    throw new Exception('Błąd pliku - wybierz plik');
            else if (!isset($_FILES['file']['tmp_name']) || !@is_uploaded_file($_FILES['file']['tmp_name'])) 
                    throw new Exception('Błąd pliku - test us_uploaded_file');
            else if (!isset($_FILES['file']['name']))
                    throw new Exception('Błąd pliku - brak nazwy');

    // Walidacja rozmiaru pliku        
            if (!$fileSize || $fileSize > $max_file_size_in_bytes)
                    throw new Exception('Za duży rozmiar pliku');
            if ($fileSize <= 0)
                    throw new Exception('Rozmiar pliku jest za mały');

    // Walidacja czy jest to obrazek na podstawie typu MIME        
            if(!preg_match('%image/%', $_FILES['file']['type']))
                    throw new Exception('Niewłaściwy format pliku!');

    // Walidacja czy jest to obrazek
            $imageinfo = getimagesize($_FILES['file']['tmp_name']);

    //        if($imageinfo['mime'] != 'image/gif' && $imageinfo['mime'] != 'image/jpeg' && $imageinfo['mime'] != 'image/png' && isset($imageinfo))
    //                throw new Exception('Akceptowalne pliki: jpeg, gif, png');

    // Walidacja nazwy pliku (usunięcie niewłaściwych znaków)
            $file_name = preg_replace('/[^'.$valid_chars_regex.']+$/i', '', strtolower(basename($_FILES['file']['name'])));
            if (strlen($file_name) == 0 || strlen($file_name) > $MAX_FILENAME_LENGTH)
                    throw new Exception('Niewłaściwa nazwa pliku z preg replace');

    // Walidacja rozszerzenia pliku na podstawie tablicy

            if(!in_array($filetype, $typeAllowed))
                    throw new Exception('Niewłaściwe rozszerzenie pliku'.$filetype);


            $new_upload = $file_name;
            
            switch(strtolower($imageinfo['mime']))
                {
                    case 'image/jpeg':
                        $image = imagecreatefromjpeg($_FILES['file']['tmp_name']);
                        break;
                    case 'image/png':
                        $image = imagecreatefrompng($_FILES['file']['tmp_name']);
                        break;
                    case 'image/gif':
                        $image = imagecreatefromgif($_FILES['file']['tmp_name']);
                        break;
                    default:
                        exit('Zły typ pliku: '.$imageinfo['mime']);
                }
                
                self::resizer($image,$new_upload);
            
         }
        catch (Exception $e) {

            $error['status']='1';
            $error['msg']=$e->getMessage().$e->getLine().$e->getFile();
            
            return $error;
        }
        
        $error['status']='0';
        $error['msg']='Plik został dodany';
        $error['uploaded_file']=$new_upload;
        
        return $error;
    }
    
    static public function resizer($image,$file_name) {
        // Target dimensions
        $max_width = 92;
        $max_height = 91;

        // Get current dimensions
        $old_width  = imagesx($image);
        $old_height = imagesy($image);

        // Calculate the scaling we need to do to fit the image inside our frame
        $scale      = min($max_width/$old_width, $max_height/$old_height);

        // Get the new dimensions
        $new_width  = ceil($scale*$old_width);
        $new_height = ceil($scale*$old_height);
        
        // Create new empty image
        $new = imagecreatetruecolor($new_width, $new_height);

        // Resize old image into new
        imagecopyresampled($new, $image, 
            0, 0, 0, 0, 
            $new_width, $new_height, $old_width, $old_height);
            
         // Catch the imagedata
        ob_start();
        imagejpeg($new, $file_name, 90);
        $data = ob_get_clean();
        
        // Destroy resources
        imagedestroy($image);
        imagedestroy($new);
     }
    

}
?>
