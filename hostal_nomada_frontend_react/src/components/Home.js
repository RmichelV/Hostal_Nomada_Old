import React, { useState } from 'react';
import Principal from './Principal';
import CarrouselHome from './carrousels/CarrouselHome';
import GetRooms from '../api/roomtypes/GetRooms';

const Home = () => {
    const userId = localStorage.getItem('userId'); // Obtiene el ID del usuario
    const userName = localStorage.getItem('userName'); // Obtiene el nombre del usuario
    const [roomTypes, setRoomTypes] = useState([]);

    return (
        <div>
            <Principal/>
            <GetRooms setRoomTypes={setRoomTypes} /> 
            <br></br>
            <CarrouselHome class name="carousel w-full" roomTypes={roomTypes} />

                

            {userId && userName && ( // Solo muestra si existen
                <div>
                    <p>ID del usuario: {userId}</p>
                    <p>Nombre del usuario: {userName}</p>
                </div>
            )}
        </div>
    );
};

export default Home;