import React from "react";
import { useState } from "react";
import "../App.css";
import dayjs from "dayjs";



const api = "d929b80c2587abdc6dbda7f96c9ff6c5";

function kc(a) {
  return Math.floor(a - 273.15);
}

console.log(dayjs().add(6, 'day').format('dddd DD/MM' ))
console.log(dayjs().format('dddd DD/MM/YYYY' ))


class Weather {
  constructor(temp, weather) {
    this.temp = temp;
    this.weather = weather;
  }
}

const aaaa = new Weather(0, 2);
console.log(aaaa);

function Search(props) {
  const [weather, setWeather] = useState("");
  const [location, setLocation] = useState("");
  const [longitude, setLongitude] = useState("");
  const [latitude, setLatitude] = useState("");
  const [windSpeed, setWindSpeed] = useState("");
  const [temperature, setTemperature] = useState("");
  const [data, setData] = useState("");
  const [data2, setData2] = useState("");

  let forecastDaily = [];
  let test = [];
  let forecastHourly = [];

  function keyPress(a) {
    if (a.key === "Enter") {
      const cityValue = a.target.value;

      fetch(
        `https://api.openweathermap.org/data/2.5/weather?q=${cityValue}&appid=${api}`
      )
        .then((response) => response.json())
        .then((data) => {
          setLocation(data.name);
          setWeather(data.weather[0].main);
          setLongitude(data.coord.lon);
          setLatitude(data.coord.lat);
          setTemperature(kc(data.main.temp));
          setWindSpeed(data.wind.speed);

          fetch(
            `https://api.openweathermap.org/data/2.5/onecall?lat=${data.coord.lat}&lon=${data.coord.lon}&appid=${api}`
            //`https://api.openweathermap.org/data/2.5/onecall?lat=48.841430200000005&lon=2.296164933019397&appid=${api}`
          )
            .then((response) => response.json())
            .then((data) => {
              console.log(data);
              //      console.log(data.hourly);
              //      console.log(data.daily);

              let x = 0;
              let y = 0;

              data.daily.forEach((element) => {
                forecastDaily[x] = element.weather[0].main + " ";
                x++;
              });

              x = 0 

                  const date = new Date()
                  console.log(date.getDay())

              data.daily.forEach((element) => {
                test[x] = new Weather(kc(element.temp.day), element.weather[0].main + " " );
                x++;
              });

              console.log(test)

              data.hourly.forEach((element) => {
                forecastHourly[y] = kc(element.temp) + " ";
                y++;
              });

              setData(forecastDaily);
              setData2(forecastHourly);

              //    console.log(forecastHourly);
              /* console.log(forecast)
              setData(kc(JSON.stringify(data.daily[2].temp.day)));

                   for (let  a of data.daily) {
             

                console.log(a)
                console.log(a.temp.day)
                aaa.push(<div key={a.temp.day}>{a.temp.day}</div>);
                console.log(aaa)
                console.log(a.props)
              }

           */
            });
        })

        .catch((error) => {
          console.log("error");
        });
    }
  }

  return (
    <div>
      <input onKeyPress={keyPress} />

      <div className="bgYellow textBlack0">
        <div className="bgRed textWhite1">Today</div>
        <div className="flex column"> Location : {location}</div>
        <div>Weather : {weather}</div>
        <div>Longitutde : {longitude}</div>
        <div>Latitude : {latitude}</div>
        <div>Temperature : {temperature} *C</div>
        <div>Wind Speed : {windSpeed}</div>
      </div>
      <div className="bgGreen">Daily Forecast : {data}</div>
      <div className="bgOrange">Hourly Forecast : {data2}</div>
    </div>
  );
}

export default Search;
