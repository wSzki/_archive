import React from "react";
import "./App.css";
import Header from "./components/Header";
import Home from "./components/Home";


function App () {

  var weather = require('openweather-apis');
 
  weather.setLang('it');
  // English - en, Russian - ru, Italian - it, Spanish - es (or sp),
  // Ukrainian - uk (or ua), German - de, Portuguese - pt,Romanian - ro,
  // Polish - pl, Finnish - fi, Dutch - nl, French - fr, Bulgarian - bg,
  // Swedish - sv (or se), Chinese Tra - zh_tw, Chinese Sim - zh (or zh_cn),
  // Turkish - tr, Croatian - hr, Catalan - ca


  // set city by name
  weather.setCity('Fairplay');
 // or set the coordinates (latitude,longitude)
  weather.setCoordinate(50.0467656, 20.0048731);
  // or set city by ID (recommended by OpenWeatherMap)
  weather.setCityId(4367872);

  // or set zip code
  weather.setZipCode(33615);

  // 'metric'  'internal'  'imperial'
 weather.setUnits('metric');

  // check http://openweathermap.org/appid#get for get the APPID
 weather.setAPPID("d929b80c2587abdc6dbda7f96c9ff6c5");

  var abc = weather.getTemperature(function(err, temp){
       return temp });



  
  return (
    <div id="view" className="flex column aic h100 bgSkyblue ">
      <head>
        <link
          href="https://maxcdn.bootstrapcdn.com/font-awesome/5.10.2/css/font-awesome.min.css"
          rel="stylesheet"
        />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" /> 
      </head>


  

      <Header  />
  <div>{}</div>

      <Home />
    </div>

    
  );
}

export default App;
