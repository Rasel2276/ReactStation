import React from "react";
import { FaFacebook, FaTwitter, FaInstagram, FaLinkedin } from "react-icons/fa";
import "../../Footer.css"; // CSS file import

const Footer = () => {
  return (
    <footer className="footer">
      <div className="overlay">
        <div className="footer-container">
          {/* About */}
          <div className="footer-col">
            <h2 className="footer-title">MyShop</h2>
            <p>
              Welcome to MyShop! We provide high-quality products with fast
              delivery and excellent customer service.
            </p>
          </div>

          {/* Quick Links */}
          <div className="footer-col">
            <h3>Quick Links</h3>
            <ul>
              <li><a href="/">Home</a></li>
              <li><a href="/shop">Shop</a></li>
              <li><a href="/about">About</a></li>
              <li><a href="/contact">Contact</a></li>
            </ul>
          </div>

          {/* Contact */}
          <div className="footer-col">
            <h3>Contact Us</h3>
            <ul>
              <li>Email: support@shop.com</li>
              <li>Phone: +880 1234 567 890</li>
              <li>Address: Dhaka, Bangladesh</li>
            </ul>
          </div>

          {/* Social */}
          <div className="footer-col">
            <h3>Follow Us</h3>
            <div className="social-icons">
              <a href="#"><FaFacebook /></a>
              <a href="#"><FaTwitter /></a>
              <a href="#"><FaInstagram /></a>
              <a href="#"><FaLinkedin /></a>
            </div>
          </div>
        </div>

        {/* Bottom */}
        <div className="footer-bottom">
          © {new Date().getFullYear()} MyShop. All Rights Reserved.
        </div>
      </div>
    </footer>
  );
};

export default Footer;
