import React, { useState } from 'react';
import LogoutButton from '../../auth/LogoutButton'; // path check koro

import { BsFillBellFill, BsFillEnvelopeFill, BsPersonCircle, BsSearch, BsJustify } from 'react-icons/bs';

function Header({ OpenSidebar }) {

  const [isDropdownOpen, setIsDropdownOpen] = useState(false);


  const toggleDropdown = () => {
    setIsDropdownOpen(prev => !prev);
  };


  const handleLogout = () => {

    console.log("User logged out!");
    alert("Logging out...");

    setIsDropdownOpen(false); 

  };

  return (
    <header className='header'>
      <div className='menu-icon'>
        <BsJustify className='icon' onClick={OpenSidebar} />
      </div>
      <div className='header-left'>
        <BsSearch className='icon' />
      </div>

      {/* Dropdown এর জন্য নতুন div */}
      <div className='header-right'>
        <BsFillBellFill className='icon' id="header-icon" />
        <BsFillEnvelopeFill className='icon' id="header-icon" />

        {/* Profile Icon এবং Dropdown কন্টেইনার */}
        <div className='dropdown-container'>
          <BsPersonCircle 
            className='icon dropdown-toggle' 
            onClick={toggleDropdown} 
            id="header-icon"
          />
          
          {/* ড্রপডাউন মেনু */}
          {isDropdownOpen && (
            <div className='dropdown-menu'>
              <a href="#" onClick={handleLogout} className='dropdown-item'>
                <LogoutButton />
              </a>
            </div>
          )}
        </div>
      </div>
    </header>
  );
}

export default Header;