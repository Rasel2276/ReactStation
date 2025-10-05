import React, { useState, useEffect } from "react";
import { motion, AnimatePresence } from "framer-motion";
import { ChevronLeft, ChevronRight } from "lucide-react";

// Local images
import fashion1 from "./carousel-image/fashion1.jpg";
import fashion2 from "./carousel-image/fashion2.jpg";
import fashion3 from "./carousel-image/fashion3.jpg";


const slides = [
  {
    id: 1,
    title: "Discover Your Style",
    text: "Explore the latest trends.",
    button: "Shop Now",
    link: "/shop",
    image: fashion1,
  },
  {
    id: 2,
    title: "Luxury Meets Comfort",
    text: "Experience elegance in every outfit.",
    button: "Explore Collection",
    link: "/collection",
    image: fashion2,
  },
  {
    id: 3,
    title: "Be Bold. Be You.",
    text: "Unleash your confidence.",
    button: "Get Started",
    link: "/start",
    image: fashion3,
  },
];

function DarkCarousel() {
  const [index, setIndex] = useState(0);
  const [direction, setDirection] = useState(1);

  const nextSlide = () => {
    setDirection(1);
    setIndex((prev) => (prev + 1) % slides.length);
  };

  const prevSlide = () => {
    setDirection(-1);
    setIndex((prev) => (prev - 1 + slides.length) % slides.length);
  };

  useEffect(() => {
    const timer = setInterval(nextSlide, 5000);
    return () => clearInterval(timer);
  }, []);

  const variants = {
    enter: (dir) => ({
      x: dir > 0 ? "100%" : "-100%",
      opacity: 0,
    }),
    center: {
      x: 0,
      opacity: 1,
    },
    exit: (dir) => ({
      x: dir > 0 ? "-100%" : "100%",
      opacity: 0,
    }),
  };

  return (
    <div className="carousel-container">
      <AnimatePresence mode="wait" custom={direction}>
        <motion.div
          key={slides[index].id}
          custom={direction}
          variants={variants}
          initial="enter"
          animate="center"
          exit="exit"
          transition={{ duration: 1.2, ease: "easeInOut" }}
          className="carousel-slide"
        >
          {/* Background Image */}
          <img
            src={slides[index].image}
            alt={slides[index].title}
            className="carousel-image"
          />

          {/* Overlay */}
          <div className="carousel-overlay"></div>

          {/* Text */}
          <div className="carousel-content">
            <motion.h2
              initial={{ opacity: 0, y: 40 }}
              animate={{ opacity: 1, y: 0 }}
              transition={{ delay: 0.4, duration: 0.8 }}
            >
              {slides[index].title}
            </motion.h2>

            <motion.p
              initial={{ opacity: 0, y: 20 }}
              animate={{ opacity: 1, y: 0 }}
              transition={{ delay: 0.6, duration: 0.8 }}
            >
              {slides[index].text}
            </motion.p>

            <motion.a
              href={slides[index].link}
              initial={{ opacity: 0, scale: 0.8 }}
              animate={{ opacity: 1, scale: 1 }}
              transition={{ delay: 0.8, duration: 0.8 }}
              className="carousel-btn"
            >
              {slides[index].button}
            </motion.a>
          </div>
        </motion.div>
      </AnimatePresence>

      {/* Arrows */}
      <button onClick={prevSlide} className="carousel-arrow left">
        <ChevronLeft size={30} />
      </button>

      <button onClick={nextSlide} className="carousel-arrow right">
        <ChevronRight size={30} />
      </button>

      {/* Dots */}
      <div className="carousel-dots">
        {slides.map((_, i) => (
          <button
            key={i}
            onClick={() => setIndex(i)}
            className={`dot ${i === index ? "active" : ""}`}
          ></button>
        ))}
      </div>
    </div>
  );
}

export default DarkCarousel;
