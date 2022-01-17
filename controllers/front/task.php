<?php

    class Ps_MultipurposeTaskModuleFrontController extends ModuleFrontController{

        public function __construct()
        {
            parent::__construct();
        }

        public function init()
        {
            parent::init();
        }

        public function initContent()
        {
            parent::initContent();

            $this->context->smarty->assign(array(
                'nb_product' => Db::getInstance()->getValue('SELECT COUNT(*) FROM `'._DB_PREFIX_.'product`'),
                'categories' => Db::getInstance()->executeS('SELECT `id_category`,`name` FROM `'._DB_PREFIX_.'category_lang` WHERE `id_lang` = '.(int) $this->context->language->id),
                'shop_name' => Configuration::get('PS_SHOP_NAME'),
                'manufacturer' =>Db::getInstance()->getRow('SELECT * FROM `'._DB_PREFIX_.'manufacturer`'),
            ));

            $this->setTemplate("module:ps_multipurpose/views/templates/front/task.tpl");
        }

        public function setMedia(){

            parent::setMedia();
            $this->addJquery();
            $this->addJS(_PS_MODULE_DIR_.'/ps_multipurpose/views/js/jquery.dataTables.js');
            $this->addJS(_PS_MODULE_DIR_.'/ps_multipurpose/views/js/dataTables.bootstrap.js');
            $this->addJS(_PS_MODULE_DIR_.'/ps_multipurpose/views/js/task.js');

            $this->addJS(_PS_MODULE_DIR_.'/ps_multipurpose/views/css/dataTables.bootstrap.js');
            $this->addJS(_PS_MODULE_DIR_.'/ps_multipurpose/views/css/jquery.dataTables.js');
        }


    }