import React from "react";
import "../App.css";

export default class Header extends React.Component {
  render() {
    return <div className=" w100 flex jcsb textXXL   ">
        <div className="padding50px"><i class='fa fa-home'></i></div>
        <div className="padding50px"><i class='fa fa-info-circle'></i></div>

    </div>;
  }
}
