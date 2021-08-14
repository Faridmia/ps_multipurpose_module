<?php

$sqls = [];

$sqls[] =  'CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_. 'multione` (
    `id_multione` int(11) AUTO_INCREMENT,
    `description` TEXT,
    PRIMARY KEY (`id_multione`)
    ) ENGINE=' . _MYSQL_ENGINE_ . ' DEFAULT CHARSET=utf8';
$sqls[] =  'CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'multitwo` (
    `id_multitwo` int(11)  AUTO_INCREMENT,
    `description` TEXT,
    PRIMARY KEY (`id_multitwo`)
    ) ENGINE=' . _MYSQL_ENGINE_ . ' DEFAULT CHARSET=utf8';

    foreach($sqls as $sql){

        if(!Db::getInstance()->execute($sql)){
            return false;
        }
    }