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
        <div className="top-section-customize">
        <div className="logo-customize">
          <Logo />
        </div>
        <div className="navbar-customize">
          <NavLinks />
        </div>
          <div className="icon-customize">
            <Icons />
          </div>
          <div className="usermenu-customize">
            <UserMenu
              onRegisterClick={onRegisterClick}
              onLoginClick={onLoginClick}
            />
          </div>
        </div>
      </div>
      {/* <nav className="nav-bar">
        <SearchBar />
      </nav> */}
    </header>
  );
}
