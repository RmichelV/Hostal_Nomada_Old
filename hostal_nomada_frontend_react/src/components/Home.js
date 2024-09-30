import React from 'react';

const Home = () => {
    const userId = localStorage.getItem('userId'); // Obtiene el ID del usuario
    const userName = localStorage.getItem('userName'); // Obtiene el nombre del usuario

    return (
        <div>
            <h2>Esta es mi página principal</h2>
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