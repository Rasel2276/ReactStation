import React from "react";
import {
  ComposedChart,
  Bar,
  Line,
  XAxis,
  YAxis,
  CartesianGrid,
  Tooltip,
  Legend,
  ResponsiveContainer,
} from "recharts";

const data = [
  { month: "Jan", temperature: 7, rainfall: 50 },
  { month: "Feb", temperature: 8, rainfall: 70 },
  { month: "Mar", temperature: 10, rainfall: 90 },
  { month: "Apr", temperature: 15, rainfall: 110 },
  { month: "May", temperature: 18, rainfall: 120 },
  { month: "Jun", temperature: 20, rainfall: 150 },
  { month: "Jul", temperature: 24, rainfall: 130 },
  { month: "Aug", temperature: 25, rainfall: 140 },
  { month: "Sep", temperature: 22, rainfall: 200 },
  { month: "Oct", temperature: 18, rainfall: 180 },
  { month: "Nov", temperature: 14, rainfall: 100 },
  { month: "Dec", temperature: 9, rainfall: 60 },
];

export default function SellingChart() {
  return (
    <div
      style={{
        width: "92%",
        height: 500,
        background: "#213247",
        padding: "20px",
        borderRadius: "10px",
        margin:"25px",
        
      }}
    >
      <h2 style={{ color: "#fff", textAlign: "center", marginBottom: "20px" }}>
        Average Monthly Sales
      </h2>
      <ResponsiveContainer width="100%" height="70%">
        <ComposedChart
          data={data}
          margin={{ top: 20, right: 40, left: 20, bottom: 20 }}
        >
          <CartesianGrid strokeDasharray="3 3" stroke="#4e5d78" />
          <XAxis dataKey="month" tick={{ fill: "#fff" }} />
          <YAxis
            yAxisId="left"
            label={{ value: "Sales", angle: -90, position: "insideLeft", fill: "#fff" }}
            tick={{ fill: "#fff" }}
          />
          <YAxis
            yAxisId="right"
            orientation="right"
            label={{ value: "Sales", angle: 90, position: "insideRight", fill: "#fff" }}
            tick={{ fill: "#fff" }}
          />
          <Tooltip />
          <Legend wrapperStyle={{ color: "#fff" }} />
          
          {/* Bar for Temperature */}
          <Bar yAxisId="left" dataKey="temperature" fill="#009c82" barSize={25} name="Temperature" />
          
          {/* Line for Rainfall */}
          <Line yAxisId="right" type="monotone" dataKey="rainfall" stroke="#000" name="Rainfall" dot={{ fill: "#000" }} />
        </ComposedChart>
      </ResponsiveContainer>
    </div>
  );
}


