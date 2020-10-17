
import React from 'react';
import ReactDOM from 'react-dom';
import './index.css';


// MAIN CALCULATOR ====================================================================  //
class Calc extends React.Component {

  // CONSTRUCTOR ======================================================================  //
  constructor(props) {
    super(props)
    this.state = {
      display: 0,
      init: true,
      active: false,
      temp: 0,
      decimal: false
    }
  };

  // HANDLES THE CLICKS ================================================================= //
  handleClick(i) {

    i = i.props

    let displayState = this.state.display
    let temp = this.state.temp
    let init = this.state.init
    let decimalState = this.state.decimal
    let isActive = this.state.active

    let isNumber = (!(isNaN(parseFloat(i))))

    let updateScreen = () => this.setState({ display: displayState })
    let activate = () => this.setState({ active: true })
    let deActivate = () => this.setState({ active: false })
    let decimalOn = () => this.setState({ decimal: true })
    let initScreen = () => { displayState = ""; this.setState({ init: false }) }
    let popLastDecimal = () => { if (displayState.slice(-1) === ".") { displayState = displayState.slice(0, -1) } }
    let activePlus = () => this.setState({ plus: true, init: true, active: true, decimal: false, temp: parseFloat(displayState) })
    let activeMinus = () => this.setState({ minus: true, init: true, active: true, decimal: false, temp: parseFloat(displayState) })
    let activeMultiply = () => this.setState({ multiply: true, init: true, active: true, decimal: false, temp: parseFloat(displayState) })
    let calculate = () => this.setState({ init: true, active: true, decimal: false, temp: parseFloat(displayState) })

    let resetState = () => {
      this.setState({
        display: 0,
        init: true,
        active: false,
        temp: 0,
        decimal: false,
        plus: false,
        minus: false,
        multiply: false,
        equal: false
      })
    }

    //////////////////////////////////////////////

    if (init) { initScreen(); }
    // Reset
    if (i === "C") { resetState() };
    // Checking if number or "."

    if (isNumber) { displayState += i }
    else if ((i === ".") && (displayState !== "") && (!(decimalState))) { displayState += i; decimalOn() }

    // if not a number, perform calculations 
    // ++++++++++++++++++++++++++++++++++++
    if (i === "+") {
      popLastDecimal()
      displayState = parseFloat(displayState) + temp
      activePlus()
    }
    // **************************************
    else if (i === "*") {
      popLastDecimal()
      if (isActive) { displayState = parseFloat(displayState) * temp; calculate() }
      else { activeMinus() }
    }
    // --------------------------------------
    else if (i === "-") {
      popLastDecimal()
      if (isActive) { displayState = temp - parseFloat(displayState); calculate() }
      else { activeMultiply() }
    }

    else if (i === "=") {
      if (this.state.plus) { displayState = temp + parseFloat(displayState); calculate() }
      if (this.state.minus) { displayState = temp * parseFloat(displayState); calculate() }
      if (this.state.multiply) { displayState = temp - parseFloat(displayState); calculate() }


    }

    console.log(displayState)

    updateScreen()


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
          <p className="screenResult">{this.state.display}</p>
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
