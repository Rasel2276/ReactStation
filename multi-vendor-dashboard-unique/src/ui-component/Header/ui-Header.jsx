import React from "react";
import Logo from "./Logo";
import SearchBar from "./SearchBar";
import NavLinks from "./NavLinks";
import Icons from "./Icons";
import UserMenu from "./UserMenu";

export default function UiHeader({ onRegisterClick, onLoginClick }) {
  return (
    <header className="header">
      <div className="top-bar">
        <Logo />
        
        <SearchBar />
        <Icons />
        <UserMenu 
          onRegisterClick={onRegisterClick} 
          onLoginClick={onLoginClick}
        />
      </div>
      <nav className="nav-bar">
        <NavLinks />
      </nav>
    </header>
  );
}
