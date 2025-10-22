import { useEffect, useState } from "react";
import { Link, useNavigate } from "react-router-dom";

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
  return (
    <nav className="bg-white">
      <div className="flex items-center justify-between w-full max-w-[1130px] py-[22px] mx-auto">
        <Link to={`/`}>
          <img src="/assets/images/icons/logo 1.png" alt="logo" />
        </Link>
        <ul className="flex items-center gap-[50px] w-fit">
          <li>
            <Link to={`/`}>Browse</Link>
          </li>
          <li>
            <a href="">Popular</a>
          </li>
          <li>
            <a href="">Categories</a>
          </li>
          <li>
            <a href="">Events</a>
          </li>
          <li>
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
              <li>
                <a href="/login">Login</a>
              </li>
              <li>
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
