import { useState, useEffect } from 'react';

const UserReservations = () => {
  const [reservations, setReservations] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);

  // Función para obtener las reservas del usuario logueado
  const fetchUserReservations = async () => {
    try {
      const response = await fetch('http://127.0.0.1:8000/api/my-reservations', {
        method: 'GET',
        headers: {
          'Content-Type': 'application/json',
          'Authorization': `Bearer ${localStorage.getItem('token')}` // Asegúrate de incluir el token si estás usando autenticación JWT
        }
      });

      const result = await response.json();

      if (response.ok) {
        setReservations(result.data);
      } else {
        setError(result.message || 'Error al obtener las reservas');
      }
    } catch (err) {
      setError('Error al obtener las reservas');
    } finally {
      setLoading(false);
    }
  };

  useEffect(() => {
    fetchUserReservations();
  }, []);

  if (loading) return <p>Cargando reservas...</p>;
  if (error) return <p>{error}</p>;

  return (
    <div className="p-4 bg-white rounded-lg shadow-lg max-w-md mx-auto">
      <h2 className="text-2xl font-bold mb-4">Mis Reservas</h2>

      {reservations.length === 0 ? (
        <p>No tienes reservas.</p>
      ) : (
        <ul>
          {reservations.map((reservation) => (
            <li key={reservation.id} className="mb-4 p-4 border rounded-lg bg-gray-100">
              <p>
                <strong>Fecha de entrada:</strong> {new Date(reservation.entry_date).toLocaleString()}
              </p>
              <p>
                <strong>Fecha de salida:</strong> {new Date(reservation.depature_date).toLocaleString()}
              </p>
              <p><strong>Habitaciones:</strong></p>
              <ul className="ml-4">
                {reservation.rooms.map((room) => (
                  <li key={room.id}>
                    Habitación {room.name} - Piso {room.floor_number}
                  </li>
                ))}
              </ul>
            </li>
          ))}
        </ul>
      )}
    </div>
  );
};

export default UserReservations;
