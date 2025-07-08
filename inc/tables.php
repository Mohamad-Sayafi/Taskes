<?php
require_once 'function.php';


function create_tables()
{
  $sql = 'CREATE TABLE IF NOT EXISTS `users` (
    `user_id` int AUTO_INCREMENT PRIMARY KEY,
    `user_name` varchar(100) NULL,
    `user_email` varchar(300) NULL,
    `user_password` text
    );';
  mysqli_query(db_connection(), $sql);
}

function create_tables2()
{
  $slq = 'CREATE TABLE IF NOT EXISTS `user_tasks` (
    `user_id` int ,
    `task_id` int AUTO_INCREMENT PRIMARY KEY,
    `task_title` text ,
    `task_content` text ,
    `task_done` tinyint(1) ,
    `task_time` timestamp  DEFAULT CURRENT_TIMESTAMP,
    `task_space` datetime 
    );';
  mysqli_query(db_connection(), $slq);
}

create_tables();
create_tables2();
