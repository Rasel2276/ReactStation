import React from 'react'
import Navbar from './components/Navbar'
import Home from './pages/Home'
import About from './pages/About'
import Contact from './pages/Contact'
import Products from './pages/products'
import { Routes,Route } from 'react-router-dom'
const App = () => {
  return (
    <div>
      <Navbar></Navbar>
      <div className="container">
      <Routes>
        <Route path='/' element={<Home />} />
        <Route path='/products' element={<Products />} />
        <Route path='/about' element={<About />} />
        <Route path='/contact' element={<Contact />} />
      </Routes>
      </div>
    </div>
  )
}

export default App