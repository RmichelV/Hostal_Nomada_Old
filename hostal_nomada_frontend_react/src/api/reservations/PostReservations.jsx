import { useState } from 'react';

const PostReservation = () => {
  const [reservationData, setReservationData] = useState({
    user_id: '',
    employee_id: '',
    type: '',            
    res_date: '',        
    entry_date: '',      
    depature_date: '',   
  });

  const handleChange = (e) => {
    setReservationData({
      ...reservationData,
      [e.target.name]: e.target.value
    });
  };

  const handleSubmit = async (e) => {
    e.preventDefault();

    try {
      const response = await fetch('http://127.0.0.1:8000/api/reservations', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'Authorization': `Bearer ${localStorage.getItem('token')}` // Si necesitas autenticación
        },
        body: JSON.stringify(reservationData)
      });

      if (response.ok) {
        const data = await response.json();
        console.log('Reservation created:', data);
        // Manejar el éxito de la creación de la reserva, como redirigir o actualizar el estado
      } else {
        console.error('Failed to create reservation');
      }
    } catch (error) {
      console.error('Error:', error);
    }
  };

  return (
    <form onSubmit={handleSubmit}>
      <div>
        <label>ID del usuario</label>
        <input
          type="text"
          name="user_id"
          value={reservationData.user_id}
          onChange={handleChange}
        />
      </div>
      <div>
        <label>ID del empleado</label>
        <input
          type="text"
          name="employee_id"
          value={reservationData.employee_id}
          onChange={handleChange}
        />
      </div>
      <div>
        <label>Tipo de reserva</label>
        <input
          type="text"
          name="type"
          value={reservationData.type}
          onChange={handleChange}
        />
      </div>
      <div>
        <label>Fecha de la reserva</label>
        <input
          type="date"
          name="res_date"
          value={reservationData.res_date}
          onChange={handleChange}
        />
      </div>
      <div>
        <label>Fecha de entrada</label>
        <input
          type="date"
          name="entry_date"
          value={reservationData.entry_date}
          onChange={handleChange}
        />
      </div>
      <div>
        <label>Fecha de salida</label>
        <input
          type="date"
          name="depature_date"
          value={reservationData.depature_date}
          onChange={handleChange}
        />
      </div>
      <button type="submit">Crear Reserva</button>
    </form>
  );
};

export default PostReservation;
