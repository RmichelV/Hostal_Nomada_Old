"use client"
import { useState, useEffect } from 'react';

export default function RoomTypesPage() {
  const [roomTypes, setRoomTypes] = useState([]);

  useEffect(() => {
    async function fetchRoomTypes() {
      try {
        const response = await fetch('api/roomtypes');
        const result = await response.json();
        setRoomTypes(result.data);
      } catch (error) {
        console.error('Error fetching room types:', error);
      }
    }

    fetchRoomTypes();
  }, []);

  return (
    <div>
      <h1>Room Types</h1>
      <ul>
        {roomTypes.map((room) => (
          <li key={room.id}>
            <h2>{room.name}</h2>
            <p>{room.description}</p>
            {room.image ? <img src={room.image} alt={room.name} /> : <p>No image available</p>}
          </li>
        ))}
      </ul>
    </div>
  );
}