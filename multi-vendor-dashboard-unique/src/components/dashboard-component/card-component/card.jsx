import React from 'react';

export default function Card({ title, value, icon: Icon }) {
  return (
    <div className="main-card">
      <div className="card-icon">
        <Icon className="icon" />
      </div>
      <div>
        <h2 className="card-heading">{title}</h2>
        <p className="card-details">{value}</p>
      </div>
    </div>
  );
}
