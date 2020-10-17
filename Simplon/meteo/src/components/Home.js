import React from "react";
import "../App.css";


import ReactAnimatedWeather from 'react-animated-weather';

const defaults = {
  icon: 'SLEET',
  color: 'gray',
  size: 512,
  animate: true
};


export default class Home extends React.Component {
  render() {
    return <div className="frameRed flex row h100 w100 flex column jcc aic ">
        

  <ReactAnimatedWeather className=""
    icon={defaults.icon}
    color={defaults.color}
    //size={defaults.size}
    size={256}
    animate={defaults.animate}
  />

<ReactAnimatedWeather className=""
    icon={defaults.icon}
    color={defaults.color}
    //size={defaults.size}
    size={256}
    animate={defaults.animate}
  />

<ReactAnimatedWeather className=""
    icon={defaults.icon}
    color={defaults.color}
    //size={defaults.size}
    size={256}
    animate={defaults.animate}
  />

<ReactAnimatedWeather className=""
    icon={defaults.icon}
    color={defaults.color}
    //size={defaults.size}
    size={256}
    animate={defaults.animate}
  />
    </div>;
  }
}
