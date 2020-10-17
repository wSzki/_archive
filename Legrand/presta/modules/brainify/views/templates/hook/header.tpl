{*
* Copyright (C) 2015-2018 Brainify - All Rights Reserved
*
* @author Brainify <tech@brainify.it>
* @copyright 2015-2018 Brainify
*}
{if isset($brainify_key)}<script type="text/javascript">

	{assign var='controllerName' value=$smarty.get.controller}
    
    {literal}var _$brt = _$brt || [];{/literal}

    {if $controllerName == 'index'}
        {literal}_$brt.push([['page_type', 'home page']]);{/literal}
    {elseif $controllerName == 'cart' || $controllerName == 'order' || $controllerName == 'order-confirmation' || $controllerName == 'order-opc' || $controllerName == 'orderopc'}
        {literal}_$brt.push([['page_type', 'checkout page']]);{/literal}
    {elseif isset($current_product_id) && $current_product_id}
        {literal}_$brt.push([['page_type', 'item page'],
            ['item_id', '{/literal}{$current_product_id|escape:'quotes':'UTF-8'}{literal}'],
            ['category_id', '{/literal}{$product_category_id|escape:'quotes':'UTF-8'}{literal}'],
            ['item_variations_id', [{/literal}{foreach from=$product_variations_id item=pvi name=variation_id}'{$pvi|escape:'quotes':'UTF-8'}'{if !$smarty.foreach.variation_id.last}, {/if}{/foreach}{literal}]],
            ['category_path', [[{/literal}{foreach from=$brainify_categories_id item=bci name=category_id}'{$bci|escape:'quotes':'UTF-8'}'{if !$smarty.foreach.category_id.last}, {/if}{/foreach}]{literal}]],
            ['itemViewed', '{/literal}{$current_product_id|escape:'quotes':'UTF-8'}{literal}']]);{/literal}
    {elseif isset($category_id) && $category_id}
        {literal}_$brt.push([['page_type', 'category page'],
            ['category_id', '{/literal}{$category_id|escape:'quotes':'UTF-8'}{literal}'],
            ['category_path', [[{/literal}{foreach from=$brainify_categories_id item=bci name=category_id}'{$bci|escape:'quotes':'UTF-8'}'{if !$smarty.foreach.category_id.last}, {/if}{/foreach}]{literal}]],
            ['categoryViewed', '{/literal}{$category_id|escape:'quotes':'UTF-8'}{literal}']]);{/literal}
    {/if}

	_$brt.push([['account_key', '{$brainify_key|escape:'javascript':'UTF-8'}'], ['flavour_key', '{$flavour_key|escape:'javascript':'UTF-8'}']]);
	{literal}(function() {
  		var bt = document.createElement('script');
  		bt.type = 'text/javascript';
  		bt.async = true;
		bt.src = document.location.protocol+'//static.brainify.io/bt-md.js';
  		var s = document.getElementsByTagName('script')[0];
  		s.parentNode.insertBefore(bt, s);
	})();{/literal}

    {if $product_in_cart_update|@count > 0}
        {literal}var _$brt = _$brt || [];{/literal}
        {foreach from=$product_in_cart_update key=action item=products}
        {foreach from=$products item=product}
            {literal}_$brt.push(['{/literal}{$action|escape:'javascript':'UTF-8'}{literal}', {
                item_id: {/literal}{$product.id_product|escape:'javascript':'UTF-8'}{literal},
                item_variation_id: {/literal}{$product.id_product_attribute|escape:'javascript':'UTF-8'}{literal},
                qnt: {/literal}{$product.qty|escape:'javascript':'UTF-8'}{literal},
                price: {/literal}{$product.price|escape:'javascript':'UTF-8'}{literal},
                qnt_after_event: {/literal}{$product.qnt_after_event|escape:'javascript':'UTF-8'}{literal},
                cart_total: {/literal}{$product.cart_total|escape:'javascript':'UTF-8'}{literal},
                shipping_price: {/literal}{$product.shipping_price|escape:'javascript':'UTF-8'}{literal},
                discount_code: '{/literal}{$product.discount_code|escape:'quotes':'UTF-8'}{literal}',
                discount_amount: {/literal}{$product.discount_amount|escape:'javascript':'UTF-8'}{literal},
            }]);{/literal}
        {/foreach}
        {/foreach}
    {/if}
</script>{/if}