<?php
require_once 'tables.php';
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

function time_ago($timestamp)
{
    $current_time = time();
    $time_diff = $current_time - strtotime($timestamp);
    $seconds = $time_diff;
    $minutes = round($seconds / 60);
    $hours = round($seconds / 3600);
    $days = round($seconds / 86400);
    $weeks = round($seconds / 604800);
    $months = round($seconds / 2629440);
    $years = round($seconds / 31553280);
    if ($seconds <= 60) {
        return "Just now";
    } elseif ($minutes <= 60) {
        return ($minutes == 1) ? "1 minute ago" : "$minutes minutes ago";
    } elseif ($hours <= 24) {
        return ($hours == 1) ? "1 hour ago" : "$hours hours ago";
    } elseif ($days <= 7) {
        return ($days == 1) ? "1 day ago" : "$days days ago";
    } elseif ($weeks <= 4.3) {
        return ($weeks == 1) ? "1 week ago" : "$weeks weeks ago";
    } elseif ($months <= 12) {
        return ($months == 1) ? "1 month ago" : "$months months ago";
    } else {
        return ($years == 1) ? "1 year ago" : "$years years ago";
    }
}
