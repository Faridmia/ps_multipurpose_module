<?php 
    // if (!defined('_PS_VERSION_')) {
    //     exit;
    // }
    
    // use PrestaShop\PrestaShop\Core\Module;
    class Multipurpose extends Module
    {

        public function __construct()
        {
            $this->name = 'multipurpose';
            $this->version = '1.0.0';
            $this->author = 'Farid Mia';
            $this->need_instance = 0;

            $this->bootstrap = true;
            parent::__construct();

            $this->displayName = $this->trans('Multipurpose', array(), 'Modules.Multipurpose.Admin');
            $this->description = $this->trans('Add a multipurpose system use here', array(), 'Modules.Multipurpose.Admin');

            $this->ps_versions_compliancy = array('min' => '1.7.0.0', 'max' => _PS_VERSION_);
        }

        public function install()
        {
            include_once($this->local_path."sql/install.php");
            return parent::install() && $this->registerHook('displayHome') && $this->registerHook('Header') && $this->createTabLink();
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

                $this->_path. "views/css/multipurpose.css"
            ));

            $this->context->controller->addJS(array(

                $this->_path. "views/js/multipurpose.js"
            ));
        }

        public function getContent(){

            if(Tools::isSubmit("savesubmit")){
                $name = Tools::getValue("print");

                Configuration::updateValue("MULTIPURPOSE_STR",$name);
            }

            $this->context->smarty->assign(array(
                "MULTIPURPOSE_STR" => Configuration::get("MULTIPURPOSE_STR")
            ));

            return $this->display(__FILE__,"views/templates/admin/configure.tpl");

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


    }