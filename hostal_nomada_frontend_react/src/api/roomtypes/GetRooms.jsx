// GetRooms.js
import { useState, useEffect } from 'react';

const GetRooms = ({ setRoomTypes }) => {
  useEffect(() => {
    async function fetchRoomTypes() {
      try {
        const response = await fetch(`http://127.0.0.1:8000/api/roomtypes`);
        const result = await response.json();
        setRoomTypes(result.data); // Asegúrate de que la estructura coincida
      } catch (error) {
        console.error('Error fetching room types:', error);
      }
    }

    fetchRoomTypes();
  }, [setRoomTypes]);

  return null; // Este componente no necesita renderizar nada
};

export default GetRooms;
