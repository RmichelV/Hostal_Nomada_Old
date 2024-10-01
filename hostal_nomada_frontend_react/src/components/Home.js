import React from 'react';

const Home = () => {
    const userId = localStorage.getItem('userId'); 
    const userName = localStorage.getItem('userName'); 

    return (
        <div>
            <h2>Esta es mi página principal</h2>
            {userId && userName && ( 
                <div>
                    <p>ID del usuario: {userId}</p>
                    <p>Nombre del usuario: {userName}</p>
                </div>
            )}
        </div>
    );
};

export default Home;