import React, { useState } from "react";
import { Link } from "react-router-dom";

export default function NavLinks() {
  const [openPages, setOpenPages] = useState(false);

  return (
    <div  className="navbar">
    <ul>
      <Link to="/"><li>Home</li></Link>
      <Link to="/shop"><li>Shop</li></Link>
      <Link to="/aboutus"><li>About Us</li></Link>
      <Link to="/blog"><li>Blog</li></Link>
      <Link to="/contact"><li>Contact</li></Link>
      <Link to="/traconorder"><li>Track On Order</li></Link>
    </ul>
    </div>
  );
}