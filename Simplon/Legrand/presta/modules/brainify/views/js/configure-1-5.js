/**
 * Copyright (C) 2015-2018 Brainify - All Rights Reserved
 *
 * @author Brainify <tech@brainify.it>
 * @copyright  2015-2018 Brainify
 */
(function ($) {
    $(document).ready(function () {

        var isSubmitting = false;

        getActivities(function(data) {
            var $el = $("#activity");
            $el.empty(); // remove old options
            $.each(data, function(key,value) {
                $el.append($("<option></option>")
                    .attr("value", key).text(value));
            });
        });

        getShop(function(data) {
            var $el = $("#shopName");
            $el.attr('value', data['name']);
            var $el = $("#shop");
            $el.attr('value', data['id_shop']);
        });

        $('#wantToReset').click(function() {
            if(!isSubmitting) {
                $('#login').hide();
                $('#resetPassword').show();
            }
        });

        $('#wantToLogin').click(function(){
            if(!isSubmitting) {
                $('#resetPassword').hide();
                $('#ba-step1').hide();
                $('#ba-step2').hide();
                $('#login').show();
            }
        });

        $('#wantToLoginBis').click(function(){
            if(!isSubmitting){
                $('#resetPassword').hide();
                $('#ba-step1').hide();
                $('#ba-step2').hide();
                $('#login').show();
            }
        });

        $('#wantToRegister').click(function(){
            if(!isSubmitting) {
                $('#login').hide();
                $('#ba-step1').show();
            }
        });

        $('#logout').click(function () {
            if(!isSubmitting) {
                isSubmitting = true;
                $.ajax({
                    type: 'POST',
                    url: brainifyLogoutUrl,
                    dataType: 'json',
                    data: { },
                    success: function (data, status, xhr) {
                        window.location.reload();
                    },
                    error: redirectToLogin
                });
            }
            return false;
        });

        $('#signupForm').submit(function(event) {
            event.preventDefault();
            if(!isSubmitting) {
                $("#signupUserExists").hide();
                $("#signupCommonError").hide();
                if ($("#signupForm #password").val() == $("#signupForm #password2").val()) {
                    isSubmitting = true;
                    $.ajax({
                        type: 'POST',
                        url: brainifySignupUrl,
                        dataType: 'json',
                        data: {
                            "email": $('#signupForm #email').val(),
                            "password": $('#signupForm #password').val(),
                            "password2": $('#signupForm #password2').val(),
                            "name": $('#signupForm #name').val(),
                            "company": $('#signupForm #company').val(),
                            "language": $('#signupForm #language').val(),
                            "presta_token": getUrlParameter('token')
                        },
                        success: function (data, status, xhr) {
                            redirectToLogin(xhr);
                            if (data.status == 'error') {
                                if (data.msg == "User email exists") {
                                    $("#signupUserExists").show();
                                } else {
                                    $("#signupCommonError").show();
                                }
                                isSubmitting = false;
                            } else {
                                window.location.reload();
                            }
                        },
                        error: redirectToLogin
                    });
                    return false;
                } else {
                    $("#signupForm #password").val("");
                    $("#signupForm #password2").val("");
                    return false;
                }
            }
        });



        $('#loginForm').submit(function(event){
            event.preventDefault();
            if(!isSubmitting) {
                isSubmitting = true;
                $.ajax({
                    type: 'POST',
                    url: brainifyLoginUrl,
                    dataType: 'json',
                    data: {
                        "email": $('#loginForm #email').val(),
                        "password": $('#loginForm #password').val()
                    },
                    success: function (data, status, xhr) {
                        redirectToLogin(xhr);
                        if (data.status == 'error') {
                            $(".login-fail").show();
                            isSubmitting = false;
                        } else {
                            $(".login-fail").hide();
                            window.location.reload();
                        }
                    },
                    error: redirectToLogin
                });
            }
            return false;
        });

        $('#confirmationForm').submit(function(event) {
            event.preventDefault();
            if(!isSubmitting) {
                isSubmitting = true;
                $.ajax({
                    type: 'POST',
                    url: brainifyConfirmUrl,
                    dataType: 'json',
                    data: {
                        "confirmation": $('#confirmationForm #confirmationToken').val()
                    },
                    success: function (data, status, xhr) {
                        redirectToLogin(xhr);
                        window.location.reload();
                    },
                    error: redirectToLogin
                });
            }
            return false;
        });

        $('#resetPasswordForm').submit(function (event) {
            event.preventDefault();
            if(!isSubmitting) {
                isSubmitting = true;
                $.ajax({
                    type: 'POST',
                    url: brainifyResetPasswordUrl,
                    dataType: 'json',
                    data: {
                        "email": $('#resetPasswordForm #email-reset').val()
                    },
                    success: function (data, status, xhr) {
                        redirectToLogin(xhr);
                        if (data.status == 'error') {
                            $('.reset-error').hide();
                            $('.reset-fail').show();
                            isSubmitting = false;
                        } else {
                            $('.reset-fail').hide();
                            $('#resetPassword').hide();
                            $('#login').show();
                        }
                    },
                    error: redirectToLogin
                });
            }
            return false;
        });

        $('#siteOnboardForm').submit(function (event) {
            event.preventDefault();
            if(!isSubmitting) {
                isSubmitting = true;
                $.ajax({
                    type: 'POST',
                    url: brainifyOnboardSiteUrl,
                    dataType: 'json',
                    data: {
                        "activity": $('#siteOnboardForm #activity').val(),
                        "url": $('#siteOnboardForm #url').val(),
                        "shop_id": $('#siteOnboardForm #shop').val(),
                        "name": $('#siteOnboardForm #shopName').val()
                    },
                    success: function (data, status, xhr) {
                        redirectToLogin(xhr);
                        window.location.reload();
                    },
                    error: redirectToLogin
                });
            }
            return false;
        });

        $('#keysFormButton').click(function () {
            $.ajax({
                type: 'POST',
                url: brainifyKeysUrl,
                dataType: 'json',
                data: {
                    "apiKey":  $('#keysForm #apiKey').val(),
                    "accountKey": $('#keysForm #accountKey').val()
                },
                success: function (data, status, xhr) {
                    redirectToLogin(xhr);
                },
                error: redirectToLogin
            });
            return false;
        });

        $("#resendConfirmationEmailButton").click(function(){
            $.ajax({
                type: 'POST',
                url: brainifyResendConfirmationEmailUrl,
                dataType: 'json',
                data: {
                    "presta_token":getUrlParameter('token')
                },
                success: function (data, status, xhr) {
                    redirectToLogin(xhr);
                    if((data && data.status && data.status == "ok") || status == "success"){
                        $("#resendConfirmationEmailOk").show();
                        $("#resendConfirmationEmailForm").hide();
                    }
                },
                error: redirectToLogin
            });
            return false;
        });

        $('#resetModule').click(function(){
           if(confirm("Be careful this operation will reset plugin database")){
               resetPlugin(function() {
                   window.location.reload();
               })
           }
        });

        function resetPlugin(callback) {
            $.ajax({
                type: 'POST',
                url: brainifyResetUrl,
                dataType: 'json',
                data: {},
                success: function (data, status, xhr) {
                    redirectToLogin(xhr);
                    callback();
                },
                error: redirectToLogin
            });
            return false;
        }


        function getActivities(callback) {
            $.ajax({
                type: 'GET',
                url: brainifyGetActivitiesUrl,
                dataType: 'json',
                success: function (data, status, xhr) {
                    redirectToLogin(xhr);
                    callback(data);
                },
                error: redirectToLogin
            });
            return false;
        }

        function getShop(callback) {
            $.ajax({
                type: 'GET',
                url: brainifyGetShopUrl,
                dataType: 'json',
                success: function (data, status, xhr) {
                    redirectToLogin(xhr);
                    callback(data);
                },
                error: redirectToLogin
            });
            return false;
        }

        function getUserSites(callback) {
            $.ajax({
                type: 'GET',
                url: brainifyGetUserSitesUrl,
                dataType: 'json',
                success: function (data, status, xhr) {
                    redirectToLogin(xhr);
                    callback(data);
                },
                error: redirectToLogin
            });
            return false;
        }


        /**
         * Check if prestashop need re-login
         * @param xhr
         * @returns {boolean}
         */
        function redirectToLogin(xhr) {
            var needLogin = xhr.getResponseHeader('Login');
            if (xhr.status == 200 && needLogin == 'true') {
                window.location.reload();
                return true;
            }
            return false;
        }

        function getUrlParameter(sParam) {
            var sPageURL = decodeURIComponent(window.location.search.substring(1)),
                sURLVariables = sPageURL.split('&'),
                sParameterName,
                i;

            for (i = 0; i < sURLVariables.length; i++) {
                sParameterName = sURLVariables[i].split('=');

                if (sParameterName[0] === sParam) {
                    return sParameterName[1] === undefined ? true : sParameterName[1];
                }
            }
        }

    });
})($);
