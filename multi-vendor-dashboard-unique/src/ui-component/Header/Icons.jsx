import React from "react";
import { FaHeart, FaShoppingBag } from "react-icons/fa";

export default function Icons() {
  return (
    <div className="icons">
      <div className="icon-1">
        <FaHeart />
        <span className="badge">0</span>
      </div>
      <div className="icon-1">
        <FaShoppingBag />
        <span className="badge">1</span>
      </div>
    </div>
  );
}