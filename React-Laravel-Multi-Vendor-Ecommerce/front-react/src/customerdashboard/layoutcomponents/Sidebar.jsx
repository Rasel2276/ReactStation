import React, { useState } from 'react';
import { 
  BsGrid1X2Fill, BsChatLeftTextFill, 
  BsMenuButtonWideFill, BsFillGearFill, BsChevronDown 
} from 'react-icons/bs';
import { VscAccount } from "react-icons/vsc";
import { MdBorderColor } from "react-icons/md";

function Sidebar({ openSidebarToggle, user }) {
  const [productsOpen, setProductsOpen] = useState(false);
  const toggleProducts = () => setProductsOpen(!productsOpen);

  return (
    <aside id="sidebar_customer" className={openSidebarToggle ? '' : 'sidebar-hidden'}>

  
      <div className="sidebar-top-box">
        <div className="sidebar-profile-img">
          <img src="/profile.jpg" alt="Profile" />
        </div>
        
        <div className="sidebar-profile-name">{user?.name || 'Customer'}
          <div className="sidebar-role"><p>{user?.role || 'Customer'}</p></div>
        </div>
      </div>

      <ul className='sidebar-list'>
        <li className='sidebar-list-item'>
          <a href="#">
            <BsGrid1X2Fill className='icon' id="side-icon" /> Dashboard
          </a>
        </li>

        <li className='sidebar-list-item'>
          <div className='dropdown-header' onClick={toggleProducts}>
            <VscAccount className='icon' id="side-icon" /> Account Info
            <BsChevronDown className={`icon-right ${productsOpen ? 'rotate' : ''}`} />
          </div>
          {productsOpen && (
            <ul className='dropdown-list'>
              <li><a href="#">My Porfile</a></li>
              <li><a href="#">Manage Profile</a></li>
            </ul>
          )}
        </li>

        <li className='sidebar-list-item'>
          <a href="#">
            <MdBorderColor className='icon' id="side-icon" /> My Orders
          </a>
        </li>
        <li className='sidebar-list-item'>
          <a href="#">
            <BsChatLeftTextFill className='icon' id="side-icon" /> Chats
          </a>
        </li>

        <li className='sidebar-list-item'>
          <a href="#">
            <BsMenuButtonWideFill className='icon' id="side-icon" /> Reports
          </a>
        </li>
        <li className='sidebar-list-item'>
          <a href="#">
            <BsFillGearFill className='icon' id="side-icon" /> Setting
          </a>
        </li>
      </ul>
    </aside>
  );
}

export default Sidebar;
