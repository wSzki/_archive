{*
* Copyright (C) 2015-2018 Brainify - All Rights Reserved
*
* @author Brainify <tech@brainify.it>
* @copyright 2015-2018 Brainify
*}

<div class="confirm-mail">
    <div class="container-fluid">
        <div class="row">
            <img src="../modules/brainify/views/img/logo.svg">
        </div>
        <div class="row">
            <h1>{l s='Congratulations' mod='brainify'}</h1>
            <p class="uppercase">{l s='Confirm your email to finish your registration' mod='brainify'}</p>
        </div>
        <div class="row">
            <img src="../modules/brainify/views/img/email.svg">
        </div>
        <div class="row" style="margin-bottom: 0">
            <p class="uppercase">{l s='In case of issues, enter the token received in the email' mod='brainify'}</p>
            <div>
                <form name="confirmationForm" id="confirmationForm">
                    <div class="form-group ba-form-group">
                        <span>
                            <label for="confirmationToken">{l s='Confirmation token' mod='brainify'}</label>
                            <input class="form-control ba-form-control" type="text" id="confirmationToken" value=""/>
                       </span>
                    </div>

                    <button class="btn-primary ba-btn" id="confirmationFormButton">{l s='Confirm' mod='brainify'}</button>
                </form>
                {if $isLogged}
                <div>
                    <span id="resendConfirmationEmailForm">{l s='You did not receive the email ?' mod='brainify'} <br>
                        <a style="cursor: pointer;color:#71C3B7" id="resendConfirmationEmailButton">{l s='Resend email' mod='brainify'}</a>
                    </span>
                    <span id="resendConfirmationEmailOk" style="display: none">{l s='Confirmation email sent' mod='brainify'}</span>
                </div>
                    {else}
                    {*TODO allow user login to resend confirmation token*}
                {/if}
            </div>
        </div>
    </div>
</div>
