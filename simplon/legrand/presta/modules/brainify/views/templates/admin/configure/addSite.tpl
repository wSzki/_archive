{*
* Copyright (C) 2015-2018 Brainify - All Rights Reserved
*
* @author Brainify <tech@brainify.it>
* @copyright 2015-2018 Brainify
*}

{if $isLogged}
<div id="register-site">
    <h2 class="ba-h2">{l s='Register site' mod='brainify'}</h2>
    {l s='You can add this site to Brainify Analytics.' mod='brainify'}
    <br>
    <form action="#" id="siteOnboardForm" name="siteOnboard">
        <div class="form-group ba-form-group">
            <label for="url">{l s='Shop URL' mod='brainify'}</label>
            <input class="form-control ba-form-control" readonly required type="text" id="url" value="{$shopUrl|escape:'htmlall':'UTF-8'}"/>
        </div>

        <div class="form-group ba-form-group">
            <label for="activity">{l s='Shop activity' mod='brainify'}</label>
            <div class="ba-select">
                <select id="activity" required>

                </select>
                <img class="icon" src="../modules/brainify/views/img/arrow.svg">
            </div>
        </div>
        <div class="form-group ba-form-group">
            <label for="shop">{l s='Shop' mod='brainify'}</label>
            <input class="form-control ba-form-control" readonly required type="text" id="shopName"/>
            <input class="form-control ba-form-control" type="hidden" readonly required id="shop"/>
        </div>

        <div>
            <button class="btn-primary ba-btn pull-right" type="submit" id="siteOnboardButton">
                {l s='Save' mod='brainify'}
            </button>
        </div>
    </form>
</div>
{else}
    You can add this site to Brainify Analytics, but you must <span class="clickableTest" id="wantToLogin">log in</span> before.
{/if}
