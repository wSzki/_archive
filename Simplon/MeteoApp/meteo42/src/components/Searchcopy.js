import React from "react";
import { useState } from "react";

const api = "e40f650c2214e7883b9a3e4cd28fb910";
const testCity = "Paris";

function Search(props) {
  const [weather, setWeather] = useState("TEST");

  const b = () => {
    setWeather(props.meteo)
  }



  return ( <button onClick={ b } > {weather} </button>)

 }

 export default Search
//  const handleChange = event => { 
//    setWeather(event.currentTarget.value)
//
//
//    const id = new Date().getTime();
//    const nom = nouveauClient


  //fetch(
  //  `http://api.weatherstack.com/current?access_key=${api}&query=${testCity}`
  //)
  //  .then((response) => response.json())
  //  .then((data) => {
  //    console.log(data);
  //    return (data);
  //  });

