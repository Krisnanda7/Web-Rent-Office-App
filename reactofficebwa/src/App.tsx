import { BrowserRouter, Route, Routes } from "react-router-dom";
import Browse from "./pages/Browse";
import Details from "./pages/Details";
import BookOffice from "./pages/BookOffice";
import CityDetails from "./pages/CityDetails";
import SuccesBooking from "./pages/SuccesBooking";
import CheckBooking from "./pages/CheckBooking";
import Login from "./pages/Login";
import Register from "./pages/Register";
import "./index.css";

function App() {
  return (
    <>
      <BrowserRouter>
        <Routes>
          <Route path="/" element={<Browse />} />
          <Route path="/office/:slug" element={<Details />} />
          <Route path="/office/:slug/book" element={<BookOffice />} />
          <Route path="/city/:slug" element={<CityDetails />} />
          <Route path="/succes-booking" element={<SuccesBooking />} />
          <Route path="/check-booking" element={<CheckBooking />} />
          <Route path="/login" element={<Login />} />
          <Route path="/register" element={<Register />} />
        </Routes>
      </BrowserRouter>
    </>
  );
}

export default App;
