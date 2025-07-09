<?php
require_once 'tables.php';
date_default_timezone_set('Asia/Tehran');
function db_connection()
{
    global $config;
    $connection = mysqli_connect($config['db']['host'], $config['db']['username'], $config['db']['password'], $config['db']['name']);
    return $connection;
};



function db_insert($tablename, $input_array = array())
{
    $connection = db_connection();
    $keys_string = '';
    $values_string = '';
    $array_length = count($input_array);
    $i = 1;

    foreach ($input_array as $key => $value) {
        $keys_string .= $key;
        $values_string .= "'$value'";
        if ($i < $array_length) {
            $keys_string .= ',';
            $values_string .= ',';
        }
        $i++;
    }

    $sql = "INSERT INTO $tablename ($keys_string) VALUES ($values_string)";
    $result = mysqli_query($connection, $sql);
    return $result;
}



function db_delete($table_name, $input_array)
{
    $connection = db_connection();
    $where_string = '';
    $array_length = count($input_array);
    $i = 1;

    foreach ($input_array as $key => $value) {
        $where_string .= "$key = '$value'";
        if ($i < $array_length) {
            $where_string .= ' AND ';
        }

        $i++;
    }

    $sql = "DELETE FROM $table_name WHERE $where_string";
    $result = mysqli_query($connection, $sql);
    return $result;
}



function db_select($sql)
{
    $connection = db_connection();
    $result = mysqli_query($connection, $sql);
    $output = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $output;
}



function db_select_one($sql)
{
    $connection = db_connection();
    $result = mysqli_query($connection, $sql);
    $output = mysqli_fetch_assoc($result);
    return $output;
}


function base_url()
{
    global $config;
    return $config['base_url'];
}

function time_ago($datetime)
{
    $timestamp = is_numeric($datetime) ? (int)$datetime : strtotime($datetime);
    $now = time();
    $diff = $now - $timestamp;

    if ($diff < 60) {
        return 'Just now';
    } elseif ($diff < 3600) {
        $minutes = floor($diff / 60);
        return $minutes . ' minute' . ($minutes > 1 ? 's' : '') . ' ago';
    } elseif ($diff < 86400) {
        $hours = floor($diff / 3600);
        return $hours . ' hour' . ($hours > 1 ? 's' : '') . ' ago';
    } elseif ($diff < 604800) {
        $days = floor($diff / 86400);
        return $days . ' day' . ($days > 1 ? 's' : '') . ' ago';
    } elseif ($diff < 2629746) {
        $weeks = floor($diff / 604800);
        return $weeks . ' week' . ($weeks > 1 ? 's' : '') . ' ago';
    } elseif ($diff < 31556952) {
        $months = floor($diff / 2629746);
        return $months . ' month' . ($months > 1 ? 's' : '') . ' ago';
    } else {
        $years = floor($diff / 31556952);
        return $years . ' year' . ($years > 1 ? 's' : '') . ' ago';
    }
}
