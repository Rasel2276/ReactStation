
import { useState } from 'react';
import { useLocation } from 'react-router-dom';
import './Style.css';
import Header from './layoutcomponents/Header.jsx';
import Sidebar from './layoutcomponents/Sidebar.jsx';
import Home from './layoutcomponents/Home.jsx';

function AdminDashboard() {
  const [openSidebarToggle, setOpenSidebarToggle] = useState(true);

    const location = useLocation();
  const user = location.state?.user || { name: 'Admin' };

  const toggleSidebar = () => {
    setOpenSidebarToggle(!openSidebarToggle);
  };

  return (
    <div className='grid-container'>
      <Header OpenSidebar={toggleSidebar} user={user} />
      <Sidebar openSidebarToggle={openSidebarToggle} user={user} />
      <Home user={user} />
    </div>
  );
}

export default AdminDashboard;


