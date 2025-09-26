import React, { useState } from "react";

function SellerProfile() {
  const [profile, setProfile] = useState({
    name: "John Seller",
    email: "johnseller@example.com",
    phone: "017XXXXXXXX",
    address: "Dhaka, Bangladesh",
    password: "********",
    image: "https://via.placeholder.com/100", // default image
  });

  const [isEditing, setIsEditing] = useState(false);
  const [showProfile, setShowProfile] = useState(false);

  const handleChange = (e) => {
    const { name, value } = e.target;
    setProfile({ ...profile, [name]: value });
  };

  const handleImageChange = (e) => {
    const file = e.target.files[0];
    if (file) {
      setProfile({ ...profile, image: URL.createObjectURL(file) });
    }
  };

  const handleSave = () => {
    setIsEditing(false);
    alert("Profile updated successfully!");
  };

  return (
    <div
      style={{
        maxWidth: "600px",
        margin: "20px auto",
        border: "1px solid #444",
        borderRadius: "8px",
        backgroundColor: "#213247",
        color: "#cbdcea",
        padding: "20px",
      }}
    >
      <h2 style={{ marginBottom: "20px" }}>Seller Profile</h2>

      {/* Profile Image */}
      <div style={{ marginBottom: "15px", textAlign: "center" }}>
        <img
          src={profile.image}
          alt="Profile"
          style={{ width: "100px", height: "100px", borderRadius: "50%", marginBottom: "10px" }}
        />
        {isEditing && (
          <input type="file" accept="image/*" onChange={handleImageChange} />
        )}
      </div>

      {/* Profile Fields */}
      <div style={{ marginBottom: "15px" }}>
        <label>Name:</label>
        <input
          type="text"
          name="name"
          value={profile.name}
          onChange={handleChange}
          disabled={!isEditing}
          style={inputStyle}
        />
      </div>

      <div style={{ marginBottom: "15px" }}>
        <label>Email:</label>
        <input
          type="email"
          name="email"
          value={profile.email}
          onChange={handleChange}
          disabled={!isEditing}
          style={inputStyle}
        />
      </div>

      <div style={{ marginBottom: "15px" }}>
        <label>Phone:</label>
        <input
          type="text"
          name="phone"
          value={profile.phone}
          onChange={handleChange}
          disabled={!isEditing}
          style={inputStyle}
        />
      </div>

      <div style={{ marginBottom: "15px" }}>
        <label>Address:</label>
        <input
          type="text"
          name="address"
          value={profile.address}
          onChange={handleChange}
          disabled={!isEditing}
          style={inputStyle}
        />
      </div>

      <div style={{ marginBottom: "15px" }}>
        <label>Password:</label>
        <input
          type="password"
          name="password"
          value={profile.password}
          onChange={handleChange}
          disabled={!isEditing}
          style={inputStyle}
        />
      </div>

      {/* Buttons */}
      <div style={{ marginTop: "20px", display: "flex", gap: "10px" }}>
        {isEditing ? (
          <button onClick={handleSave} style={saveButtonStyle}>
            Save
          </button>
        ) : (
          <button onClick={() => setIsEditing(true)} style={editButtonStyle}>
            Edit Profile
          </button>
        )}
        <button onClick={() => setShowProfile(true)} style={viewButtonStyle}>
          View Full Profile
        </button>
      </div>

      {/* Modal for Full Profile */}
      {showProfile && (
        <div style={modalOverlay}>
          <div style={modalContent}>
            <h3>Full Seller Profile</h3>
            <img
              src={profile.image}
              alt="Profile"
              style={{ width: "120px", height: "120px", borderRadius: "50%", margin: "10px auto" }}
            />
            <p><strong>Name:</strong> {profile.name}</p>
            <p><strong>Email:</strong> {profile.email}</p>
            <p><strong>Phone:</strong> {profile.phone}</p>
            <p><strong>Address:</strong> {profile.address}</p>
            <p><strong>Password:</strong> {profile.password}</p>
            <button onClick={() => setShowProfile(false)} style={closeButtonStyle}>
              Close
            </button>
          </div>
        </div>
      )}
    </div>
  );
}

// Styles
const inputStyle = {
  width: "100%",
  padding: "8px",
  marginTop: "5px",
  borderRadius: "5px",
  border: "1px solid #444",
  backgroundColor: "#0f172a",
  color: "#cbdcea",
};

const editButtonStyle = {
  padding: "8px 15px",
  border: "none",
  borderRadius: "5px",
  backgroundColor: "#2563eb",
  color: "#fff",
  cursor: "pointer",
};

const saveButtonStyle = {
  padding: "8px 15px",
  border: "none",
  borderRadius: "5px",
  backgroundColor: "#16a34a",
  color: "#fff",
  cursor: "pointer",
};

const viewButtonStyle = {
  padding: "8px 15px",
  border: "none",
  borderRadius: "5px",
  backgroundColor: "#facc15",
  color: "#000",
  cursor: "pointer",
};

const modalOverlay = {
  position: "fixed",
  top: 0,
  left: 0,
  right: 0,
  bottom: 0,
  backgroundColor: "rgba(0,0,0,0.6)",
  display: "flex",
  justifyContent: "center",
  alignItems: "center",
};

const modalContent = {
  backgroundColor: "#213247",
  color: "#cbdcea",
  padding: "20px",
  borderRadius: "10px",
  width: "400px",
  textAlign: "center",
};

const closeButtonStyle = {
  marginTop: "15px",
  padding: "8px 15px",
  backgroundColor: "#ef4444",
  border: "none",
  borderRadius: "5px",
  color: "#fff",
  cursor: "pointer",
};

export default SellerProfile;
