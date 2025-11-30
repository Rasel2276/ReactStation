import React, { useState } from 'react';
import { 
  BsGrid1X2Fill, BsFillArchiveFill, BsFillGrid3X3GapFill, 
  BsPeopleFill, BsListCheck, BsMenuButtonWideFill, BsFillGearFill, BsChevronDown 
} from 'react-icons/bs';

function Sidebar({ openSidebarToggle, user }) {
  const [productsOpen, setProductsOpen] = useState(false);
  const toggleProducts = () => setProductsOpen(!productsOpen);

  return (
    <aside id="sidebar" className={openSidebarToggle ? '' : 'sidebar-hidden'}> 

      {/* 🔵 Sidebar Top Profile Box (image + name) */}
      <div className="sidebar-top-box">
        <div className="sidebar-profile-img">
          <img src="/profile.jpg" alt="Profile" />
        </div>
        
        <div className="sidebar-profile-name">{user?.name || 'Customer'}</div>
      </div>

      <ul className='sidebar-list'>
        <li className='sidebar-list-item'>
          <a href="#">
            <BsGrid1X2Fill className='icon' /> Dashboard
          </a>
        </li>

        <li className='sidebar-list-item'>
          <div className='dropdown-header' onClick={toggleProducts}>
            <BsFillArchiveFill className='icon' /> Products
            <BsChevronDown className={`icon-right ${productsOpen ? 'rotate' : ''}`} />
          </div>
          {productsOpen && (
            <ul className='dropdown-list'>
              <li><a href="#">Add Product</a></li>
              <li><a href="#">All Products</a></li>
              <li><a href="#">Featured Products</a></li>
            </ul>
          )}
        </li>

        <li className='sidebar-list-item'>
          <a href="#">
            <BsFillGrid3X3GapFill className='icon' /> Categories
          </a>
        </li>
        <li className='sidebar-list-item'>
          <a href="#">
            <BsPeopleFill className='icon' /> Customers
          </a>
        </li>
        <li className='sidebar-list-item'>
          <a href="#">
            <BsListCheck className='icon' /> Inventory
          </a>
        </li>
        <li className='sidebar-list-item'>
          <a href="#">
            <BsMenuButtonWideFill className='icon' /> Reports
          </a>
        </li>
        <li className='sidebar-list-item'>
          <a href="#">
            <BsFillGearFill className='icon' /> Setting
          </a>
        </li>
      </ul>
    </aside>
  );
}

export default Sidebar;
