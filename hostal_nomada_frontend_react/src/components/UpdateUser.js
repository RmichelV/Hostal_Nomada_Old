import React from 'react';

const UpdateUser = () => {
    const userId = localStorage.getItem('userId');
    const userName = localStorage.getItem('userName'); 

    return (
        <div>
            <h2>Actualizar Información del Usuario</h2>
            {userId && userName && ( 
                <div>
                    <p>ID del usuario: {userId}</p>
                    <p>Nombre del usuario: {userName}</p>
                </div>
            )}
        </div>
    );
};

export default UpdateUser;

