import { useEffect, useState } from "react";
import api from "../api.js";
import { useNavigate } from "react-router-dom";
import "../css/Show.css";


function Show() {
  const [students, setStudents] = useState([]);
  const navigate = useNavigate();

  const fetchStudents = async () => {
    const res = await api.get("/students");
    setStudents(res.data);
  };

  useEffect(() => {
    fetchStudents();
  }, []);

  const deleteStudent = async (id) => {
    await api.delete(`/students/${id}`);
    fetchStudents();
  };

  const editStudent = (student) => {
    navigate("/insert", { state: { student } });
  };

  return (
    <div>
      <h2>All Students</h2>
      <button onClick={() => navigate("/insert")}>Add New Student</button>
      <br /><br />
      <table border="1" cellPadding="10">
        <thead>
          <tr>
            <th>ID</th><th>Name</th><th>Age</th><th>Gender</th><th>Action</th>
          </tr>
        </thead>
        <tbody>
          {students.map((s) => (
            <tr key={s.id}>
              <td>{s.id}</td>
              <td>{s.name}</td>
              <td>{s.age}</td>
              <td>{s.gender}</td>
              <td>
                <button onClick={() => editStudent(s)}>Edit</button>{" "}
                <button onClick={() => deleteStudent(s.id)}>Delete</button>
              </td>
            </tr>
          ))}
        </tbody>
      </table>
    </div>
  );
}

export default Show;
