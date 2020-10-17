
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
      temporaryValue: 0,
      temporaryValue2: 0,
      calculating: false,
      operator: "",
      init: true,
      active: false,
      decimal: false,
    }
  };

  // HANDLES THE CLICKS ================================================================= //
  handleClick(i) {

    i = i.props

    let init = this.state.init

    let isNumber = (!(isNaN(parseFloat(i))))

    let decimalState = this.state.decimal
    let calculating = this.state.calculating
    let currentValue = this.state.currentValue
    let temporaryValue = this.state.temporaryValue
    let temporaryValue2 = this.state.temporaryValue2
    let operator = this.state.operator

    let setOperator = (a) => this.setState({ operator: a })
    let setInitState = (a) => this.setState({ init: a })
    let setTemporaryValue = (a) => this.setState({ temporaryValue: a })
    let setTemporaryValue2 = (a) => this.setState({ temporaryValue2: a })

    let setDecimalState = (a) => this.setState({ decimal: a })
    let setCalculatingState = (a) => this.setState({ calculating: a })
    let initScreen = () => { currentValue = ""; this.setState({ init: false }) }

    let PRINT = (a) => this.setState({ currentValue: a })
    let RESET = () => {
      this.setState({
        currentValue: 0,
        temporaryValue: 0,
        temporaryValue2: 0,
        calculating: false,
        operator: "",
        init: true,
        active: false,
        decimal: false,
      })
      PRINT(0)
    }
    //////////////////////////////////////////////
    if (i === "C") { RESET() }

    else if (isNumber) { if (init) { initScreen(); } currentValue += i; PRINT(currentValue); }

    else if (i === ".") { if ((currentValue !== "") && (!(decimalState))) { currentValue += i; setDecimalState(true); PRINT(currentValue) } }

    else if ((i === "*") || (i === "+") || (i === "-")) {

      if (currentValue !== "") {
        setInitState(true)
        setDecimalState(false)




        if (operator === "") { setTemporaryValue(currentValue); setOperator(i) }

        console.log(temporaryValue)
        console.log(operator)
        // else {temporaryValue2 = currentValue; setTemporaryValue(eval(temporaryValue+operator+currentValue)); setOperator(i); }



      }





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
