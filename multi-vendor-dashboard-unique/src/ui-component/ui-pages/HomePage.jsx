import React from "react";
import UiHeader from "../Header/ui-Header";

export default function HomePage({ onRegisterClick, onLoginClick }) {
  return (
    <div>
      <UiHeader 
        onRegisterClick={onRegisterClick} 
        onLoginClick={onLoginClick} 
      />
      <main style={{ padding: "40px", textAlign: "center" }}>
        <h1>Welcome to E-Commerce</h1>
        <p>This is the landing page with UiHeader at the top.</p>
      </main>
    </div>
  );
}

