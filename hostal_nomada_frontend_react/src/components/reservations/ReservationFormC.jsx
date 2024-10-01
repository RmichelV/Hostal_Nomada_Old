import { useState, useEffect } from 'react'; 

const ReservationForm = () => {
  const [formData, setFormData] = useState({
    entryDate: '',
    entryTime: '',
    departureDate: '',
    departureTime: '',
    selectedRooms: [],
    room: ''
  });

  const [availableRooms, setAvailableRooms] = useState([]);
  const [loading, setLoading] = useState(false);
  const [errorMessage, setErrorMessage] = useState(null);

  // Función para obtener las habitaciones disponibles
  const fetchAvailableRooms = async () => {
    const { entryDate, entryTime, departureDate, departureTime } = formData;
    if (entryDate && entryTime && departureDate && departureTime) {
      try {
        const response = await fetch('http://127.0.0.1:8000/api/rooms');
        const data = await response.json();
        if (data.status === 200) {
          setAvailableRooms(data.data); // Almacena las habitaciones disponibles
        } else {
          console.error("Error fetching rooms:", data.message);
        }
      } catch (error) {
        console.error("Error fetching available rooms:", error);
      }
    }
  };

  useEffect(() => {
    fetchAvailableRooms();
  }, [formData.entryDate, formData.entryTime, formData.departureDate, formData.departureTime]);

  const handleChange = (e) => {
    setFormData({
      ...formData,
      [e.target.name]: e.target.value,
    });
  };

  const addRoom = () => {
    if (formData.room) {
      setFormData({
        ...formData,
        selectedRooms: [...formData.selectedRooms, formData.room],
        room: '' // Limpiamos el campo para una nueva habitación
      });
    }
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    setLoading(true);
    setErrorMessage(null);

    const reservationData = {
      entry_date: `${formData.entryDate} ${formData.entryTime}`,
      depature_date: `${formData.departureDate} ${formData.departureTime}`,
      rooms: formData.selectedRooms
    };

    try {
      const response = await fetch('http://127.0.0.1:8000/api/reservations', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify(reservationData),
      });

      const result = await response.json();

      if (response.ok) {
        alert('Reserva creada exitosamente');
        // Reiniciar el formulario si es necesario
        setFormData({
          entryDate: '',
          entryTime: '',
          departureDate: '',
          departureTime: '',
          selectedRooms: [],
          room: ''
        });
      } else {
        setErrorMessage(result.message || 'Ocurrió un error al crear la reserva');
      }
    } catch (error) {
      setErrorMessage('Error al crear la reserva,INICIE SESIÓN e intente de nuevo.');
    } finally {
      setLoading(false);
    }
  };

  return (
    <form onSubmit={handleSubmit} className="flex flex-col space-y-4 p-4 bg-white rounded-lg shadow-lg max-w-xs mx-auto">
      <div className="flex space-x-2">
        <div>
          <label>Entrada</label>
          <input
            type="date"
            name="entryDate"
            value={formData.entryDate}
            onChange={handleChange}
            className="p-2 border rounded-lg w-full"
          />
          <input
            type="time"
            name="entryTime"
            value={formData.entryTime}
            onChange={handleChange}
            className="p-2 border rounded-lg w-full mt-2"
          />
        </div>
        <div>
          <label>Salida</label>
          <input
            type="date"
            name="departureDate"
            value={formData.departureDate}
            onChange={handleChange}
            className="p-2 border rounded-lg w-full"
          />
          <input
            type="time"
            name="departureTime"
            value={formData.departureTime}
            onChange={handleChange}
            className="p-2 border rounded-lg w-full mt-2"
          />
        </div>
      </div>

      <div>
        <label>Seleccionar habitación</label>
        <select
          name="room"
          value={formData.room}
          onChange={handleChange}
          className="p-2 border rounded-lg w-full"
        >
          <option value="">Selecciona una habitación disponible</option>
          {availableRooms.map((room) => (
            <option key={room.id} value={room.id}>
              {`Habitación ${room.name} - Piso ${room.floor_number}`}
            </option>
          ))}
        </select>
        <button type="button" onClick={addRoom} className="mt-2 p-2 bg-gray-200 rounded-lg">
          Añadir habitación
        </button>
      </div>

      <ul className="mt-4">
        {formData.selectedRooms.map((room, index) => (
          <li key={index} className="p-2 bg-gray-100 rounded-lg mt-2">
            {room}
          </li>
        ))}
      </ul>

      {errorMessage && <div className="text-red-500">{errorMessage}</div>}

      <button type="submit" className="bg-black text-white p-2 rounded-lg hover:bg-gray-800" disabled={loading}>
        {loading ? 'Enviando...' : 'Crear reserva'}
      </button>
    </form>
  );
};

export default ReservationForm;
