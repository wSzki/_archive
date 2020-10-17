/*
 * 2007-2019 PrestaShop
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to http://www.prestashop.com for more information.
 *
 *  @author PrestaShop SA <contact@prestashop.com>
 *  @copyright  2007-2019 PrestaShop SA
 *  @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 *  International Registered Trademark & Property of PrestaShop SA
 */
$(document).ready(function () {
    $('.dhl-ec-row input:radio').on('change', function () {
        var countExtracharge = $(".options_dg [id$='_on']:checked").length;

        if (countExtracharge > 3) {
            $("#" + this.name + "_on").prop("checked", false);
            $("#" + this.name + "_off").prop("checked", true);
            alert("You can't check more than three options ! ");
        } else {
            toggleTypeDesignation();
        }
    });
});


function toggleWeightPriceServices() {
    if ($('#DHL_USE_DHL_PRICES_on').prop('checked')) {
        $('.dhl-weight-prices-div').show(400);
        $('.dhl-services-list-div').show(400);
        $('.dhl-use-dhl-packages-div').show(400);
        $('.dhl-enable-free-delivery-from').show(400);
        toggleWeightingType();
        toggleFreeDelivery();
    } else {
        $('.dhl-weight-prices-div').hide(200);
        $('.dhl-services-list-div').hide(400);
        $('.dhl-use-dhl-packages-div').hide(400);
        $('.dhl-weighting-type-div').hide(200);
        $('.dhl-weighting-value-percent-div').hide(200);
        $('.dhl-weighting-value-amount-div').hide(200);
        $('.dhl-enable-free-delivery-from').hide(200);
        $('.dhl-free-delivery-from').hide(200);
    }
}

function toggleFreeDelivery() {
    if ($('#DHL_ENABLE_FREE_SHIPPING_FROM_on').prop('checked')) {
        $('.dhl-free-delivery-from').show(400);
    } else {
        $('.dhl-free-delivery-from').hide(200);
    }
}

function toggleWeightingType() {
    if ($('#DHL_WEIGHT_PRICES_on').prop('checked')) {
        $('.dhl-weighting-type-div').show(400);
        toggleWeightingValue();
    } else {
        $('.dhl-weighting-type-div').hide(200);
        $('.dhl-weighting-value-percent-div').hide(200);
        $('.dhl-weighting-value-amount-div').hide(200);
    }
}

function toggleWeightingValue() {
    var percentDiv = $('.dhl-weighting-value-percent-div');
    var amountDiv = $('.dhl-weighting-value-amount-div');
    if ($('#type-percent').prop('checked')) {
        amountDiv.hide(200);
        percentDiv.show(400);
    } else {
        percentDiv.hide(200);
        amountDiv.show(400);
    }
}

function toggleSignatureInvoice() {
    if ($('#DHL_ENABLE_PLT_on').prop('checked')) {
        $('.dhl-upload-signature-div').show(0);
        $('.dhl-new-img-signature-div').show(0);

    } else {
        $('.dhl-upload-signature-div').hide(200);
        $('.dhl-new-img-signature-div').hide(200);
        $('.dhl-img-signature-div').hide(200);
        $('#signature').imgAreaSelect({hide: true});
    }
}

function updateWeightSuffix(id) {
    var weightSuffix = $(id + ' .dhl-suffix-weight');
    if ($(id + ' #system-metric').prop('checked')) {
        weightSuffix.html('kg');
    } else {
        weightSuffix.html('lb');
    }

}

function updateDimensionSuffix(id) {
    var dimSuffix = $(id + ' .dhl-suffix-dimension');
    if ($(id + ' #system-metric').prop('checked')) {
        dimSuffix.html('cm');
    } else {
        dimSuffix.html('in');
    }
}

function toggleTypeDesignation() {
    if ($('#extracharge_4_on').prop('checked')) {
        $('.div_dhl_type_designation').show(400);
    } else {
        $('.div_dhl_type_designation').hide(200);
    }
}

$(document).ready(function () {
    toggleWeightPriceServices();
    toggleSignatureInvoice();
    toggleTypeDesignation();
});

$('.dhl-use-dhl-prices-div span').live('click', function () {
    toggleWeightPriceServices();
});
$('.dhl-enable-free-delivery-from span').live('click', function () {
    toggleWeightPriceServices();
});
$('.dhl-weight-prices-div span').live('click', function () {
    toggleWeightPriceServices();
});
$('#type-percent').live('click', function () {
    toggleWeightingValue();
});
$('#type-amount').live('click', function () {
    toggleWeightingValue();
});
$('#system-metric').live('click', function () {
    updateWeightSuffix('#bo');
    updateDimensionSuffix('#bo');
});
$('#system-imperial').live('click', function () {
    updateWeightSuffix('#bo');
    updateDimensionSuffix('#bo');
});
$('.dhl-enable-plt-div span').live('click', function () {
    toggleSignatureInvoice();
});
