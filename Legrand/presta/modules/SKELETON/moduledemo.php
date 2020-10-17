<?php

if(!defined('_PS_VERSION_'))
	exit;

class ModuleDemo extends Module
{
	public function __construct(){
		$this->name = 'moduledemo';
		$this->tab = 'test module';
		$this->version = '1.0';
		$this->author = 'Legrand';
		$this->ps_versions_compliancy = array('min' => '1.6', 'max' => _PS_VERSION_);

		$this->need_instance = 0; 
		$this->bootstrap = true;

		$this->displayName = $this->l('Module Demo');
		$this->description = $this->l('Just a demo');

	}

	public function install(){
		if(
			!parent::install() OR
			!$this->registerHook('displayLeftColumn')   
		)
		return false;
		return true;
	}

	public function hookDisplayLeftColumn($params){
		return "HELLO WORLD";
	}




}

