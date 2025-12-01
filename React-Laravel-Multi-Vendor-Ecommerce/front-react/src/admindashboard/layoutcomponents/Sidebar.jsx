import React, { useState } from 'react';
import { Link } from 'react-router-dom';
import { 
  BsGrid1X2Fill, BsFillArchiveFill, BsFillGrid3X3GapFill, 
  BsPeopleFill, BsListCheck, BsMenuButtonWideFill, BsFillGearFill, BsChevronDown 
} from 'react-icons/bs';
import { BiCategory,BiCategoryAlt } from "react-icons/bi";

function Sidebar({ openSidebarToggle, user }) {
  const [productsOpen, setProductsOpen] = useState(false);
  const toggleProducts = () => setProductsOpen(!productsOpen);

  const [categoryOpen, setCategoryOpen] = useState(false);
  const toggleCategory = () => setCategoryOpen(!categoryOpen);

  const [sub_categoryOpen, setSub_CategoryOpen] = useState(false);
  const toggleSub_Category = () => setSub_CategoryOpen(!sub_categoryOpen);

  return (
    <aside id="sidebar" className={openSidebarToggle ? '' : 'sidebar-hidden'}> 

      {/* 🔵 Sidebar Top Profile Box (image + name) */}
      <div className="sidebar-top-box">
        <div className="sidebar-profile-img">
          <img src="/profile.jpg" alt="Profile" />
        </div>
        
        <div className="sidebar-profile-name">{user?.name || 'Admin'}</div>
      </div>

      <ul className='sidebar-list'>
        <li className='sidebar-list-item'>
          <Link to="/admin">
            <BsGrid1X2Fill className='icon' id="side-icon" /> Dashboard
          </Link>
        </li>

        <li className='sidebar-list-item'>
          <div className='dropdown-header' onClick={toggleCategory}>
            <BiCategory className='icon' id="side-icon" /> Category
            <BsChevronDown className={`icon-right ${categoryOpen ? 'rotate' : ''}`} />
          </div>
          {categoryOpen && (
            <ul className='dropdown-list'>
              <li><a href="#">Add Category</a></li>
              <li><a href="#">Manage Category</a></li>
            </ul>
          )}
        </li>

        <li className='sidebar-list-item'>
          <div className='dropdown-header' onClick={toggleSub_Category}>
            <BiCategoryAlt className='icon' id="side-icon" /> Sub-Category
            <BsChevronDown className={`icon-right ${sub_categoryOpen ? 'rotate' : ''}`} />
          </div>
          {sub_categoryOpen && (
            <ul className='dropdown-list'>
              <li><a href="#">Add Category</a></li>
              <li><a href="#">Manage Category</a></li>
            </ul>
          )}
        </li>

        <li className='sidebar-list-item'>
          <div className='dropdown-header' onClick={toggleProducts}>
            <BsFillArchiveFill className='icon' id="side-icon" /> Products
            <BsChevronDown className={`icon-right ${productsOpen ? 'rotate' : ''}`} />
          </div>
          {productsOpen && (
            <ul className='dropdown-list'>
              <li><Link to="/admin/addporduct">Add Product</Link></li>
              <li><a href="#">All Products</a></li>
              <li><a href="#">Featured Products</a></li>
            </ul>
          )}
        </li>

        <li className='sidebar-list-item'>
          <a href="#">
            <BsFillGrid3X3GapFill className='icon' id="side-icon" /> Categories
          </a>
        </li>
        <li className='sidebar-list-item'>
          <a href="#">
            <BsPeopleFill className='icon' id="side-icon" /> Customers
          </a>
        </li>
        <li className='sidebar-list-item'>
          <a href="#">
            <BsListCheck className='icon' id="side-icon" /> Inventory
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
