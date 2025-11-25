import { useState } from 'react';
import { useNavigate } from 'react-router-dom';
import axios from 'axios';

export default function Registration(){
  const [name,setName] = useState('');
  const [email,setEmail] = useState('');
  const [password,setPassword] = useState('');
  const [role,setRole] = useState('customer');
  const navigate = useNavigate();

  const handleRegister = async ()=>{
    try{
      await axios.post('http://127.0.0.1:8000/api/register',{
        name,email,password,role
      });
      navigate('/');
    }catch(err){
      console.log(err.response.data);
    }
  }

  return (
    <div>
      <input placeholder="Name" value={name} onChange={e=>setName(e.target.value)} />
      <input placeholder="Email" value={email} onChange={e=>setEmail(e.target.value)} />
      <input type="password" placeholder="Password" value={password} onChange={e=>setPassword(e.target.value)} />
      <select value={role} onChange={e=>setRole(e.target.value)}>
        <option value="customer">Customer</option>
        <option value="vendor">Vendor</option>
      </select>
      <button onClick={handleRegister}>Register</button>
    </div>
  );
}
