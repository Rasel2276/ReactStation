import { BrowserRouter as Router, Routes, Route, Link } from "react-router-dom";
import Insert from "./pages/Insert.jsx";
import Show from "./pages/Show.jsx";
import "./css/App.css";


function App() {
  return (
    <Router>
      <div style={{ padding: "20px" }}>
        <nav>
          <Link to="/insert">Insert Student</Link> |{" "}
          <Link to="/show">Show Students</Link>
        </nav>

        <Routes>
          <Route path="/insert" element={<Insert />} />
          <Route path="/show" element={<Show />} />
        </Routes>
      </div>
    </Router>
  );
}

export default App;
