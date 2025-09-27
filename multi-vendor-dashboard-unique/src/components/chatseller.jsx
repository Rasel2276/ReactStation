import React, { useState } from "react";

function ChatSeller() {
  const [selectedSeller, setSelectedSeller] = useState(null);
  const [messages, setMessages] = useState([]);
  const [newMessage, setNewMessage] = useState("");

  const sellers = [
    { id: 1, name: "Ali", email: "ali@shop.com" },
    { id: 2, name: "Sara", email: "sara@shop.com" },
    { id: 3, name: "Rana", email: "rana@shop.com" },
  ];

  const handleSend = () => {
    if (newMessage.trim() && selectedSeller) {
      setMessages((prev) => [
        ...prev,
        { seller: selectedSeller.name, text: newMessage, time: new Date().toLocaleTimeString() },
      ]);
      setNewMessage("");
    }
  };
  
  return (
  <div>
      <h2 style={{ marginLeft: "30px", color: "#cbdcea" }}>Talk to Seller</h2>
    <div style={{ display: "flex", height: "75vh", backgroundColor: "#213247", color: "#cbdcea", borderRadius: "8px", overflow: "hidden",margin:"20px" }}>
      
      {/* Left Side: Seller List */}
      <div style={{ width: "20%", borderRight: "1px solid #444", padding: "10px",marginLeft:"20px" }}>
        <h3>Seller List</h3>
        <ul style={{ listStyle: "none", padding: 0 }}>
          {sellers.map((seller) => (
            <li
              key={seller.id}
              onClick={() => setSelectedSeller(seller)}
              style={{
                padding: "10px",
                marginBottom: "5px",
                backgroundColor: selectedSeller?.id === seller.id ? "#4ade80" : "transparent",
                cursor: "pointer",
                borderRadius: "4px",
                display: "flex",
                justifyContent: "space-between",
                alignItems: "center",
              }}
            >
              {seller.name}
              <span style={{ width: "10px", height: "10px", borderRadius: "50%", backgroundColor: "green", animation: "pulse 1s infinite" }}></span>
            </li>
          ))}
        </ul>
      </div>

      {/* Right Side: Chat Dashboard */}
      <div style={{ width: "75%", padding: "10px", display: "flex", flexDirection: "column", justifyContent: "space-between" }}>
        <div style={{ flexGrow: 1, overflowY: "auto", marginBottom: "10px" }}>
          {messages.length === 0 && <p>No messages yet.</p>}
          {messages.map((msg, idx) => (
            <div key={idx} style={{ marginBottom: "5px" }}>
              <strong>{msg.seller}: </strong>
              <span>{msg.text}</span>
              <span style={{ float: "right", fontSize: "0.8rem", color: "#a0aec0" }}>{msg.time}</span>
            </div>
          ))}
        </div>

        {/* SMS Input */}
        <div style={{ display: "flex" }}>
          <input
            type="text"
            value={newMessage}
            onChange={(e) => setNewMessage(e.target.value)}
            placeholder={selectedSeller ? `Message to ${selectedSeller.name}` : "Select a seller first"}
            style={{ flexGrow: 1, padding: "10px", borderRadius: "4px 0 0 4px", border: "1px solid #444", backgroundColor: "#1f2a3d", color: "#cbdcea" }}
            disabled={!selectedSeller}
          />
          <button
            onClick={handleSend}
            style={{ padding: "10px 20px", backgroundColor: "#4ade80", border: "none", borderRadius: "0 4px 4px 0", cursor: selectedSeller ? "pointer" : "not-allowed" }}
            disabled={!selectedSeller}
          >
            Send
          </button>
        </div>
      </div>
          </div>
      {/* Green pulse animation */}
      <style>
        {`
          @keyframes pulse {
            0% { transform: scale(1); opacity: 1; }
            50% { transform: scale(1.5); opacity: 0.5; }
            100% { transform: scale(1); opacity: 1; }
          }
        `}
      </style>
    </div>
  );
}

export default ChatSeller;
