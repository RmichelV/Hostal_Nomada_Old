import axios from 'axios';
import { useEffect, useState } from 'react';

export default function Roomtypes() {
  const [rooms, setProducts] = useState([]);

  useEffect(() => {
    axios.get(`${process.env.NEXT_PUBLIC_API_URL}/roomtypes`)
      .then(response => {
        setProducts(response.data);
      })
      .catch(error => {
        console.error('Error fetching products:', error);
      });
  }, []);

  return (
    <div>
      <h1>Rooms List</h1>
      <ul>
        {rooms.map(room => (
          <li key={room.id}>{room.name}</li>
        ))}
      </ul>
    </div>
  );
}
