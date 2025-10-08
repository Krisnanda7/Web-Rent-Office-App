export interface Office {
  id: number;
  price: number;
  duration: number;
  name: string;
  slug: string;
  city: City;
  thumbnail: string;
  photos: Photo[];
  benefits: Benefit[];
  about: string;
  rating: string;
  address: string;
}

interface Photo {
  id: number;
  photo: string;
}

interface Benefit {
  id: number;
  name: string;
}

export interface City {
  id: number;
  name: string;
  slug: string;
  photo: string;
  office_space_count: number;
  officeSpaces: Office[];
}

export interface BookingDetails {
  id: number;
  name: string;
  phone_number: string;
  booking_trx_id: string;
  is_paid: boolean;
  duration: number;
  total_amount: number;
  start_date: string;
  end_date: string;
  office: Office;
}
