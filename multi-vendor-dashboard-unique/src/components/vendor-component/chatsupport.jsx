import React, { useState } from "react";

function ChatSupport() {
  const [messages, setMessages] = useState([
    { from: "seller", text: "Hello Admin, I need help with my payment." },
    { from: "admin", text: "Sure, please share your payment ID." },
  ]);

  const [newMessage, setNewMessage] = useState("");

  const handleSend = () => {
    if (newMessage.trim() === "") return;
    setMessages([...messages, { from: "seller", text: newMessage }]);
    setNewMessage("");
  };

  return (
    <div style={{ maxWidth: "800px", margin: "20px auto", border: "1px solid #444", borderRadius: "8px", backgroundColor: "#213247", color: "#cbdcea", display: "flex", flexDirection: "column", height: "500px" }}>
      
      {/* Header */}
      <div style={{ padding: "12px", borderBottom: "1px solid #444", backgroundColor: "#1f2a3d" }}>
        <h3>Support Chat (Seller ↔ Admin)</h3>
      </div>

      {/* Messages Area */}
      <div style={{ flex: 1, padding: "12px", overflowY: "auto", backgroundColor: "#0f172a" }}>
        {messages.map((msg, i) => (
          <div
            key={i}
            style={{
              textAlign: msg.from === "seller" ? "right" : "left",
              margin: "6px 0",
            }}
          >
            <span
              style={{
                display: "inline-block",
                padding: "8px 12px",
                borderRadius: "10px",
                backgroundColor: msg.from === "seller" ? "#2563eb" : "#475569",
                color: "#fff",
                maxWidth: "70%",
              }}
            >
              {msg.text}
            </span>
          </div>
        ))}
      </div>

      {/* Input Area */}
      <div style={{ display: "flex", padding: "10px", borderTop: "1px solid #444", backgroundColor: "#1f2a3d" }}>
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
            backgroundColor: "#16a34a",
            color: "#fff",
            cursor: "pointer",
          }}
        >
          Send
        </button>
      </div>
    </div>
  );
}

export default ChatSupport;
