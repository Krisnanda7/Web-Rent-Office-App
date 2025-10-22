import { useState } from "react";
import axios from "axios";
import { Link } from "react-router-dom";

export default function Login() {
  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");
  // const navigate = useNavigate();

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
      alert("Login berhasil!");
      window.location.href = "/";
    } catch (error) {
      alert("Login gagal, periksa email atau password!");
    }
  };

  return (
    <div className="min-h-screen bg-gray-50 flex items-center justify-center p-4">
      <div className="bg-white rounded-lg shadow-lg max-w-md w-full p-8">
        <div className="mb-8 text-center">
          <h1 className="text-xl font-bold text-gray-900 mb-2">LOG IN</h1>
          <p className="text-gray-600 text-sm md:text-base">
            Masuk ke akun Anda untuk melanjutkan pengalaman mengelola bisnis
            Anda.
          </p>
        </div>

        <div className="space-y-5">
          <div>
            <label className="block text-sm font-medium text-gray-700 mb-2">
              Email
            </label>
            <input
              type="email"
              placeholder="nama@email.com"
              className="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
              value={email}
              onChange={(e) => setEmail(e.target.value)}
            />
          </div>

          <div>
            <label className="block text-sm font-medium text-gray-700 mb-2">
              Password
            </label>
            <input
              type="password"
              placeholder="Masukkan password"
              className="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
              value={password}
              onChange={(e) => setPassword(e.target.value)}
            />
          </div>

          <button
            onClick={handleLogin}
            className="w-full bg-gray-900 text-white font-medium py-3 rounded-md hover:bg-gray-800 transition duration-300"
          >
            LOGIN
          </button>

          <div className="text-center">
            <p className="text-slate-600">
              Sudah punya akun?{" "}
              <Link
                to="/register"
                className="text-blue-600 hover:text-blue-700 font-semibold hover:underline"
              >
                Register di sini
              </Link>
            </p>
          </div>
        </div>
      </div>
    </div>
  );
}
