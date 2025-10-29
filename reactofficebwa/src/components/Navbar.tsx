import { useEffect, useState } from "react";
import { Link } from "react-router-dom";

export default function Navbar() {
  const [isLoggedIn, setIsLoggedIn] = useState(false);

  useEffect(() => {
    const token = localStorage.getItem("token");
    setIsLoggedIn(!!token); // true kalau token ada
  }, []);

  const handleLogout = () => {
    localStorage.removeItem("token");
    localStorage.removeItem("customer");
    alert("Berhasil logout!");
    window.location.href = "/";
  };
  useEffect(() => {
    const elements = document.querySelectorAll(".animate-fade-in-scroll");
    const observer = new IntersectionObserver(
      (entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            entry.target.classList.add("visible");
          }
        });
      },
      { threshold: 0.2 }
    );

    elements.forEach((el) => observer.observe(el));
    return () => observer.disconnect();
  }, []);
  return (
    <nav className="bg-white">
      <div className="flex items-center justify-between w-full max-w-[1130px] py-[22px] mx-auto">
        <Link to={`/`}>
          <img src="/assets/images/icons/logo 1.png" alt="logo" />
        </Link>
        <ul className="flex items-center gap-[50px] w-fit animate-fade-in">
          <li className="hover:text-[#447cff]">
            <Link to={`/`}>Browse</Link>
          </li>
          <li className="hover:text-[#447cff]">
            <a href="">Popular</a>
          </li>
          <li className="hover:text-[#447cff]">
            <a href="">Categories</a>
          </li>
          <li className="hover:text-[#447cff]">
            <a href="">Events</a>
          </li>
          <li className="hover:text-[#447cff]">
            <Link to={`/`}>My Booking</Link>
          </li>
          {isLoggedIn ? (
            <button
              onClick={handleLogout}
              className="bg-[#0A2463] hover:bg-red-700 px-4 py-2 rounded-xl font-semibold text-white"
            >
              Logout
            </button>
          ) : (
            <>
              <li className="bg-[#0A2463] text-white px-4 py-2 rounded-xl font-semibold animate-bounce">
                <a href="/login">Login</a>
              </li>
              <li className="border border-[#000929] px-4 py-2 rounded-xl font-semibold animate-bounce">
                <a href="/Register">Register</a>
              </li>
            </>
          )}
        </ul>
        <a
          href="#"
          className="flex items-center gap-[10px] rounded-full border border-[#000929] py-3 px-5"
        >
          <img
            src="/assets/images/icons/call.svg"
            className="w-6 h-6"
            alt="icon"
          />
          <span className="font-semibold">Contact Us</span>
        </a>
      </div>
    </nav>
  );
}
