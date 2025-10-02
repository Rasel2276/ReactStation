import React, { useState } from 'react';

const RegistrationForm = ({ onClose }) => {
  const [formData, setFormData] = useState({
    fullName: '',
    email: '',
    phone: '',
    password: '',
    confirmPassword: '',
    registerAs: 'customer', // Default value
    agreeToTerms: false,
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
    console.log('Form Submitted!', formData);

    if (formData.password !== formData.confirmPassword) {
      alert("Passwords do not match!");
      return;
    }
    if (!formData.agreeToTerms) {
      alert("You must agree to the Terms and Privacy Policy.");
      return;
    }

    // Backend API call kora jete pare ekhane
    alert("Registration form submitted successfully (frontend simulation)!");
    // Submit korar por form close korte chaile uncomment koro
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
          maxHeight: "90vh",
          overflowY: "auto"
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
        <div className="registration-header" style={{ marginBottom: "20px" }}>
          <span className="header-icon">👤</span>
          <h2>Register an account</h2>
          <p style={{ fontSize: "14px", color: "#555" }}>
            Your personal data will be used to support your experience throughout this website, to manage access to your account.
          </p>
        </div>

        {/* Registration Form */}
        <form onSubmit={handleSubmit} className="registration-form">
          {/* Full Name */}
          <div className="form-group">
            <label htmlFor="fullName">Full name *</label>
            <div className="input-with-icon">
              <span>👤</span>
              <input
                type="text"
                id="fullName"
                name="fullName"
                value={formData.fullName}
                onChange={handleChange}
                placeholder="Your full name"
                required
              />
            </div>
          </div>

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

          {/* Phone */}
          <div className="form-group">
            <label htmlFor="phone">Phone (optional)</label>
            <div className="input-with-icon">
              <span>📞</span>
              <input
                type="tel"
                id="phone"
                name="phone"
                value={formData.phone}
                onChange={handleChange}
                placeholder="Phone number"
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

          {/* Confirm Password */}
          <div className="form-group">
            <label htmlFor="confirmPassword">Password confirmation *</label>
            <div className="input-with-icon">
              <span>🔒</span>
              <input
                type="password"
                id="confirmPassword"
                name="confirmPassword"
                value={formData.confirmPassword}
                onChange={handleChange}
                placeholder="Password confirmation"
                required
              />
              <span className="password-toggle">👁️</span>
            </div>
          </div>

          {/* Register as */}
          <div className="form-group">
            <label className="register-as-label">Register as</label>
            <div className="radio-group">
              <label>
                <input
                  type="radio"
                  name="registerAs"
                  value="customer"
                  checked={formData.registerAs === 'customer'}
                  onChange={handleChange}
                /> I am a customer
              </label>
              <label>
                <input
                  type="radio"
                  name="registerAs"
                  value="vendor"
                  checked={formData.registerAs === 'vendor'}
                  onChange={handleChange}
                /> I am a vendor
              </label>
            </div>
          </div>

          {/* Agree to terms */}
          <div className="form-group checkbox-group">
            <label>
              <input
                type="checkbox"
                name="agreeToTerms"
                checked={formData.agreeToTerms}
                onChange={handleChange}
                required
              /> I agree to the <a href="#terms">Terms</a> and <a href="#privacy">Privacy Policy</a>
            </label>
          </div>

          {/* Submit button */}
          <button type="submit" className="register-button" style={{ marginTop: "10px", padding: "8px 15px", cursor: "pointer" }}>
            Register →
          </button>
        </form>

        {/* Login Link */}
        <div className="login-link" style={{ marginTop: "15px", fontSize: "14px" }}>
          Already have an account? <a href="/login">Login</a>
        </div>
      </div>
    </div>
  );
};

export default RegistrationForm;
