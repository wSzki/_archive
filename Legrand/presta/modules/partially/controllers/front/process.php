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

class PartiallyProcessModuleFrontController extends ModuleFrontController
{
    public function postProcess()
    {
        $cart = $this->context->cart;

        $customer = $this->context->customer;

        // make sure we're ok to proceed
        if ($cart->id_customer == 0 || $cart->id_address_delivery == 0 || $cart->id_address_invoice == 0 || !$this->module->active) {
            Tools::redirect('index.php?controller=order&step=1');
        }

        $address = new Address($cart->id_address_delivery);
        $country = new Country($address->id_country);
        $state = new State($address->id_state);

        $proto = 'http://';
        if (Configuration::get('PS_SSL_ENABLED')) {
            $proto = 'https://';
        }

        $link = new Link($proto, $proto);

        // build params to create payment plan
        $body = array(
            'payment_plan' => array(
            'offer_id' => $this->module->offerId,
            'integration' => 'prestashop',
            // this is the cart_id since we don't actually have an order_id yet
            'integration_id' => (string) $cart->id,
            'amount' => (float) $cart->getOrderTotal(true, Cart::BOTH),
            'currency' => $this->context->currency->iso_code,
            'customer' => array(
            'first_name' => $customer->firstname,
            'last_name' => $customer->lastname,
            'email' => $customer->email,
            'phone' => $address->phone,
            ),
            'shipto_address' => $address->address1,
            'shipto_address2' => $address->address2,
            'shipto_city' => $address->city,
            'shipto_state' => $state->iso_code,
            'shipto_postal_code' => $address->postcode,
            'shipto_country' => $country->iso_code,
            'meta' => array(
            'checkout_complete_url' => $link->getBaseLink().'index.php?controller=order-confirmation&id_cart='.$cart->id.'&id_module='.$this->module->id.'&id_order='.$cart->id.'&key='.$customer->secure_key,
            'checkout_cancel_url' => $link->getBaseLink().'index.php?controller=cart&action=show',
            'checkout_notify_url' => $link->getModuleLink($this->module->name, 'notify', array('action' => 'gateway')),
            'items' => array(),
            ),
        ),
        );

        $prods = $cart->getProducts();
        if (count($prods)) {
            foreach ($prods as $item) {
                //PrestaShopLogger::addLog('Partial.ly adding product '.print_r($item, true));
                $img = Image::getCover($item['id_product']);
                $prod = new Product($item['id_product'], false, $this->context->language->id);
                $name = $item['name'];
                if (isset($item['attributes']) && !empty($item['attributes'])) {
                    $name .= ' - '.$item['attributes'];
                }
                $item_data = array(
                    'name' => $name,
                    'sku' => $item['reference'],
                    'price' => $item['price'],
                    'quantity' => $item['cart_quantity'],
                    'total' => $item['total'],
                    'product_id' => $item['id_product'],
                    'weight' => $item['weight'],
                    'weight_unit' => Configuration::get('PS_WEIGHT_UNIT'),
                    'image' => $link->getImageLink($prod->link_rewrite, $img['id_image'], ImageType::getFormattedName('small')),
                );
                // id_product_attribute appears to be like a variation_id
                if (isset($item['id_product_attribute']) && !empty($item['id_product_attribute'])) {
                    $item_data['variation_id'] = $item['id_product_attribute'];
                }

                array_push($body['payment_plan']['meta']['items'], $item_data);
            }
        }

        $result = $this->module->createPlan($body);
        if ($result) {
            $mailVars = array();
            $totalPaid = 0;
            $this->module->validateOrder($cart->id, (int) $this->module->pendingState, $totalPaid, $this->module->displayName, null, $mailVars, (int) $this->context->currency->id, false, $customer->secure_key);
            Tools::redirect($result->gateway_purchase_url);
        } else {
            // show an error message?
            //Tools::displayError('Error connecting to Partial.ly');
            Tools::redirect('index.php?controller=order&step=1');
        }
    }
}
