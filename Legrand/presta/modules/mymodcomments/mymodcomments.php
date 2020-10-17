<?php
class MyModComments extends Module
{
	public function __construct()
	{
		$this->name = 'mymodcomments';

		// Category of the module
		$this->tab = 'front_office_features';

		$this->version = '0.1';
		$this->author = 'wsz';
		$this->displayName = 'My Module of product comments';
		$this->description = 'With this module, your customers will be able to grade and comments your products.';

		// Activates Bootsrap
		$this->bootstrap = true;

		// WHAT IS THIS parent::__construct();
		// WHY MUST IT BE IN THE END OF THE CONSTRUCTOR	
		parent::__construct();
	}


	// HOOKS ---------------------------------------------------------------------------------- //

	public function install()
	{
		parent::install();
		$this->registerHook('displayHome');
		return true;
	}

	public function hookDisplayHome()
	{
		return $this->display(__FILE__, 'displayHome.tpl');
	}

	// PROCESSES ------------------------------------------------------------------------------ //

	// Updates the form according to what is in the database -- //
	public function assignConfiguration(){
		$enable_grades = Configuration::get('MYMOD_GRADES');
		$enable_comments = Configuration::get('MYMOD_COMMENTS');

		$this->context->smarty->assign('enable_grades', $enable_grades);
		$this->context->smarty->assign('enable_comments', $enable_comments);	
	}


	// Handles the submission of the backoffice form ---------- //
	public function processConfiguration()
	{
		// mymod_pc_form == name of the submit button (name="")
		// Tools::isSubmit == checks for GET & POST values relative to the given parameter (mymod_pc_form)

		if (Tools::isSubmit('mymod_pc_form'))
		{	
			// Retreive POST value, if none, retrive GET value
			$enable_grades = Tools::getValue('enable_grades');
			$enable_comments = Tools::getValue('enable_comments');

			// Configuration::updateValue == stores simple value in Prestashop's configuration table
			Configuration::updateValue('MYMOD_GRADES', $enable_grades);
			Configuration::updateValue('MYMOD_COMMENTS', $enable_comments);

			// assign('name of key variable', 'value') / this is a switch
			// if this is set it generates a smarty popup -> /views/templates/hook/
			$this->context->smarty->assign('confirmation', 'ok');
		}
	}



	// Processing the comments -------------------------------- //
	
	public function processDisplayHome()
	{
		// Watches the comment submit button
		if (Tools::isSubmit('mymod_pc_submit_comment'))
		{
			$id_product = Tools::getValue('id_product');
			$grade = Tools::getValue('grade');
			$comment = Tools::getValue('comment');
		
			// Use of an ObjectModel class vs (insert request)
			$insert = array(
				'id_product' => (int)$id_product,
				'grade' => (int)$grade,
				'comment' => pSQL($comment),
				'date_add' => date('Y-m-d H:i:s')
			);
		
			// Each time you want to make a request to the database,
			// you will have to instantiate the Db class with Db::getInstance().
			Db::getInstance()->insert('ps_mymod_comment', $insert);
		}
	}

	// Processing the comments -------------------------------- //
	//	public function processDisplayHome()
	//	{
	//		// Watches the comment submit button
	//		if (Tools::isSubmit('mymod_pc_submit_comment'))
	//		{
	//			$id_product = Tools::getValue('id_product');
	//			$grade = Tools::getValue('grade');
	//			$comment = Tools::getValue('comment');i
	//
	//			// Use of an ObjectModel class vs (insert request)
	//			$insert = array(
	//				'id_product' => (int)$id_product,
	//				'grade' => (int)$grade,
	//				'comment' => pSQL($comment),
	//				'date_add' => date('Y-m-d H:i:s'),
	//			);
	//			// Each time you want to make a request to the database,
	//			// you will have to instantiate the Db class with Db::getInstance().
	//			Db::getInstance()->insert('mymod_comment', $insert);
	//		}
	//	}



	// BACK OFFICE GENERATION ----------------------------------------------------------------- //

	// getContent() == Displays info in the back office 
	public function getContent()
	{
		// Sends form values to database [ps_configuration]
		$this->processConfiguration();

		// Comment Button
		//$this->processDisplayHome();

		// See /views/templates/hook/
		$this->assignConfiguration();

		// Display the backoffice template from /views/templates/hook/
		return $this->display(__FILE__, 'getContent.tpl');
	}

	// ---------------------------------------------------------------------------------------- //
}
