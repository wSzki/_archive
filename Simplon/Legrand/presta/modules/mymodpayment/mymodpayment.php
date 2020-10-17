

<?php
class MyModPayment extends PaymentModule
{
	public function __construct()
	{
		$this->name = 'mymodpayment';
		$this->tab = '';
		$this->version = '1.0';
		$this->author = 'wsz';
		$this->bootstrap = true;
		parent::__construct();
		$this->displayName = 'MyMod payment';
		$this->description = 'A simple payment module';
	}

	public function install()
	{
		if(!parent::install() || !$this->registerHook('paymentOptions'))
		{
			return false;
		}
		return true;
	}


	/**
	 *      * Display this module as a payment option during the checkout
	 *           *
	 *                * @param array $params
	 *                     * @return array|void
	 *                          */
	public function hookPaymentOptions($params)
	{
		/*
		 *          * Verify if this module is active
		 *                   */
		if (!$this->active) {
			return;
		}

		/**
		 *          * Form action URL. The form data will be sent to the
		 *                   * validation controller when the user finishes
		 *                            * the order process.
		 *                                     */
		$formAction = $this->context->link->getModuleLink($this->name, 'validation', array(), true);

		/**
		 *          * Assign the url form action to the template var $action
		 *                   */
		$this->smarty->assign(['action' => $formAction]);

		/**
		 *          *  Load form template to be displayed in the checkout step
		 *                   */
		$paymentForm = $this->fetch('module:prestapay/views/templates/hook/payment_options.tpl');

		/**
		 *          * Create a PaymentOption object containing the necessary data
		 *                   * to display this module in the checkout
		 *                            */
		$newOption = new PrestaShop\PrestaShop\Core\Payment\PaymentOption;
		$newOption->setModuleName($this->displayName)
	    ->setCallToActionText($this->displayName)
	    ->setAction($formAction)
	    ->setForm($paymentForm);

		$payment_options = array(
			$newOption
		);

		return $payment_options;
	}



	public function getContent(){
		return "hello";
	}


}

