import { useState } from "react";
import axios from "axios";
import { useNavigate, Link } from "react-router-dom";

export default function Login() {
  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");
  const navigate = useNavigate();

  const handleLogin = async (e: React.FormEvent) => {
    e.preventDefault();
    try {
      const res = await axios.post(
        "http://127.0.0.1:8000/api/customer/login",
        {
          email,
          password,
        },
        {
          headers: {
            "X-API-KEY": "wkwkwkwkjj0901",
          },
        }
      );
      localStorage.setItem("token", res.data.token);
      localStorage.setItem("customer", JSON.stringify(res.data.customer));
      navigate("/");
    } catch (error) {
      alert("Login gagal, periksa email atau password!");
    }
  };

  return (
    <section className="flex justify-center items-center min-h-screen bg-gradient-to-r from-[#f4f7fb] to-[#e9efff]">
      <div className="flex flex-col md:flex-row items-center bg-white shadow-xl rounded-3xl overflow-hidden max-w-5xl w-full">
        {/* Left side: Illustration */}
        <div className="md:w-1/2 bg-[#000929] text-white flex flex-col justify-center items-center p-10">
          <h2 className="text-3xl font-bold mb-3 text-center">
            Selamat Datang Kembali!
          </h2>
          <p className="text-center text-gray-300 mb-6">
            Login ke akunmu dan temukan ruang kantor terbaik untuk bisnis kamu.
          </p>
          <img
            src="/assets/images/illustration-login.svg"
            alt="illustration"
            className="w-64"
          />
        </div>

        {/* Right side: Form */}
        <div className="md:w-1/2 p-10">
          <h1 className="text-3xl font-bold text-[#000929] mb-6 text-center">
            Masuk ke Akun
          </h1>

          <form onSubmit={handleLogin} className="space-y-5">
            <div>
              <label className="block text-sm font-medium text-gray-600 mb-2">
                Email
              </label>
              <input
                type="email"
                placeholder="Masukkan email kamu"
                className="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                value={email}
                onChange={(e) => setEmail(e.target.value)}
              />
            </div>

            <div>
              <label className="block text-sm font-medium text-gray-600 mb-2">
                Password
              </label>
              <input
                type="password"
                placeholder="Masukkan password"
                className="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                value={password}
                onChange={(e) => setPassword(e.target.value)}
              />
            </div>

            <button
              type="submit"
              className="w-full bg-[#000929] text-white py-3 rounded-xl font-semibold hover:bg-blue-800 transition duration-300"
            >
              Masuk
            </button>
          </form>

          <p className="text-center text-sm text-gray-600 mt-6">
            Belum punya akun?{" "}
            <Link
              to="/register"
              className="text-blue-600 font-semibold hover:underline"
            >
              Daftar Sekarang
            </Link>
          </p>
        </div>
      </div>
    </section>
  );
}
