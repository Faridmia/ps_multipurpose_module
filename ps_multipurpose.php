<?php 
    if (!defined('_PS_VERSION_'))
    exit;
    class Ps_Multipurpose extends Module
    {

        public function __construct()
        {
            $this->name         = 'ps_multipurpose';
            $this->tab          = 'front_office_features';
            $this->author       = 'faridmia';
            $this->version      = 1.0;
            $this->dependencies = array();
            $this->bootstrap = true;
           
            parent::__construct();
            $this->displayName  = $this->l('Ps Multipurpose');
            $this->description  = $this->l('This module for displaying Multipurpose');
            $this->confirmUninstall = $this->l("Do you really want to uninstall ? ");
        }

        public function install()
        {
            include_once($this->local_path."sql/install.php");
            return parent::install() 
            && $this->registerHook('displayHome') 
            && $this->registerHook('Header')
            && $this->registerHook('displayAfterDescription')
            && $this->createTabLink();
        }

        public function uninstall()
        {
            include_once($this->local_path."sql/uninstall.php");
            return parent::uninstall();
        }

        public function hookDisplayHome(){

            $this->context->smarty->assign(array(
                "MULTIPURPOSE_STR" => Configuration::get("MULTIPURPOSE_STR")
            ));

            return $this->display(__FILE__,"views/templates/hook/home.tpl");

        }

        public function hookHeader(){

            Media::addJsDef(array(
                'mp_ajax' => $this->_path.'/ajax.php'
            ));

            $this->context->controller->addCSS(array(

                $this->_path. "views/css/multipurpose.css",
            ));

            $this->context->controller->addJS(array(

                $this->_path. "views/js/multipurpose.js",
            ));
        }

        public function getContent(){

            if(Tools::isSubmit("savesubmit")){
                $name = Tools::getValue("print");

                Configuration::updateValue("MULTIPURPOSE_STR",$name);
                $this->sendEmail(Tools::getValue('customer_email'));
            }

            $products = Product::getProducts($this->context->language->id,0,1000,'id_product','ASC');
            $images_array = [];

            $link = new Link;
            foreach($products as $p){
                $images = Image::getImages($this->context->language->id,$p['id_product']);
                $name = Db::getInstance()->getValue('SELECT `link_rewrite` FROM `'._DB_PREFIX_.'product_lang` WHERE `id_product` ='.(int)$p['id_product'].' AND `id_lang` = '.(int)$this->context->language->id);
                foreach($images as $i){
                    $images_array[] = $link->getImageLink($name,$i['id_image'],'home_default');
                }
               
            }

            $this->context->smarty->assign(array(
                "MULTIPURPOSE_STR" => Configuration::get("MULTIPURPOSE_STR"),
                'token' => $this->generateAdminToken(),
                'images_array' => $images_array
            ));

            return $this->display(__FILE__,"views/templates/admin/configure.tpl");

        }

        public function sendEmail($email){
            Mail::send(
                $this->context->language->id,
                'test',
                $this->l('This is a test mail from tutorial series'),
                array(
                    '{datetime}' => date('Y-m-d H:i:s')
                ),
                $email,
                'Peestashop User',
                Configuration::get('PS_SHOP_EMAIL'),
                Configuration::get('PS_SHOP_NAME'),
                null,
                null,
                dirname(__file__).'/mails/'



            );
        }

        public function createTabLink(){

            $tab = new Tab();

            foreach(Language::getLanguages() as $lang){
                $tab->name[$lang['id_lang']] = $this->l('Origin');
            }

            $tab->class_name = 'AdminOrigin';
            $tab->module = $this->name;
            $tab->id_parent = 0;
            $tab->add();
            return true;
        }

        public function getProductsByCategoryID($id_category){

            $obj_cat = new Category($id_category,$this->context->language->id);
            $products = $obj_cat->getProducts($this->context->language->id,0,1000);

            $html = "<ol>";

            foreach($products as $pr){
                $html .='<li>'.$pr['name'].'</li>';
            }
            
            $html .= "</ol>";

            return $html;
        }

        public function generateAdminToken(){

            $cookie = new Cookie('psAdmin');

            $id_employee = $cookie->__get('id_employee');
            $controllers = 'AdminOrders';
            $id_class = Tab::getIdFromClassName($controllers);

            return Tools::getAdminToken($controllers.$id_class.$id_employee);

            // echo $id_employee;
            // die;
        }

        public function loadProducts($start = 0, $length = 5){

            $nb = Db::getInstance()->getValue('SELECT COUNT(*) FROM `'._DB_PREFIX_.'product`');

           // $data = Db::getInstance()->executeS('SELECT p.`id_product`,`pl.name` FROM  `'._DB_PREFIX_.'product` p LEFT JOIN `'._DB_PREFIX_.'product_lang` pl ON (p.`id_product` = pl.`id_product`) WHERE pl.`id_lang` = '.(int)$this->context->language->id);
            $query  = 'SELECT p.`id_product`,pl.`name`,p.`price`';
            $query .= 'FROM `' . _DB_PREFIX_ . 'product` AS p ';
            $query .= 'LEFT JOIN `' . _DB_PREFIX_ . 'product_lang` AS pl ON p.`id_product` = pl.`id_product` WHERE pl.`id_lang` = '.(int)$this->context->language->id;

            $data = Db::getInstance()->executeS($query);
            

            return array(
                'recordsTotal' => $nb,
                'recordsFiltered' => $nb,
                'data' => $data
            );
        }


        public function hookDisplayAfterDescription(){
            return "This is the hook from multipurpose module";
        }



    }