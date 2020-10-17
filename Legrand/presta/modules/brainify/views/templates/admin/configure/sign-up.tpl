{*
* Copyright (C) 2015-2018 Brainify - All Rights Reserved
*
* @author Brainify <tech@brainify.it>
* @copyright 2015-2018 Brainify
*}

<div id="signup">
    <h3>{l s='Register' mod='brainify'}</h3>

    <div>
        <span>
            {l s='Already have an account ?' mod='brainify'}
            <span class="clickableTest" id="wantToLogin">{l s='Log in' mod='brainify'}</span>
            <br>
        </span>
    </div>
    <br>
    <div style="display: none;" class="ba-form-fail" id="signupCommonError">{l s='An error has occured please try in few minutes' mod='brainify'}</div>
    <div style="display: none;" class="ba-form-fail" id="signupUserExists">{l s='User already exists' mod='brainify'}</div>
    <form action="" id="signupForm">
        <div class="form-group ba-form-group">
            <label for="email">{l s='Email' mod='brainify'}</label>
            <input class="form-control ba-form-control" required type="text" id="email" value="{$email|escape:'htmlall':'UTF-8'}"/>
        </div>
        <div class="form-group ba-form-group">
            <label for="name">{l s='Name' mod='brainify'}</label>
            <input class="form-control ba-form-control" required type="text" id="name" value="{$userName|escape:'htmlall':'UTF-8'}"/>

        </div>
        <div class="form-group ba-form-group">
            <label for="password">{l s='Password' mod='brainify'}</label>
            <input class="form-control ba-form-control" required {literal}pattern=".{6,20}"{/literal} type="password" id="password"/>

        </div>
        <div class="form-group ba-form-group">
            <label for="password2">{l s='Password confirmation' mod='brainify'}</label>
            <input class="form-control ba-form-control" required {literal}pattern=".{6,20}"{/literal} type="password"
                   id="password2"/>
        </div>

        <div class="form-group ba-form-group">
            <label for="language">{l s='Language' mod='brainify'}</label>
            <div class="ba-select">
                <select name="language" id="language" required>
                    <option value="fr_FR" {if $lang =="fr"} selected {/if}>Français</option>
                    <option value="en_EN" {if $lang !="fr"} selected {/if}>English</option>
                </select>
                <img class="icon" src="../modules/brainify/views/img/arrow.svg">
            </div>
        </div>

        <div class="form-group ba-form-group">
            <label for="company">{l s='Company name' mod='brainify'}</label>
            <input class="form-control ba-form-control" required type="text" id="company" value=""/>
        </div>

        <div class="form-group ba-form-group">
            <label for="cgu">
                <input type="checkbox" id="cgu" name="cgu" required>
                {l s='I agree to the Terms of Service.' mod='brainify'}
                <a href="http://www.brainify.it/cgu.html" target="_blank">{l s='Read the ToS' mod='brainify'}</a>
            </label>
        </div>

        <div>
            <button class="btn-primary ba-btn" type="submit" id="signupFormButton">{l s='Register' mod='brainify'}</button>
        </div>
    </form>

</div>
