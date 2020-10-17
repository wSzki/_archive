import React from "react";
import { useState } from "react";
import "../App.css";
import dayjs from "dayjs";
import Clock from "react-clock";
import kc from "./kelvinToCelcius";


const api = "d929b80c2587abdc6dbda7f96c9ff6c5";

////////////////////////////

class Weather {
  constructor(temp, weather, date, icon) {
    this.date = date;
    this.temp = temp;
    this.weather = weather;
    this.icon = icon;
  }
}

///////////////////////////

function Search(props) {
  const [currentState, setCurrentState] = useState("");
  const [forecastHourlyState, setForecastHourlyState] = useState("");
  const [forecastDailyState, setForecastDailyState] = useState("");
  const [errorState, setErrorState] = useState("");
  const [name, setName] = useState("");

  let forecastDaily = [];
  let forecastHourly = [];

  let x = 0;
  let y = 0;
  
  //////////////////////////

  function keyPress(a) {
    if (a.key === "Enter") {
      setErrorState("");
      const date = new Date();
      const cityValue = a.target.value;
      fetch(
        `https://api.openweathermap.org/data/2.5/weather?q=${cityValue}&appid=${api}` // Fetch to get longitutde and latitude to use with second API - Translate String to coordinates
      )
        .then((response) => response.json())
        .then((data) => {
          setName(data.name);
          // Fetching weather data with coordinates - Current - Forecast
          fetch(
            `https://api.openweathermap.org/data/2.5/onecall?lat=${data.coord.lat}&lon=${data.coord.lon}&appid=${api}`
          )
            .then((response) => response.json())
            .then((data) => {
              console.log(date.getDay());

              //////////////////////////

              data.daily.forEach((element) => {
                forecastDaily[x] = new Weather(
                  kc(element.temp.day),
                  element.weather[0].main + " ",
                  dayjs().add(x, "day").format("ddd DD/MM"),
                  element.weather[0].icon
                );
                x++;
              });

              setForecastDailyState(
                forecastDaily.map((a) => (
                  <div className="flex w25 column jcc aic">
                    <div>{a.date}</div>
                    <div>{a.temp}°C </div>
                    {/*  <div>{a.weather}</div> */}
                    <img
                      className="h50"
                      src={
                        "http://openweathermap.org/img/wn/" + a.icon + "@2x.png"
                      }
                    ></img>
                  </div>
                ))
              );

              //////////////////////////

              x = 0;

              const event = new Date();

              y = 0;
              data.hourly.forEach((element) => {
                forecastHourly[x] = new Weather(
                  kc(element.temp),
                  element.weather[0].main + " ",
                  new Date().getHours() + y + "h00",
                  element.weather[0].icon
                );
                console.log();
                x++;
                y++;
                if (event.getHours() + y === 24) {
                  y = 0 - event.getHours();
                }
              });

              setForecastHourlyState(
                forecastHourly.map((a) => (
                  <div className="flex column jcc aic w15">
                    <div>{a.date}</div>
                    <div>{a.temp}°C </div>
                    {/*  <div>{a.weather}</div> */}
                    <img
                      className="h50"
                      src={
                        "http://openweathermap.org/img/wn/" + a.icon + "@2x.png"
                      }
                    ></img>
                  </div>
                ))
              );
              y = 0;
              data.hourly.forEach((element) => {
                forecastHourly[y] = kc(element.temp) + " ";
                y++;
              });
              x = 0;

              const icon = data.current.weather[0].icon;
              const iconURL = ` http://openweathermap.org/img/wn/${icon}@2x.png`;
              //////////////////////////
              console.log(data);
              setCurrentState(
                <div className="flex column jcc aic">
                  <br />
                  <div>{kc(data.current.temp)}°C</div>
                  <div>{data.current.weather[0].main}</div>
                  <img src={iconURL}></img>
                </div>
              );
            });
        })
        //////////////////////////

        .catch((error) => {
          console.log("error");
          setErrorState("City name does not exist");
          setCurrentState("");
          setForecastDailyState("");
          setForecastHourlyState("");
        });
    }
  }

  return (

    
    <div className="textS h100 w100 flex column aic">
      <div style={{margin:"10px"}} className="flex w100 p10 jcc ">
        <input onKeyPress={keyPress} className=" flex jcc aic tac w50" />
      </div>
      <div style={{margin:"10px"}} className="h33   w100 flex jcc  aic column ">
        <div className=" textXL textWhite0 p10">{name}</div>
        <div className="textXL textWhite1">{currentState}</div>
        <div className="textRed bgWhite2">{errorState}</div>
      </div>

      <div className="w100 ">
        <div style={{marginVertical:"10px"}} className="bgGreen flex row wrap jcsa ">{forecastDailyState}</div>
      </div>

      <div className="w100">
        <div style={{marginVertical:"10px"}}className="bgOrange flex row wrap jcsa">{forecastHourlyState}</div>
      </div>
    </div>
  );
}

export default Search;
