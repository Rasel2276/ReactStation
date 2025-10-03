import React from "react";
import UiHeader from "../Header/ui-Header";

export default function HomePage({ onRegisterClick, onLoginClick }) {
  return (
    <div>
      <UiHeader 
        onRegisterClick={onRegisterClick} 
        onLoginClick={onLoginClick} 
      />
    </div>
  );
}

