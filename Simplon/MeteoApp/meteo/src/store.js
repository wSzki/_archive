import React from 'react';

export default class Store extends React.Component {
  
  constructor(props) {
    super(props)
    this.state = {

    }
  }

  render(){
    return React.Children.map(this.props.children, child => {
      return React.cloneElement(child, { ...this.state})

    })

  }}