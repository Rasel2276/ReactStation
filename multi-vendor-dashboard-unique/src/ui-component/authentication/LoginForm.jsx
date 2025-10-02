import React, { useState } from 'react';

const LoginForm = ({ onClose }) => {
  const [formData, setFormData] = useState({
    email: '',
    password: '',
    rememberMe: false,
  });

  const handleChange = (e) => {
    const { name, value, type, checked } = e.target;
    setFormData((prevData) => ({
      ...prevData,
      [name]: type === 'checkbox' ? checked : value,
    }));
  };

  const handleSubmit = (e) => {
    e.preventDefault();
    console.log('Login Submitted!', formData);

    if (!formData.email || !formData.password) {
      alert("Please enter email and password.");
      return;
    }

    // Backend API call kora jete pare ekhane
    alert("Login submitted successfully (frontend simulation)!");
    // Submit korar por popup close korte chaile uncomment koro
    // onClose();
  };

  return (
    <div
      style={{
        position: "fixed",
        top: 0,
        left: 0,
        width: "100vw",
        height: "100vh",
        backgroundColor: "rgba(0,0,0,0.5)",
        display: "flex",
        justifyContent: "center",
        alignItems: "center",
        zIndex: 1000,
      }}
    >
      <div
        style={{
          background: "#fff",
          padding: "30px",
          borderRadius: "8px",
          minWidth: "350px",
          position: "relative",
        }}
      >
        {/* Close button */}
        <button
          onClick={onClose}
          style={{
            position: "absolute",
            top: 10,
            right: 10,
            background: "red",
            color: "#fff",
            border: "none",
            borderRadius: "5px",
            padding: "5px 10px",
            cursor: "pointer"
          }}
        >
          X
        </button>

        {/* Form Header */}
        <div className="login-header" style={{ marginBottom: "20px" }}>
          <span className="header-icon">🔐</span>
          <h2>Login to your account</h2>
          <p style={{ fontSize: "14px", color: "#555" }}>
            Enter your email and password to access your account.
          </p>
        </div>

        {/* Login Form */}
        <form onSubmit={handleSubmit} className="login-form">
          {/* Email */}
          <div className="form-group">
            <label htmlFor="email">Email *</label>
            <div className="input-with-icon">
              <span>✉️</span>
              <input
                type="email"
                id="email"
                name="email"
                value={formData.email}
                onChange={handleChange}
                placeholder="Your email"
                required
              />
            </div>
          </div>

          {/* Password */}
          <div className="form-group">
            <label htmlFor="password">Password *</label>
            <div className="input-with-icon">
              <span>🔒</span>
              <input
                type="password"
                id="password"
                name="password"
                value={formData.password}
                onChange={handleChange}
                placeholder="Password"
                required
              />
              <span className="password-toggle">👁️</span>
            </div>
          </div>

          {/* Remember Me */}
          <div className="form-group checkbox-group">
            <label>
              <input
                type="checkbox"
                name="rememberMe"
                checked={formData.rememberMe}
                onChange={handleChange}
              /> Remember me
            </label>
          </div>

          {/* Submit button */}
          <button type="submit" className="login-button" style={{ marginTop: "10px", padding: "8px 15px", cursor: "pointer" }}>
            Login →
          </button>
        </form>

        {/* Register Link */}
        <div className="register-link" style={{ marginTop: "15px", fontSize: "14px" }}>
          Don't have an account? <a href="#register">Register</a>
        </div>
      </div>
    </div>
  );
};

export default LoginForm;
