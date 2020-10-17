{*
* Copyright (C) 2015-2018 Brainify - All Rights Reserved
*
* @author Brainify <tech@brainify.it>
* @copyright 2015-2018 Brainify
*}

<div id="resetPassword" class="container-fluid" style="display: none;">
    <div class="row">
        <div class="text-center">
            <img src="../modules/brainify/views/img/logo.svg">
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-xs-offset-0 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
        <h2 class="ba-h2">{l s='Reset password' mod='brainify'}</h2>
            <div>
            <span>
                {l s='Already have an account ?' mod='brainify'}
                <span class="clickableTest" id="wantToLoginBis">{l s='Log in' mod='brainify'}</span>
                <br>
            </span>
            </div>
            <br>
            <form action="" name="resetPassword" id="resetPasswordForm">
                <div class="form-group ba-form-group">
                    <label for="email-reset">{l s='Email' mod='brainify'}</label>
                    <input type="text" id="email-reset" class="form-control ba-form-control" value="{$email|escape:'htmlall':'UTF-8'}" required/>
                </div>

                <div>
                    <span class="ba-form-fail reset-fail">{l s='Incorrect email.' mod='brainify'}</span>
                    <button class="btn-primary ba-btn pull-right" type="submit" id="resetPasswordFormButton">{l s='OK' mod='brainify'}</button>
                </div>
            </form>
        </div>
    </div>

</div>
