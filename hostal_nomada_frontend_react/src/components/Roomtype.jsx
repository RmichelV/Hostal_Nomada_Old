import { useState } from 'react';
import Carrousel from './carrousels/CarrouselHome';  // Asegúrate de tener la ruta correcta
import GetRooms from '../api/roomtypes/GetRooms';

export default function RoomTypesPage() {
    const [roomTypes, setRoomTypes] = useState([]);

    return (
      <div>
        <h1>Room Types</h1>
        <GetRooms setRoomTypes={setRoomTypes} /> {/* Usa el componente GetRooms */}
        <Carrousel roomTypes={roomTypes} />
    </div>
  );
}
