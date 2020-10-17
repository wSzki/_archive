import React from "react";
import '../App.css'
import { Link } from 'react-router-dom'


class Nav extends React.Component {
  render() {
    return (
      <nav className="flex w100 jcsb">
        <ul className="flex w100 jcsa">
          <Link className="nav" to='/search'><li>Search</li></Link>
          <Link className="nav" to='/about'><li>About</li></Link>
          <Link className="nav" to='/login'><li>Login</li></Link>
        </ul>
      </nav>
    );
  }
}

export default Nav;
