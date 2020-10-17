import React from "react";
import { useState } from "react";
import Search from "./components/Search";
import "./App.css";
import Home from "./components/Home"
import Nav from "./components/Nav";
import About from "./components/About";
import { BrowserRouter as Router, Switch, Route } from "react-router-dom";

import FirebaseLogin from './components/FirebaseLogin'


class App extends React.Component {

  constructor(props) {
    super(props);
    this.state = { state: "" };
  }


  render() {
    return (
      <Router>
        <div className="App bgBlack1 h100 textWhite1">
          <Switch>
            <Route path="/" exact component={Home} />
            <Route path="/FirebaseLogin" component={FirebaseLogin} />
            <Route path="/Search" component={Search} />
          </Switch>
        </div>
      </Router>
    );
  }
}

export default App;

