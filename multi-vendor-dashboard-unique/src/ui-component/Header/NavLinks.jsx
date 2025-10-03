import React, { useState } from "react";
import { Link } from "react-router-dom";

export default function NavLinks() {
  const [openPages, setOpenPages] = useState(false);

  return (
    <ul className="nav-links">
      <Link to="/">Home</Link>
      <Link to="/shop">Shop</Link>
      <Link to="/aboutus">About Us</Link>
      <Link to="/blog">Blog</Link>
      <Link to="/contact">Contact</Link>
      <Link to="/traconorder">Track On Order</Link>
    </ul>
  );
}