import React from "react";
import { useState } from "react";
import Search from "./components/Search";
import "./App.css";
import Nav from "./components/Nav";
import About from "./components/About";
import { BrowserRouter as Router, Switch, Route } from "react-router-dom";


import FirebaseLogin from './components/FirebaseLogin'

import StyledFirebaseAuth from 'react-firebaseui/StyledFirebaseAuth';

import * as firebase from "firebase"

var firebaseui = require('firebaseui');


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
  privacyPolicyUrl: function() {
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
  }

  else {
    console.log("not logged in")
  }

})



class App extends React.Component {

constructor(props){
  super(props)
  this.state = {email : "",
pass : ""}
}


btnLogin = (e) => {
  console.log(this.state.email)
  console.log(this.state.pass)
  const auth = firebase.auth()
  const promise = auth.signInWithEmailAndPassword(this.state.email, this.state.pass)
promise.catch (e => console.log(e.message))
}
btnSignup = (e) => {
  console.log(this.state.email)
  console.log(this.state.pass)
  const auth = firebase.auth()
  const promise = auth.createUserWithEmailAndPassword(this.state.email, this.state.pass)
 promise
 //.then(console.log("Signed up !"))
 .catch (e => console.log(e.message))
 }
 
 btnLogout = (e) => {
firebase.auth().signOut();
 }



  render() {
    return (
      <div className="App  bgBlack1 h100 textWhite1">
                <div className="absolute flex w100 h100 jcc aic">
        </div>

        <FirebaseLogin/>
        <div className=" overflowAuto h100 flex jcc column aic">
            <form className="flex column">
            <input onChange={event => this.setState({ email: event.target.value})} />
            <input onChange={event => this.setState({ pass: event.target.value})} />
            
            </form>
            <button type="button" onClick={this.btnLogin} className="btn">Login</button>
            <button type="button" onClick={this.btnSignup} className="btn">Sign up</button>
            <button type="button" onClick={this.btnLogout} className="btn">Log out</button>
          
          
          <Search/>

        </div>

      
      </div>
    );
  }
}

export default App;

