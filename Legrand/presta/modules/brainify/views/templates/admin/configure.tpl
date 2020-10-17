{*
* Copyright (C) 2015-2018 Brainify - All Rights Reserved
*
* @author Brainify <tech@brainify.it>
* @copyright 2015-2018 Brainify
*}

<div>
    {if $isOnboarded && ( $userStatus eq 'confirmed' || $userStatus eq 'initialized' )}
        {include file="./configure/final-step.tpl"}
    {elseif $isLogged && $userStatus eq 'confirmation'}
        {include file="./configure/confirmEmail.tpl"}
    {elseif $isLogged && ( $userStatus eq 'confirmed' || $userStatus eq 'initialized' )}
        {include file="./configure/step2.tpl"}
    {else}
        {include file="./configure/step1.tpl"}
    {/if}

    {include file="./configure/login.tpl"}
    {include file="./configure/forgot-password.tpl"}

    {*{if $isLogged}*}
        {*<a href="#" id="logout">{l s='Logout as %s' sprintf=$userEmail mod='brainify'}</a>*}
    {*{/if}*}
</div>

<script type="text/javascript">
    var brainifyConfirmUrl = "{$confirmUrl|escape:'javascript':'UTF-8'}";
    var brainifyLoginUrl = "{$loginUrl|escape:'javascript':'UTF-8'}";
    var brainifyGetActivitiesUrl = "{$getActivitiesUrl|escape:'javascript':'UTF-8'}";
    var brainifySignupUrl = "{$signupUrl|escape:'javascript':'UTF-8'}";
    var brainifyResetPasswordUrl = "{$resetPasswordUrl|escape:'javascript':'UTF-8'}";
    var brainifyOnboardSiteUrl = "{$onboardSiteUrl|escape:'javascript':'UTF-8'}";
    var brainifyGetShopUrl = "{$getShopUrl|escape:'javascript':'UTF-8'}";
    var brainifyGetUserSitesUrl = "{$getUserSitesUrl|escape:'javascript':'UTF-8'}";
    var brainifyKeysUrl = "{$keysUrl|escape:'javascript':'UTF-8'}";
    var brainifyLogoutUrl = "{$logoutUrl|escape:'javascript':'UTF-8'}";
    var brainifyResetUrl = "{$resetUrl|escape:'javascript':'UTF-8'}";
    var brainifyResendConfirmationEmailUrl = "{$resendConfirmationEmail|escape:'javascript':'UTF-8'}";
</script>
