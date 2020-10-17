{*
* Copyright (C) 2015-2018 Brainify - All Rights Reserved
*
* @author Brainify <tech@brainify.it>
* @copyright 2015-2018 Brainify
*}

<div id="login" class="container-fluid" style="display: none;">
    <div class="row">
        <div class="text-center">
            <img src="../modules/brainify/views/img/logo.svg">
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-xs-offset-0 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
            <h2 class="ba-h2">{l s='Login' mod='brainify'}</h2>

            <div>
            <span>
                {l s='Don\'t have an account yet ?' mod='brainify'}
                <span class="clickableTest" id="wantToRegister">{l s='Register' mod='brainify'}</span>
                <br>
            </span>
            <span>
                {l s='Forgot password ?' mod='brainify'}
                <span id="wantToReset" class="clickableTest">{l s='Reset' mod='brainify'}</span>
                <br>
            </span>
            </div>
            <br>

            <form action="" id="loginForm" name="loginFormName">
                <div class="form-group ba-form-group">
                    <label for="email">{l s='Email' mod='brainify'}</label>
                    <input class="form-control ba-form-control" type="text" id="email" required value="{$brainifyEmail|escape:'htmlall':'UTF-8'}"/>
                </div>

                <div class="form-group ba-form-group">
                    <label for="password">{l s='Password' mod='brainify'}</label>
                    <input class="form-control ba-form-control" required type="password" id="password"/>
                </div>

                <div>
                    <span class="ba-form-fail login-fail">{l s='Incorrect credentials.' mod='brainify'}</span>
                    <button class="ba-btn btn-primary pull-right" type="submit" id="loginFormButton">
                        {l s='Log in' mod='brainify'}
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>
