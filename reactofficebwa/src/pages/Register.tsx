import axios from "axios";
import { useState } from "react";
import { Link, Navigate } from "react-router-dom";

export default function Register() {
  const [name, setName] = useState("");
  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");
  const [isLoading, setIsLoading] = useState(false);

  const handleRegister = async (e: React.FormEvent) => {
    e.preventDefault();
    setIsLoading(true);
    try {
      const response = await axios.post(
        "http://127.0.0.1:8000/api/customer/register",
        { name, email, password },
        {
          headers: {
            "X-API-KEY": "wkwkwkwkjj0901",
          },
        }
      );

      console.log("Form submit succesfully:", response.data);

      alert("Registrasi berhasil! Silakan login.");
      window.location.href = "/login";
    } catch (error) {
      console.error(error.response?.data || error.message);
      alert(
        error.response?.data?.message ||
          "Gagal registrasi, mungkin email sudah terdaftar."
      );
    } finally {
      setIsLoading(false);
    }
  };

  return (
    <div className="min-h-screen bg-gradient-to-br from-blue-50 via-white to-blue-50 flex items-center justify-center p-4">
      <div className="w-full max-w-md">
        {/* Main Card */}
        <div className="bg-white rounded-3xl shadow-xl p-8 md:p-10">
          <div className="mb-8 text-center">
            <h1 className="text-xl md:text-5xl font-bold text-slate-900 mb-4 leading-tight text-center">
              CREATE YOUR ACCOUNT
            </h1>
            <p className="text-gray-500 text-base md:text-lg">
              Bergabunglah dengan kami untuk mendapatkan pengalaman terbaik
              dalam mengelola bisnis Anda.
            </p>
          </div>

          <form onSubmit={handleRegister} className="space-y-5">
            <div>
              <label className="block text-sm font-medium text-slate-700 mb-2">
                Nama Lengkap
              </label>
              <input
                type="text"
                placeholder="Masukkan nama lengkap"
                className="w-full px-4 py-3 border border-slate-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                value={name}
                onChange={(e) => setName(e.target.value)}
                required
              />
            </div>

            <div>
              <label className="block text-sm font-medium text-slate-700 mb-2">
                Email
              </label>
              <input
                type="email"
                placeholder="nama@email.com"
                className="w-full px-4 py-3 border border-slate-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                value={email}
                onChange={(e) => setEmail(e.target.value)}
                required
              />
            </div>

            <div>
              <label className="block text-sm font-medium text-slate-700 mb-2">
                Password
              </label>
              <input
                type="password"
                placeholder="Minimal 8 karakter"
                className="w-full px-4 py-3 border border-slate-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                value={password}
                onChange={(e) => setPassword(e.target.value)}
                required
                minLength={8}
              />
            </div>

            <button
              type="submit"
              disabled={isLoading}
              className="w-full bg-gray-900 text-white font-medium py-3 rounded-md hover:bg-gray-800 transition duration-300"
            >
              {isLoading ? "Mendaftar..." : "Daftar Sekarang"}
            </button>
          </form>

          <div className="mt-6 text-center">
            <p className="text-slate-600">
              Sudah punya akun?{" "}
              <Link
                to="/login"
                className="text-blue-600 hover:text-blue-700 font-semibold hover:underline"
              >
                Login di sini
              </Link>
            </p>
          </div>
        </div>

        {/* Footer Text */}
        <p className="text-center text-sm text-slate-500 mt-6">
          Dengan mendaftar, Anda menyetujui{" "}
          <a href="#" className="text-slate-700 hover:underline">
            Syarat & Ketentuan
          </a>{" "}
          dan{" "}
          <a href="#" className="text-slate-700 hover:underline">
            Kebijakan Privasi
          </a>
        </p>
      </div>
    </div>
  );
}
