@extends('seller.layouts.layout')
@section('seller_page_title')
     create store
@endsection
@section('seller_layout')

  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: "Poppins", sans-serif;
    }

    body {
      background-color: #f5f6fa;
    }

    .chat-container {
      width: 100%;
      max-width: 700px;
      height: 600px;
      background-color: #fff;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      display: flex;
      flex-direction: column;
      overflow: hidden;
      margin: 0 auto; /* center horizontally */
    }

    .chat-header {
      background-color: #3c91e6;
      color: #fff;
      padding: 15px 20px;
      font-size: 18px;
      font-weight: 500;
    }

    .chat-messages {
      flex: 1;
      padding: 15px;
      overflow-y: auto;
      background-color: #f9f9f9;
      min-height: 400px;
    }

    .message {
      max-width: 70%;
      margin-bottom: 10px;
      padding: 10px 15px;
      border-radius: 12px;
      word-wrap: break-word;
    }

    .vendor-message {
      background-color: #3c91e6;
      color: #fff;
      align-self: flex-end;
      border-bottom-right-radius: 0;
    }

    .admin-message {
      background-color: #e2e2e2;
      color: #333;
      align-self: flex-start;
      border-bottom-left-radius: 0;
    }

    .chat-input {
      display: flex;
      border-top: 1px solid #ddd;
    }

    .chat-input input {
      flex: 1;
      padding: 15px;
      border: none;
      outline: none;
      font-size: 15px;
    }

    .chat-input button {
      padding: 0 20px;
      border: none;
      background-color: #28a745;
      color: #fff;
      cursor: pointer;
      font-size: 16px;
      transition: background 0.3s;
    }

    .chat-input button:hover {
      background-color: #218838;
    }

    /* Scrollbar styling */
    .chat-messages::-webkit-scrollbar {
      width: 6px;
    }
    .chat-messages::-webkit-scrollbar-thumb {
      background-color: #ccc;
      border-radius: 3px;
    }

    @media (max-width: 768px) {
      .chat-container {
        max-width: 100%;
      }
    }
  </style>
</head>
<body>

  <div class="chat-container">
    <div class="chat-header">Chat with Admin</div>
    <div class="chat-messages">
      <div class="message admin-message">Hello! How can I help you today?</div>
      <div class="message vendor-message">Hi, I want to check my payout status.</div>
      <div class="message admin-message">Sure! Your last payout was processed on 2025-10-20.</div>
    </div>
    <form class="chat-input" onsubmit="return sendMessage()">
      <input type="text" id="messageInput" placeholder="Type your message..." required>
      <button type="submit">Send</button>
    </form>
  </div>

  <script>
    const chatMessages = document.querySelector('.chat-messages');
    const messageInput = document.getElementById('messageInput');

    function sendMessage() {
      const msgText = messageInput.value.trim();
      if(msgText === '') return false;

      const msgDiv = document.createElement('div');
      msgDiv.classList.add('message', 'vendor-message');
      msgDiv.textContent = msgText;
      chatMessages.appendChild(msgDiv);

      chatMessages.scrollTop = chatMessages.scrollHeight;
      messageInput.value = '';

      // Placeholder for admin reply simulation
      setTimeout(() => {
        const adminReply = document.createElement('div');
        adminReply.classList.add('message', 'admin-message');
        adminReply.textContent = "Admin will reply soon.";
        chatMessages.appendChild(adminReply);
        chatMessages.scrollTop = chatMessages.scrollHeight;
      }, 1000);

      return false; // prevent form submission
    }
  </script>

</body>




@endsection