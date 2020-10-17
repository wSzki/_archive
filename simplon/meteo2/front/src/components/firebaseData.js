// Import FirebaseAuth and firebase.
import React from 'react';
import StyledFirebaseAuth from 'react-firebaseui/StyledFirebaseAuth';
import firebase from 'firebase';
import { useState } from 'react'
import "./firebaseConfig"






firebase.database().ref('meteo/').set({
  1: "Paris",
  2: "Rio",
  3: "Tokyo",
  4: "Vancouver"
});

//function readUserData2() {
//  const data = firebase.database().ref('meteo/city/');
//  data.once('value').then((a) => { console.log(a.val()) })
//}

const data = firebase.database().ref('meteo/');
data.once('value').then((a) => { console.log(a.val()) })


//const [dbvalue, setdbvalue] = useState("");
//data.once('value').then((a) => { setdbvalue(a.val()) })




export default function Hello() {

  const [dbvalue, setdbvalue] = useState("");
  const [idLength, setidLength] = useState("");
  const [name, setname] = useState("");

  const data = firebase.database().ref('meteo/');
  data.once('value').then((a) => { console.log(a.val()) })

  const show = () => {
    const data = firebase.database().ref('meteo/');
    data.once('value').then((a) => { setdbvalue(a.val()); })

  }

  const input = (e) => {
    console.log(e.target.value)
    setname(e.target.value)
    const data = firebase.database().ref('meteo/');
    data.once('value').then((a) => { setidLength(a.val().length) })
    console.log(idLength)
  }

  const add = () => {
    firebase.database().ref('meteo/').set({
      6: name,

    });
  }



  

  return (
    <div className="flex column  h50 jcc aic ">

      <button onClick={show}>Show Favorites </button>
      <div>{dbvalue}</div>
      <br/>
      <div>Paris : 19, Clouds </div>
      <div>Rio : 19, Sunshine </div>
      <div>Vancover : 15, Sunshine </div>
      <div>Tokyo : 26, Rain </div>
      <div></div>
      <br />
      <br />
      <br />
      <input onKeyPress={input}></input>
      <button onClick={add}>Add to Favorites </button>



    </div>
  )

}

