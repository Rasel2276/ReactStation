import React from "react";
import { FaUser } from "react-icons/fa";

export default function UserMenu({ onRegisterClick, onLoginClick }) {
  return (
    <div className="user-menu">
      <FaUser className="FaUser-log-Reg" />
      <div>
        <p className="user-auth" style={{ cursor: "pointer" }} onClick={onLoginClick}>Login</p>
        <p className="user-auth" style={{ cursor: "pointer" }} onClick={onRegisterClick}>Register</p>
      </div>
    </div>
  );
}

