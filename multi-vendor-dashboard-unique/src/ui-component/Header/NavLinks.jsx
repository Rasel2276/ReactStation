import React, { useState } from "react";

export default function NavLinks() {
  const [openPages, setOpenPages] = useState(false);

  return (
    <ul className="nav-links">
      <li>Home</li>
      <li>Shop</li>
      <li>Contact</li>
      <li>About Us</li>
      <li>Blog</li>
      <li>Track your order</li>
    </ul>
  );
}