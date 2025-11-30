import React, { useState } from 'react';
import { useNavigate } from 'react-router-dom';
import LogoutButton from '../../auth/LogoutButton';

import { 
  BsFillBellFill, 
  BsFillEnvelopeFill, 
  BsPersonCircle, 
  BsSearch, 
  BsJustify 
} from 'react-icons/bs';

function Header({ OpenSidebar }) {

  const [isDropdownOpen, setIsDropdownOpen] = useState(false);
  const navigate = useNavigate();

  const toggleDropdown = () => {
    setIsDropdownOpen(prev => !prev);
  };

  const handleLogout = () => {
    
    localStorage.clear();
    sessionStorage.clear();

    
    setIsDropdownOpen(false);

   
    navigate('/');   
  };

  return (
    <header className='header'>
      <div className='menu-icon'>
        <BsJustify className='icon' onClick={OpenSidebar} />
      </div>

      <div className='header-left'>
        <BsSearch className='icon' />
      </div>

      <div className='header-right'>
        <BsFillBellFill className='icon' id="header-icon" />
        <BsFillEnvelopeFill className='icon' id="header-icon" />

        <div className='dropdown-container'>

          <BsPersonCircle 
            className='icon dropdown-toggle' 
            onClick={toggleDropdown}
            id="header-icon"
          />

          {isDropdownOpen && (
            <div className='dropdown-menu'>

              {/* UI menu */}
              <div className='dropdown-item' onClick={() => navigate('#')}>
                Website
              </div>

              {/* Logout menu */}
              <div className='dropdown-item' onClick={handleLogout}>
                <LogoutButton />
              </div>

            </div>
          )}
          
        </div>
      </div>
    </header>
  );
}

export default Header;
