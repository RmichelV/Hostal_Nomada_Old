import axios from 'axios';
import { useEffect, useState } from 'react';

export default function Roomtypes() {
  const [rooms, setRooms] = useState([]);

  useEffect(() => {
    axios.get(`${process.env.NEXT_PUBLIC_API_URL}/roomtypes`, {
      withCredentials: true, 
    })
    .then(response => {
      console.log(response.data);
      setRooms(response.data.data); 
    })
    .catch(error => {
      console.error('Error fetching rooms:', error);
    });
  }, []);

  return (
    <div>
      <h1>Rooms List</h1>
      <ul>
        {Array.isArray(rooms) && rooms.length > 0 ? (
          rooms.map(room => (
            <li key={room.id}>{room.name}</li>
          ))
        ) : (
          <li>No rooms available</li>
        )}
      </ul>
    </div>
  );
}
