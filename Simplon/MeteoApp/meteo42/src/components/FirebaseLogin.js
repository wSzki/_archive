import React from "react";
import StyledFirebaseAuth from 'react-firebaseui/StyledFirebaseAuth';
import * as firebase from "firebase"
var firebaseui = require('firebaseui');


export default function FirebaseLogin() {

  const firebaseConfig = {
    apiKey: "AIzaSyA3Ic_xoVsarIqel7QDl4vWr5pAUWFclLM",
    authDomain: "react-33622.firebaseapp.com",
    databaseURL: "https://react-33622.firebaseio.com",
    projectId: "react-33622",
    storageBucket: "react-33622.appspot.com",
    messagingSenderId: "820375977285",
    appId: "1:820375977285:web:c5553caf632ba5ad8f122c"
  };

  firebase.initializeApp(firebaseConfig)

  var uiConfig = {
    signInSuccessUrl: '<url-to-redirect-to-on-success>',
    signInOptions: [
      //Leave the lines as is for the providers you want to offer your users.
      firebase.auth.GoogleAuthProvider.PROVIDER_ID,
      firebase.auth.FacebookAuthProvider.PROVIDER_ID,
      firebase.auth.TwitterAuthProvider.PROVIDER_ID,
      firebase.auth.GithubAuthProvider.PROVIDER_ID,
      firebase.auth.EmailAuthProvider.PROVIDER_ID,
      firebase.auth.PhoneAuthProvider.PROVIDER_ID,
      firebaseui.auth.AnonymousAuthProvider.PROVIDER_ID
    ],
    // tosUrl and privacyPolicyUrl accept either url string or a callback
    // function.
    // Terms of service url/callback.
    tosUrl: '<your-tos-url>',
    // Privacy policy url/callback.
    privacyPolicyUrl: function () {
      window.location.assign('<your-privacy-policy-url>');
    }
  };

  // Initialize the FirebaseUI Widget using Firebase.
  var ui = new firebaseui.auth.AuthUI(firebase.auth());
  // The start method will wait until the DOM is loaded.
  ui.start('#firebaseui-auth-container', uiConfig);

  firebase.auth().onAuthStateChanged(firebaseUser => {

    if (firebaseUser) {
      console.log(firebaseUser)
    } else {
      console.log("not logged in")
    }

  })

  return (
    <div id="firebaseLoginContainer" style={{
      left: "50%",
      top: "50%",
      transform: "translate(-50%, -50%)",
      borderRadius: "9px",
      zIndex: "99"
    }} className={"absolute flex bgWhite1"} >


      <StyledFirebaseAuth uiConfig={uiConfig} firebaseAuth={firebase.auth()} />
    </div>)
}













