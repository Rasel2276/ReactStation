import React, { useState, useEffect } from "react";
import { motion, AnimatePresence } from "framer-motion";

// Local images import
import fashion1 from "./carousel-image/fashion1.jpg";
import fashion2 from "./carousel-image/fashion2.jpg";
import fashion3 from "./carousel-image/fashion3.jpg";

const slides = [
  { id: 1, title: "Discover Your Style", text: "Explore the latest trends.", button: "Shop Now", link: "/shop", image: fashion1 },
  { id: 2, title: "Luxury Meets Comfort", text: "Experience elegance in every outfit.", button: "Explore Collection", link: "/collection", image: fashion2 },
  { id: 3, title: "Be Bold. Be You.", text: "Unleash your confidence.", button: "Get Started", link: "/start", image: fashion3 },
];

function DarkCarousel() {
  const [current, setCurrent] = useState(0);

  useEffect(() => {
    const interval = setInterval(() => {
      setCurrent((prev) => (prev + 1) % slides.length);
    }, 2000); // Slide duration 2 sec
    return () => clearInterval(interval);
  }, []);

  const slide = slides[current];

  return (
    <div className="carousel-container">
      <AnimatePresence exitBeforeEnter>
        {/* Left Text */}
        <motion.div
          key={slide.id}
          className="carousel-text"
          initial={{ x: 100, opacity: 0 }}
          animate={{ x: 0, opacity: 1 }}
          exit={{ x: -100, opacity: 0 }}
          transition={{ duration: 0.7, ease: "easeOut" }}
        >
          <h2>{slide.title}</h2>
          <p>{slide.text}</p>
          <a href={slide.link} className="carousel-btn">{slide.button}</a>
        </motion.div>

        {/* Right Image */}
        <motion.div
          key={slide.image}
          className="carousel-image"
          initial={{ x: 100, opacity: 0 }}
          animate={{ x: 0, opacity: 1 }}
          exit={{ x: -100, opacity: 0 }}
          transition={{ duration: 0.7, ease: "easeOut" }}
        >
          <img src={slide.image} alt={slide.title} />
        </motion.div>
      </AnimatePresence>
    </div>
  );
}

export default DarkCarousel;
