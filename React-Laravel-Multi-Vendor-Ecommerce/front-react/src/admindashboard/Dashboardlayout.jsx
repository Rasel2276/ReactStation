import { useState } from 'react';
import './Style.css';
import Header from './layoutcomponents/Header.jsx';
import Sidebar from './layoutcomponents/Sidebar.jsx';
import Home from './layoutcomponents/Home.jsx';

function Dashboardlayout() {
  const [openSidebarToggle, setOpenSidebarToggle] = useState(true);

  const toggleSidebar = () => {
    setOpenSidebarToggle(!openSidebarToggle);
  };

  return (
    <div className='grid-container'>
      <Header toggleSidebar={toggleSidebar} />
      <Sidebar openSidebarToggle={openSidebarToggle} />
      <Home />
    </div>
  );
}

export default Dashboardlayout;
