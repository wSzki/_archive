// Import FirebaseAuth and firebase.
import React from 'react';
import StyledFirebaseAuth from 'react-firebaseui/StyledFirebaseAuth';
import firebase from 'firebase';

import "./firebaseConfig"

export default class SignInScreen extends React.Component {

  // The component's Local state.
  state = {
    isSignedIn: false // Local signed-in state.
  };
  // Configure FirebaseUI.
  uiConfig = {
    // signInSuccessUrl: '<url-to-redirect-to-on-success>',
    signInOptions: [
      firebase.auth.GoogleAuthProvider.PROVIDER_ID,
      firebase.auth.EmailAuthProvider.PROVIDER_ID,
      firebase.auth.PhoneAuthProvider.PROVIDER_ID,
    ],
    tosUrl: '<your-tos-url>',
    privacyPolicyUrl: function () {
      window.location.assign('<your-privacy-policy-url>');
    }
  };

  // Listen to the Firebase Auth state and set the local state.
  componentDidMount() {
    this.unregisterAuthObserver = firebase.auth().onAuthStateChanged(
      (user) => this.setState({ isSignedIn: !!user })
    );
  }
  // Make sure we un-register Firebase observers when the component unmounts.
  componentWillUnmount() {
    this.unregisterAuthObserver();
  }
  render() {
    if (!this.state.isSignedIn) {
      return (
        <div className="tac jcc aic flex column" style={{ paddingTop: "150px" }}>
          <div className="bgBlue textWhite1" style={{ padding: "20px", borderRadius: "9px", boxShadow: "10px 10px 5px #064278" }}>
            <p>Please sign-in</p>
            <StyledFirebaseAuth uiConfig={this.uiConfig} firebaseAuth={firebase.auth()} />
          </div>
        </div>
      );
    }
    return (
      <div className="tac jcc aic flex column" style={{ paddingTop: "150px" }}>
        <div className="bgBlue textWhite1" style={{ padding: "20px", borderRadius: "9px", boxShadow: "10px 10px 5px #064278" }}>
          <p>You are now signed-in!</p>
          <br />
          <a className="bgRuby" style={{ padding: "10px", borderRadius: "9px" }} onClick={() => firebase.auth().signOut()}>Sign-out</a>
        </div>
      </div>
    );
  }
}