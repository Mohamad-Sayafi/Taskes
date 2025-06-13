<?php

function db_connection(){
    global $config;
    $conn =mysqli_connect($config['db']['host'],$config['db']['username'], $config['db']['password'],$config['db']['name']);
};


function db_insert($tabelname,$input_array=array){
    $coonnection = db_connection();
    $key_string = '';
    $value-tring ='';
    $array_length = count($input_arry);
    $i =1;
    foreach($input_array as $key=> $value){
        $keys_string.=$key ;
        $values_string .=$values;
        if($i<$array_length){
            $keys_string.= ',';
            $values_string .=',';
        }
        $i++;
    }
    $sql="INSERT INTO 'tablename'($key_string) VALUES ($values_string)";
    $result = mysqli_query($coonnection,sql);
    return $result;
};

function db_delete(){

};