{*
* Copyright (C) 2015-2018 Brainify - All Rights Reserved
*
* @author Brainify <tech@brainify.it>
* @copyright 2015-2018 Brainify
*}

<script type="text/javascript">
	{literal}var _$brt = _$brt || [];
	_$brt.push(['orderPurchased', {{/literal}
		order_id: {$purchase.orderId|escape:'javascript':'UTF-8'},
		cart_id: {$purchase.cartId|escape:'javascript':'UTF-8'},
		total_inc_tax: {$purchase.totalIncTax|escape:'javascript':'UTF-8'},
		total: {$purchase.totalExcTax|escape:'javascript':'UTF-8'},
		discount: {$purchase.discountAmount|escape:'javascript':'UTF-8'},
		shipping_price: {$purchase.shippingPrice|escape:'javascript':'UTF-8'},
		shipping_method: "{$purchase.shippingMethod|escape:'javascript':'UTF-8'}",
		payment_method: "{$purchase.paymentMethod|escape:'javascript':'UTF-8'}",
		items: {literal}[{/literal}
		{foreach from=$purchase.items item=item name=items}
			{literal}{{/literal}
				item_id: '{$item.id|escape:'javascript':'UTF-8'}',
				item_variation_id: '{$item.id_variation|escape:'javascript':'UTF-8'}',
				qnt: {$item.qty|escape:'javascript':'UTF-8'},
				price_inc_tax: {$item.priceIncTax|escape:'javascript':'UTF-8'},
				price_exc_tax: {$item.priceExcTax|escape:'javascript':'UTF-8'}
			{if $smarty.foreach.items.last}{literal}}{/literal}{else}{literal}},{/literal}{/if}
		{/foreach}
		{literal}]
	}]);{/literal}
</script>
