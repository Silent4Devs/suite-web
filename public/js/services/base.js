import axios from "axios";

//instancia base de axios
export const instance = axios.create({
    baseURL: import.meta.env.VITE_INDEX_ROUTE_API,
    headers: {
        'Content-Type': 'application/json',
        accept: 'application/json',
    }
  });
