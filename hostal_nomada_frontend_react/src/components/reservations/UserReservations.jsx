import { useEffect, useState } from 'react';

const UserReservations = () => {
  const [reservations, setReservations] = useState([]);
  const [error, setError] = useState(null);

  const fetchUserReservations = async () => {
    try {
      const response = await fetch('http://127.0.0.1:8000/api/my-reservations', {
        method: 'GET',
        headers: {
          'Authorization': `Bearer ${localStorage.getItem('token')}`, // Asegúrate de enviar el token de autenticación si es necesario
        }
      });

      if (!response.ok) {
        throw new Error('Error fetching reservations');
      }

      const data = await response.json();
      setReservations(data.data);
    } catch (error) {
      setError(error.message);
    }
  };

  useEffect(() => {
    fetchUserReservations();
  }, []);

  if (error) {
    return <div>Error: {error}</div>;
  }

  return (
    <div>
      <h1>Mis Reservas</h1>
      <ul>
        {reservations.map((reservation) => (
          <li key={reservation.id}>
            {reservation.entry_date} - {reservation.depature_date}
          </li>
        ))}
      </ul>
    </div>
  );
};

export default UserReservations;
