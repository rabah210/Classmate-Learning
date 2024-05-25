<!-- connceting to database -->

<?php

    $db_name = 'mysql:host=localhost;dbname=classmate_db';
    $db_user_name = 'root';
    $db_user_pass = '';

    $conn = new PDO($db_name,$db_user_name,$db_user_pass);

    function create_unique_id(){
        $str = "abcdefghijklmnopqrstuvwxyzABCDEFGHIGKLMNOPQSTUVWXYZ0123456789";
        $id = array();
        $length = strlen($str) - 1;
        for($i = 0 ; $i < 20 ; $i++){
            $pos = mt_rand(0,$length);
            $id[] = $str[$pos];
        }
        return implode($id);
    }
?>