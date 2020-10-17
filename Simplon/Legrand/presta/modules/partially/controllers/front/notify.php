<?php
/**
* Copyright 2018 Partial.ly
*
* Licensed under the Apache License, Version 2.0 (the "License");
* you may not use this file except in compliance with the License.
* You may obtain a copy of the License at
*
*    http://www.apache.org/licenses/LICENSE-2.0
*
* Unless required by applicable law or agreed to in writing, software
* distributed under the License is distributed on an "AS IS" BASIS,
* WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
* See the License for the specific language governing permissions and
* limitations under the License.
*
*  @author Partial.ly <partiallyapp@gmail.com>
*  @copyright  2015-2018 Partial.ly
*  @license    http://www.apache.org/licenses/LICENSE-2.0  Apache License, Version 2.0
*/

class PartiallyNotifyModuleFrontController extends ModuleFrontController
{
    public function __construct($response = array())
    {
        parent::__construct($response);
        $this->display_header = false;
        $this->display_header_javascript = false;
        $this->display_footer = false;
    }

    public function postProcess()
    {
        $action = Tools::getValue('action');
        if ($action == 'gateway') {
            $this->processGateway();
        } elseif ($action == 'webhook') {
            $this->processWebhook();
        } elseif ($action == 'create_order') {
            $this->createOrder();
        } else {
            // unknown?
            echo 'unknown action';
            die;
        }
    }

    private function processGateway()
    {
        // read raw body and parse json
        $raw_json = Tools::file_get_contents('php://input');

        // make sure signature valid
        if ($this->module->validateSignature($raw_json)) {
            PrestaShopLogger::addLog('Partial.ly notify received: '.$raw_json);
            $json = json_decode($raw_json);

            // integration_id is actually the cart id
            $order_id = Order::getOrderByCartId((int) $json->payment_plan->integration_id);
            $order = new Order($order_id);

            // add partial.ly plan info to DB
            Db::getInstance()->insert('partially_plan', array(
              'id_order' => (int)$order_id,
              'partially_id' => pSQL($json->payment_plan->id),
              'partially_number' => pSQL($json->payment_plan->number)
            ));

            // add order payment, if amount_paid > 0
            if ($json->payment_plan->amount_paid > 0) {
                // using plan id as the transaction id here, maybe use something else, or just leave empty
                $order->addOrderPayment($json->payment_plan->amount_paid, null, $json->payment_plan->id);
            }

            // update order state
            $order->setCurrentState($this->module->orderState);

            echo 'ok';
            // without this prestashop always returns 500 status code for some reason
            die;
        } else {
            PrestaShopLogger::addLog('Partial.ly notify received invalid signature!');
        }
    }

    private function processWebhook()
    {
        $raw_json = Tools::file_get_contents('php://input');

        // make sure signature valid
        if ($this->module->validateSignature($raw_json)) {
            PrestaShopLogger::addLog('Partial.ly notify received: '.$raw_json);
            $hook = json_decode($raw_json);
            if ($hook->event == 'payment_succeeded') {
                // integration_id is actually the cart id
                $payment = $hook->data->payment;
                $plan = $payment->payment_plan;
                $order_id = Order::getOrderByCartId((int) $plan->integration_id);
                $order = new Order($order_id);
                $order->addOrderPayment($payment->amount, null, $payment->id);
                PrestaShopLogger::addLog('Partial.ly webhook adding payment of '.$payment->amount.' to order'.$order_id);
            } elseif ($hook->event == 'plan_paid') {
                $plan = $hook->data->payment_plan;
                $order_id = Order::getOrderByCartId((int) $plan->integration_id);
                $order = new Order($order_id);
                $order->setCurrentState($this->module->paidState);
                PrestaShopLogger::addLog('Partial.ly updated order status to paidState');
            } elseif ($hook->event == 'refund_created') {
                // TODO look up how to add refunds
                PrestaShopLogger::addLog('Partial.ly should add refund of ');
            } else {
                PrestaShopLogger::addLog('Partial.ly ignored webhook event '.$hook->event);
            }
            echo 'ok';
            die;
        } else {
            PrestaShopLogger::addLog('Partial.ly gateway received invalid signature', 2);
        }
    }

    // TODO need to figure this out so we can allow checkout from widget
    private function createOrder()
    {
        $raw_json = Tools::file_get_contents('php://input');
        // make sure signature valid
        if ($this->module->validateSignature($raw_json)) {
            PrestaShopLogger::addLog('Partial.ly notify received: '.$raw_json);
            $data = json_decode($raw_json);
            $plan = $data->payment_plan;
            $id_currency = Currency::getIdByIsoCode($plan->currency);

            // need to create a dummy cart first, ugh
            // second param is id_lang, default to 1
            $cart = new Cart(null, 1);
            $cart->id_currency = $id_currency;
            $cart->save();

            // add items to cart?

            // customer
            $cust = Customer::getByEmail($plan->customer->email);
            if (!$cust) {
                // doesn't exist yet, need to create it
                $cust = $this->createCustomer($plan);
            }

            // create the order with the dummy cart id
            // maybe just do it manually, bypassing prestashop functions for simplicity
            $order = new Order();
            $order->id_customer = $cust->id_customer;
            $order->id_carrier = 0;
            $order->id_currency = $id_currency;
            $order->id_cart = $cart->id_cart;
            $order->id_lang = $cart->id_lang;
            $order->id_shop = 1;
            $order->payment = 'partial.ly';
            $order->module = 'partially';
            $order->total_paid = $plan->amount_paid;
            $order->add();

            // send json with order id back
            header('Content-Type: application/json');
            $res_data = array('order_id' => $order->id);
            echo json_encode($res_data);
            die;
        } else {
            PrestaShopLogger::addLog('Partial.ly gateway received invalid signature for create order', 2);
        }
    }

    private function createCustomer($plan)
    {
        $cust = new Customer();
        $cust->firstname = $plan->customer->first_name;
        $cust->lastname = $plan->customer->last_name;
        $cust->email = $plan->customer->email;
        // set to a random string, since it's required
        $cust->passwd = $this->generatePw();
        $cust->save();

        return $cust;
    }

    private function generatePw($len = 13)
    {
        // uniqid gives 13 chars, but you could adjust it to your needs.
        if (function_exists('random_bytes')) {
            $bytes = random_bytes(ceil($len / 2));
        } elseif (function_exists('openssl_random_pseudo_bytes')) {
            $bytes = openssl_random_pseudo_bytes(ceil($len / 2));
        } else {
            throw new Exception('no cryptographically secure random function available');
        }

        return Tools::substr(bin2hex($bytes), 0, $len);
    }
}
