import React, { useState } from "react";

function ChatDashboard() {
  const [customers] = useState([
    { id: 1, name: "John Doe", active: true },
    { id: 2, name: "Jane Smith", active: true },
    { id: 3, name: "Ali Khan", active: false },
  ]);

  const [selectedCustomer, setSelectedCustomer] = useState(customers[0]);
  const [messages, setMessages] = useState([
    { from: "customer", text: "Hello, I need help with my order." },
    { from: "seller", text: "Sure, tell me your order ID." },
  ]);
  const [newMessage, setNewMessage] = useState("");

  const handleSend = () => {
    if (newMessage.trim() === "") return;

    setMessages([...messages, { from: "seller", text: newMessage }]);
    setNewMessage("");
  };

  return (
    <div>
      <h2 style={{ marginLeft: "30px", color: "#cbdcea" }}>Talk to Customer</h2>
    <div style={{ display: "flex", height: "500px", border: "1px solid #444", backgroundColor: "#213247", color: "#cbdcea",margin:"20px" }}>
      
      {/* Left side - Customer list */}
      <div style={{ width: "25%", borderRight: "1px solid #444", padding: "10px" }}>
        <h3 style={{ marginBottom: "10px" }}>Customers</h3>
        {customers.map((c) => (
          <button
            key={c.id}
            onClick={() => setSelectedCustomer(c)}
            style={{
              display: "block",
              width: "100%",
              padding: "10px",
              marginBottom: "8px",
              backgroundColor: selectedCustomer.id === c.id ? "#334155" : "#1f2a3d",
              color: "#cbdcea",
              border: "1px solid #444",
              borderRadius: "5px",
              textAlign: "left",
              position: "relative",
              cursor: "pointer",
            }}
          >
            {c.name}
            {c.active && (
              <span
                style={{
                  position: "absolute",
                  right: "10px",
                  top: "50%",
                  transform: "translateY(-50%)",
                  width: "10px",
                  height: "10px",
                  backgroundColor: "limegreen",
                  borderRadius: "50%",
                }}
              ></span>
            )}
          </button>
        ))}
      </div>

      {/* Right side - Chat box */}
      <div style={{ width: "75%", display: "flex", flexDirection: "column" }}>
        {/* Chat Header */}
        <div style={{ padding: "10px", borderBottom: "1px solid #444", backgroundColor: "#1f2a3d" }}>
          <h3>Chat with {selectedCustomer.name}</h3>
        </div>

        {/* Messages Area */}
        <div
          style={{
            flex: 1,
            padding: "10px",
            overflowY: "auto",
            backgroundColor: "#0f172a",
          }}
        >
          {messages.map((msg, i) => (
            <div
              key={i}
              style={{
                textAlign: msg.from === "seller" ? "right" : "left",
                margin: "5px 0",
              }}
            >
              <span
                style={{
                  display: "inline-block",
                  padding: "8px 12px",
                  borderRadius: "10px",
                  backgroundColor: msg.from === "seller" ? "#334155" : "#475569",
                  color: "#fff",
                }}
              >
                {msg.text}
              </span>
            </div>
          ))}
        </div>

        {/* Input Area */}
        <div style={{ display: "flex", borderTop: "1px solid #444", padding: "10px", backgroundColor: "#1f2a3d" }}>
          <input
            type="text"
            value={newMessage}
            onChange={(e) => setNewMessage(e.target.value)}
            placeholder="Type your message..."
            style={{
              flex: 1,
              padding: "8px",
              borderRadius: "5px",
              border: "1px solid #444",
              backgroundColor: "#0f172a",
              color: "#cbdcea",
              marginRight: "10px",
            }}
          />
          <button
            onClick={handleSend}
            style={{
              padding: "8px 15px",
              borderRadius: "5px",
              border: "none",
              backgroundColor: "#2563eb",
              color: "#fff",
              cursor: "pointer",
            }}
          >
            Send
          </button>
        </div>
      </div>
    </div>
    </div>
  );
}

export default ChatDashboard;
