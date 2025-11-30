import { useState } from 'react';
import { useNavigate } from 'react-router-dom';
import axios from 'axios';

export default function Login() {
  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');
  const [loading, setLoading] = useState(false);
  const navigate = useNavigate();

  const handleLogin = async () => {
  setLoading(true);
  try {
    const res = await axios.post('http://127.0.0.1:8000/api/login', { email, password });

    const user = res.data.user;
    const token = res.data.token;

    // Save token + user info
    localStorage.setItem("token", token);
    localStorage.setItem("role", user.role);
    localStorage.setItem("user", JSON.stringify(user));

    // Redirect based on role
    if (user.role === "admin") {
      navigate("/admin");
    } else if (user.role === "vendor") {
      navigate("/vendor");
    } else {
      navigate("/customer");
    }

  } catch (err) {
    console.log(err.response?.data);
    alert(err.response?.data?.message || 'Login failed');
  } finally {
    setLoading(false);
  }
};


  return (
    <div style={styles.container}>
      <div style={styles.box}>
        <h2 style={styles.title}>Login</h2>

        <input
          type="email"
          placeholder="Email"
          value={email}
          onChange={e => setEmail(e.target.value)}
          style={styles.input}
        />
        <input
          type="password"
          placeholder="Password"
          value={password}
          onChange={e => setPassword(e.target.value)}
          style={styles.input}
        />

        <button onClick={handleLogin} style={styles.button} disabled={loading}>
          {loading ? 'Logging in...' : 'Login'}
        </button>

        <p style={styles.registerText}>
          Don't have an account?{' '}
          <button
            onClick={() => navigate('/register')}
            style={styles.registerButton}
          >
            Register
          </button>
        </p>
      </div>
    </div>
  );
}

const styles = {
  container: {
    display: 'flex',
    justifyContent: 'center',
    alignItems: 'center',
    height: '100vh',
    background: '#f0f2f5',
  },
  box: {
    width: '350px',
    padding: '30px',
    borderRadius: '10px',
    background: '#ffffff',
    boxShadow: '0 4px 15px rgba(0,0,0,0.1)',
    textAlign: 'center',
  },
  title: {
    marginBottom: '25px',
    color: '#333',
  },
  input: {
    width: '100%',
    padding: '12px',
    marginBottom: '15px',
    borderRadius: '6px',
    border: '1px solid #ccc',
    fontSize: '14px',
    boxSizing: 'border-box',
  },
  button: {
    width: '100%',
    padding: '12px',
    borderRadius: '6px',
    border: 'none',
    backgroundColor: '#4CAF50',
    color: '#fff',
    fontSize: '16px',
    cursor: 'pointer',
  },
  registerText: {
    marginTop: '15px',
    fontSize: '14px',
    color: '#555',
  },
  registerButton: {
    background: 'none',
    border: 'none',
    color: '#4CAF50',
    cursor: 'pointer',
    textDecoration: 'underline',
    padding: 0,
    fontSize: '14px',
  },
};
