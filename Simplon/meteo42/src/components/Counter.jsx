import React from 'react'
import { useState } from 'react'


const Counter = props => {

  const[count, setCount] = useState(1)

  const handleChange = () => { 
    setCount(count + 1)
  }
  //const a = useState(1)
  //console.log(a)
//
  //const count = a[0]
  //const setCount = a[1]

  return (
    <div>
      {count}
      <button onClick={handleChange}>INCREMENT</button>
    </div>
  )
}

export default Counter;