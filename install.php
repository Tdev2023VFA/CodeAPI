<?php
require_once(__DIR__.'/config/config.php');
require_once(__DIR__.'/config/function.php');

    function insert_options($key, $value)
    {
        global $NNL;
        if (!$NNL->get_row("SELECT * FROM `options` WHERE `key` = '$key' ")) {
            $NNL->query("INSERT INTO `options` (`key`, `value`) VALUES ('$key', '$value')");
        }
    }

    insert_options('display_api_vcb', '1');
    insert_options('limit_api_vcb', '1');
    insert_options('key_captcha', 'a0b3f9b4ee662c0d062256c060f47903107bafb1');
    // insert_options('status_mbbank', '1');
    //  $NNL->query(" ALTER TABLE `orders` ADD `request` INT(11) NOT NULL DEFAULT '0' AFTER `status` ");
  
    
    die('Success!');