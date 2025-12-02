import React, { useState } from 'react';
import { 
  BsGrid1X2Fill, BsFillArchiveFill, BsFillGrid3X3GapFill, 
  BsChatLeftTextFill, BsFillGearFill, BsChevronDown 
} from 'react-icons/bs';
import { RiDiscountPercentLine } from "react-icons/ri";
import { CgProfile } from "react-icons/cg";
import { FaBorderAll,FaStore } from "react-icons/fa";
import { TbReportSearch } from "react-icons/tb";

function Sidebar({ openSidebarToggle, user }) {
  const [inventoryOpen, setInventoryOpen] = useState(false);
  const toggleInventory = () => setInventoryOpen(!inventoryOpen);

  const [productOpen, setProductOpen] = useState(false);
  const toggleProduct = () => setProductOpen(!productOpen);

  const [customerhubOpen, setCustomerHubOpen] = useState(false);
  const toggleCustomerHub = () => setCustomerHubOpen(!customerhubOpen);

  const [storeOpen, setStoreOpen] = useState(false);
  const toggleStore = () => setStoreOpen(!storeOpen);

  const [reportsOpen, setReportsOpen] = useState(false);
  const toggleReports = () => setReportsOpen(!reportsOpen);

  const [promotionsOpen, setPromotionsOpen] = useState(false);
  const togglePromotions = () => setPromotionsOpen(!promotionsOpen);

  const [chatsOpen, setChatsOpen] = useState(false);
  const toggleChats = () => setChatsOpen(!chatsOpen);

  return (
    <aside id="sidebar" className={openSidebarToggle ? '' : 'sidebar-hidden'}>

      
      <div className="sidebar-top-box">
        <div className="sidebar-profile-img">
          <img src="/profile.jpg" alt="Profile" />
        </div>
        
        <div className="sidebar-profile-name">{user?.name || 'Vendor'}
          <div className="sidebar-role"><p>{user?.role || 'Vendor'}</p></div>
        </div>
      </div>

      <ul className='sidebar-list'>
        <li className='sidebar-list-item'>
          <a href="#">
            <BsGrid1X2Fill className='icon' id="side-icon" /> Dashboard
          </a>
        </li>

        <li className='sidebar-list-item'>
          <div className='dropdown-header' onClick={toggleInventory}>
            <BsFillArchiveFill className='icon' id="side-icon" /> Inventory
            <BsChevronDown className={`icon-right ${inventoryOpen ? 'rotate' : ''}`} />
          </div>
          {inventoryOpen && (
            <ul className='dropdown-list'>
              <li><a href="#">Purchase</a></li>
              <li><a href="#">Purchase Record</a></li>
              <li><a href="#">Purchase Return</a></li>
              <li><a href="#">Return Record</a></li>
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
          <a href="#">
            <BsFillGrid3X3GapFill className='icon' id="side-icon" /> Admin Stock List
          </a>
        </li>

        <li className='sidebar-list-item'>
          <div className='dropdown-header' onClick={toggleProduct}>
            <BsFillArchiveFill className='icon' id="side-icon" /> Product
            <BsChevronDown className={`icon-right ${productOpen ? 'rotate' : ''}`} />
          </div>
          {productOpen && (
            <ul className='dropdown-list'>
              <li><a href="#">MyStock</a></li>
              <li><a href="#">Add Poroduct</a></li>
              <li><a href="#">Manage Product</a></li>
            </ul>
          )}
        </li>

        <li className='sidebar-list-item'>
          <div className='dropdown-header' onClick={toggleCustomerHub}>
            <FaBorderAll className='icon' id="side-icon" /> Customer Hub
            <BsChevronDown className={`icon-right ${customerhubOpen ? 'rotate' : ''}`} />
          </div>
          {customerhubOpen && (
            <ul className='dropdown-list'>
              <li><a href="#">Customer Order</a></li>
              <li><a href="#">Customer Order Items</a></li>
              <li><a href="#">Customer Information</a></li>
              <li><a href="#">Customer Return</a></li>
              <li><a href="#">Return Record</a></li>
            </ul>
          )}
        </li>

        <li className='sidebar-list-item'>
          <div className='dropdown-header' onClick={toggleStore}>
            <FaStore className='icon' id="side-icon" /> Store
            <BsChevronDown className={`icon-right ${storeOpen ? 'rotate' : ''}`} />
          </div>
          {storeOpen && (
            <ul className='dropdown-list'>
              <li><a href="#">Create Store</a></li>
              <li><a href="#">Manage Store</a></li>
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
          <div className='dropdown-header' onClick={toggleChats}>
            <BsChatLeftTextFill className='icon' id="side-icon" /> Chats
            <BsChevronDown className={`icon-right ${chatsOpen ? 'rotate' : ''}`} />
          </div>
          {chatsOpen && (
            <ul className='dropdown-list'>
              <li><a href="#">Chat with Admin</a></li>
              <li><a href="#">Chat with Customer</a></li>
            </ul>
          )}
        </li>

        <li className='sidebar-list-item'>
          <a href="#">
            <CgProfile className='icon' id="side-icon" /> Profile
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
