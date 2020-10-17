import React from "react";
import { useState } from "react";
import Search from "./components/Search";
import "./App.css";
import Navigation from "./components/Navigation";
import Favorites from "./components/Favorites";
import About from "./components/About";
import { BrowserRouter as Router, Switch, Route } from "react-router-dom";
import Hello from "./components/firebaseData"
import FirebaseLogin from './components/FirebaseLogin'
class App extends React.Component {

  constructor(props) {
    super(props);
    this.state = { state: "" };
  }


  render() {
    return (
      <Router>
        <div className="App textWhite0 bgBlack1 ">
          <Navigation />
        
          <Switch>
            <Route path="/" exact component={Search} />
            <Route path="/About" component={About} />
            <Route path="/Favorites" component={Favorites} />
            <Route path="/FirebaseLogin" component={FirebaseLogin} />
          </Switch>
        </div>
      </Router>
    );
  }
}

export default App;


