<?php 

    require_once ("../../config/config.inc.php");
    require_once ("../../init.php");

    //echo rand(1000,2000);

    $obj_mp = Module::getInstanceByName('ps_multipurpose');

    switch(Tools::getValue('action')){
       // $order = Tools::getValue('order',array());
        // $columns = Tools::getValue('columns',array());
        // $sortway = $order[0]['dir'];

        case "ptable":
            echo Tools::jsonEncode($obj_mp->loadProducts(Tools::getValue('start',0),Tools::getValue('length',5)));
            break;
        default:
            echo $obj_mp->getProductsByCategoryID(Tools::getValue('id_category'));
    }

    die;