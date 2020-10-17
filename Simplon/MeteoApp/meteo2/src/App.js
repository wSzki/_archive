import React from "react";
import "./App.css";

var dateFormat = require("dateformat");
var now = new Date();

/////////////////////////////

const api = {
  key: "a9a8805c57415d9038b460128f23bf78",
  base: "https://api.openweathermap.org/data/2.5",
};

////////////////////////////////


class App extends React.Component {
  constructor(props) {
    super(props);
    this.state = {
      date: dateFormat(now),
      data: null,
      cc: "",
      city: "Paris",
      cityDetect: "",
    };

    this.search = this.search.bind(this);
  }


  search(a) {
    if (a.key === "Enter") {


      console.log(a.target.value);
const b =  a.target.value

      fetch(
        `https://api.openweathermap.org/data/2.5/weather?q=${b}&appid=${api.key}`
      )
        .then((response) => response.json())
        .then((data) => {
          this.setState({ data });
          console.log(this.state.data);
          console.log(this.state.data.main.temp);
          let z = (this.state.data.weather[0].main);
          let x = this.state.data.main.temp;
          const y = x - 273.15;
          console.log(Math.round(y));
          this.setState({ ccc: y + " " + z});
          
        });
    }
  }

  //https://api.openweathermap.org/data/2.5/onecall?lat={lat}&lon={lon}&//exclude={part}&appid={YOUR API KEY}
  //https://api.openweathermap.org/data/2.5/forecast/daily?q={city name}&cnt={cnt}&appid={your api key}

  /* search(a) {
    if (a.key === "Enter") {
      fetch(`${api.base}weather?q=${query}&units=metric&APPID=${api.key}`)
        .then((response) => response.json())
        .then((data) => this.setState({ data }));

      console.log(this.state.data);

      console.log("hello");
    }
  } */

  render() {
    return (
      <div className="App flex jcc">
        <main className="">
          <div className="searchBox flex jcc aic ">
            <input
              type="text"
              className=" textXXL  searchBar"
              placeholder="Search"
              onKeyPress={this.search}
            ></input>
          </div>

          <div className="locationBox bgWhite1">
            <div className="location textXXL ">{this.state.ccc}</div>
            <div className="date textXXL ">{this.state.date}</div>
          </div>
        </main>
      </div>
    );
  }
}

export default App;
