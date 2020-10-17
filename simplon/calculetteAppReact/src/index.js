
import React from 'react';
import ReactDOM from 'react-dom';
import './index.css';


// MAIN CALCULATOR ====================================================================  //
class Calc extends React.Component {

  // CONSTRUCTOR ======================================================================  //
  constructor(props) {
    super(props)
    this.state = {
      currentValue: 0,
      init: true,
      decimal: false,
      flag:false
    }
  };

  // HANDLES THE CLICKS ================================================================= //
  handleClick(i) {

    i = i.props

    let init = this.state.init

    let isNumber = (!(isNaN(parseFloat(i))))

    let decimalState = this.state.decimal
    let currentValue = this.state.currentValue
    let flag = this.state.flag

    let initScreen = () => { currentValue = ""; this.setState({ init: false }) }
    
    let setFlag = (a) => this.setState({flag: a})
    let setDecimalState = (a) => this.setState({ decimal: a })
    let setClick = (a) => this.setState({ click: a })
    let PRINT = (a) => this.setState({ currentValue: a })
    let RESET = () => {
      this.setState({
        currentValue: 0,
        init: true,
        decimal: false,
        flag:false
      })
      PRINT(0)
    }

    currentValue = currentValue.toString()

    if (i === "C") { RESET() }

    if ((isNumber)&&(flag)){initScreen();}
    if (isNumber) { if (init) { initScreen(); } { currentValue += i; setClick(true); PRINT(currentValue) } }
    if (i === ".") { if ((currentValue !== "") && (!(decimalState))) { currentValue += i; setDecimalState(true); PRINT(currentValue) } }
    if ((i === "*") || (i === "+") || (i === "-")) {

      if (currentValue !== "") {
        setFlag(false)
        setDecimalState(false)

        if (currentValue.slice(-1) === "*") { currentValue = currentValue.slice(0, -1) }
        if (currentValue.slice(-1) === "+") { currentValue = currentValue.slice(0, -1) }
        if (currentValue.slice(-1) === "-") { currentValue = currentValue.slice(0, -1) }
        PRINT(currentValue + i)
      }
    }

    if (i === "=") {
      if (currentValue.slice(-1) === "*") { currentValue = currentValue.slice(0, -1) }
      if (currentValue.slice(-1) === "+") { currentValue = currentValue.slice(0, -1) }
      if (currentValue.slice(-1) === "-") { currentValue = currentValue.slice(0, -1) }
      PRINT(eval(currentValue))
      setFlag(true)
    }
  }

  // GENERATES THE SQUARES =============================================================== //
  Square(props) {
    return (
      <button className="square"
        value={props}
        onClick={() => this.handleClick({ props })}>{props}</button>
    )
  }

  // RENDER ============================================================================ //
  render() {
    return (
      <div className="wrapper">

        <div className="screen">
          <p className="screenResult">{this.state.currentValue}</p>
        </div>

        <div className="calc">
          <div className="row">
            {this.Square("7")}
            {this.Square("8")}
            {this.Square("9")}
            {this.Square("*")}
          </div>

          <div className="row">
            {this.Square("4")}
            {this.Square("5")}
            {this.Square("6")}
            {this.Square("-")}
          </div>

          <div className="row">
            {this.Square("1")}
            {this.Square("2")}
            {this.Square("3")}
            {this.Square("+")}
          </div>

          <div className="row">
            {this.Square("C")}
            {this.Square(".")}
            {this.Square("0")}
            {this.Square("=")}
          </div>

        </div>
      </div>
    );
  }
}

////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////
// DOM RENDERING =======================================================================  // 

ReactDOM.render(
  <Calc />,
  document.getElementById('root')
);
