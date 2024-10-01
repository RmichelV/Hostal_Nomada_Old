import { useState, useEffect } from 'react';

const GetReservations = ({ setRoomTypes }) => {
  useEffect(() => {
    async function fetchReservations() {
      try {
        const response = await fetch(`http://127.0.0.1:8000/api/reservations`);
        const result = await response.json();
        setRoomTypes(result.data); 
      } catch (error) {
        console.error('No hay reservaciones:', error);
      }
    }

    fetchReservations();
  }, [setRoomTypes]);

  return null;
};

export default GetReservations;