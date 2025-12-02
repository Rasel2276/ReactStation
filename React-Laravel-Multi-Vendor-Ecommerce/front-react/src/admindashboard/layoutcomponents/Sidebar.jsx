import React, { useState } from 'react';
import { Link } from 'react-router-dom';
import { 
  BsGrid1X2Fill, BsFillArchiveFill,BsChatLeftTextFill,
  BsMenuButtonWideFill, BsFillGearFill, BsChevronDown 
} from 'react-icons/bs';
import { BiCategory,BiCategoryAlt,BiSolidPurchaseTag } from "react-icons/bi";
import { FaTruck } from "react-icons/fa";
import { RiDiscountPercentLine } from "react-icons/ri";
import { TbReportSearch } from "react-icons/tb";

function Sidebar({ openSidebarToggle, user }) {

  const [categoryOpen, setCategoryOpen] = useState(false);
  const toggleCategory = () => setCategoryOpen(!categoryOpen);

  const [sub_categoryOpen, setSub_CategoryOpen] = useState(false);
  const toggleSub_Category = () => setSub_CategoryOpen(!sub_categoryOpen);

  const [supplierOpen, setSupplier] = useState(false);
  const toggleSupplier = () => setSupplier(!supplierOpen);

  const [productsOpen, setProductsOpen] = useState(false);
  const toggleProducts = () => setProductsOpen(!productsOpen);

  const [vendorhubOpen, setVendorHubOpen] = useState(false);
  const toggleVendorHub = () => setVendorHubOpen(!vendorhubOpen);

  const [promotionsOpen, setPromotionsOpen] = useState(false);
  const togglePromotions = () => setPromotionsOpen(!promotionsOpen);

  const [reportsOpen, setReportsOpen] = useState(false);
  const toggleReports = () => setReportsOpen(!reportsOpen);

  return (
    <aside id="sidebar" className={openSidebarToggle ? '' : 'sidebar-hidden'}> 

      {/* 🔵 Sidebar Top Profile Box (image + name) */}
      <div className="sidebar-top-box">
        <div className="sidebar-profile-img">
          <img src="/profile.jpg" alt="Profile" />
        </div>
        
        <div className="sidebar-profile-name">{user?.name || 'Admin'}
          <div className="sidebar-role"><p>{user?.role || 'Admin'}</p></div>
        </div>
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
          <div className='dropdown-header' onClick={toggleSupplier}>
            <FaTruck className='icon' id="side-icon" /> Supplier
            <BsChevronDown className={`icon-right ${supplierOpen ? 'rotate' : ''}`} />
          </div>
          {supplierOpen && (
            <ul className='dropdown-list'>
              <li><a href="#">Add Supplier</a></li>
              <li><a href="#">Manage Supplier</a></li>
              <li><a href="#">Supplier Product</a></li>
              <li><a href="#">Manage Product</a></li>
            </ul>
          )}
        </li>

        <li className='sidebar-list-item'>
          <div className='dropdown-header' onClick={toggleProducts}>
            <BsFillArchiveFill className='icon' id="side-icon" /> Inventory
            <BsChevronDown className={`icon-right ${productsOpen ? 'rotate' : ''}`} />
          </div>
          {productsOpen && (
            <ul className='dropdown-list'>
              <li><Link to="/admin/addporduct">Purchase Product</Link></li>
              <li><a href="#">Purchase Record</a></li>
              <li><a href="#">Purchase Return</a></li>
              <li><a href="#">MyStock</a></li>
            </ul>
          )}
        </li>

        <li className='sidebar-list-item'>
          <div className='dropdown-header' onClick={toggleVendorHub}>
            <BiSolidPurchaseTag className='icon' id="side-icon" /> Vendor Hub
            <BsChevronDown className={`icon-right ${vendorhubOpen ? 'rotate' : ''}`} />
          </div>
          {vendorhubOpen && (
            <ul className='dropdown-list'>
              <li><Link to="/admin/addporduct">Sales Request</Link></li>
              <li><a href="#">Sales</a></li>
              <li><a href="#">Sales Return Request</a></li>
              <li><a href="#">Sales Return</a></li>
            </ul>
          )}
        </li>

        <li className='sidebar-list-item'>
          <div className='dropdown-header' onClick={togglePromotions}>
            <RiDiscountPercentLine className='icon' id="side-icon" /> Promotions
            <BsChevronDown className={`icon-right ${promotionsOpen ? 'rotate' : ''}`} />
          </div>
          {promotionsOpen && (
            <ul className='dropdown-list'>
              <li><a href="#">Coupon</a></li>
              <li><a href="#">Discount</a></li>
              <li><a href="#">Offer</a></li>
            </ul>
          )}
        </li>
        

        <li className='sidebar-list-item'>
          <div className='dropdown-header' onClick={toggleReports}>
            <TbReportSearch className='icon' id="side-icon" /> Reports
            <BsChevronDown className={`icon-right ${reportsOpen ? 'rotate' : ''}`} />
          </div>
          {reportsOpen && (
            <ul className='dropdown-list'>
              <li><a href="#">Total Purchase</a></li>
              <li><a href="#">Total Sales</a></li>
              <li><a href="#">Income Statement</a></li>
            </ul>
          )}
        </li>

        <li className='sidebar-list-item'>
          <a href="#">
            <BsChatLeftTextFill className='icon' id="side-icon" /> Chats
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
