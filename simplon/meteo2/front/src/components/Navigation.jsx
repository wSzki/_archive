import React from "react";
import '../App.css'
import { Link } from 'react-router-dom'
import { FaCloud, FaSearch, FaInfoCircle, FaSignInAlt, FaBookmark } from 'react-icons/fa';
import { BrowserRouter as Router, Switch, Route } from "react-router-dom";
import Search from "./Search";
import About from "./About";
import Favorites from "./Favorites";
import FirebaseLogin from './FirebaseLogin'

class Navigation extends React.Component {
  render() {
    return (
      <nav className="flex jcsb bgBlue" style={{ padding: "15px", left: 0, right: 0 }}>

<div className="flex tac aic textXL w50">
<FaCloud/> &nbsp;&nbsp;  <Link style={{textDecoration: "none"}} className="aic tac flex nav" to='/'>Meteo</Link> 
</div>
        <div className="flex jcsb aic w50 tac textM ">
          <Link style={{textDecoration: "none"}} className="aic tac flex nav" to='/'><FaSearch /></Link>
          <Link style={{textDecoration: "none"}} className="aic tac flex nav" to='/about'><FaInfoCircle /></Link>
          <Link style={{textDecoration: "none"}} className="aic tac flex nav" to='/favorites'><FaBookmark /></Link>
          <Link style={{textDecoration: "none"}} className="aic tac flex nav" to='/firebaselogin'><FaSignInAlt /></Link>
        </div>

      </nav>
      

    );
  }
}


export default Navigation;
