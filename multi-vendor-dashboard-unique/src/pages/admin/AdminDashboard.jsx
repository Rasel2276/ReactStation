import React from "react";
import Card from "../../components/dashboard-component/card-component/card";
import { FaShoppingCart, FaBoxOpen, FaUserTie, FaDollarSign } from 'react-icons/fa';
import SellingChart from "../../components/dashboard-component/chart-component/SellingChart";

export default function VendorDashboard() {
  return (
    <div>
      <div className="card-section">
        <Card title="Total Sales" value="$25,000" icon={FaDollarSign} />
        <Card title="Products" value="320" icon={FaBoxOpen} />
        <Card title="Sellers" value="58" icon={FaUserTie} />
        <Card title="Orders" value="1,204" icon={FaShoppingCart} />
      </div>
      <SellingChart />
    </div>
  );
}
