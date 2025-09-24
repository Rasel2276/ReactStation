import React from 'react'
import { Link } from 'react-router-dom'

const Navbar = () => {
  return (
    <div className='navbar'>
      <img src="" alt="" />
      <ul>
       <Link to='/'><li>Home</li></Link> 
       <Link to='/contact'><li>Contact</li></Link>
       <Link to='/about'><li>About</li></Link>
       <Link to='/products'><li>Products</li></Link>
      </ul>
      <button>Get started</button>
    </div>
  )
}

export default Navbar