// import React, { useState } from 'react';
// import { useNavigate } from 'react-router-dom';
// import api from '../services/api';

// const Login = () => {
//     const [email, setEmail] = useState(''); // Estado para el correo
//     const [password, setPassword] = useState(''); // Estado para la contraseña
//     const [errorMessage, setErrorMessage] = useState(''); // Estado para el mensaje de error
//     const navigate = useNavigate();

//     const handleSubmit = async (e) => {
//         e.preventDefault();

//         try {
//             const response = await api.post('/login', {
//                 email,
//                 password,
//             });

//             localStorage.setItem('token', response.data.token); // Guarda el token
//             navigate('/'); // Redirige a la página de inicio
//         } catch (error) {
//             // Actualiza el estado del mensaje de error
//             setErrorMessage(error.message);
//         }
//     };

//     return (
//         <div>
//             <h2> Iniciar sesión </h2>
//             <form onSubmit={handleSubmit}>
//                 <div>
//                     <label>Correo electrónico</label>
//                     <input
//                         type='text'
//                         placeholder='Ingresa tu correo aquí'
//                         value={email}
//                         onChange={(e) => setEmail(e.target.value)}
//                     />
//                 </div>

//                 <div>
//                     <label>Contraseña</label>
//                     <input
//                         type='password'
//                         placeholder='Ingresa tu contraseña aquí'
//                         value={password}
//                         onChange={(e) => setPassword(e.target.value)}
//                     />
//                 </div>
                
//                 {errorMessage && ( // Muestra el mensaje de error si existe
//                     <div style={{ color: 'red' }}>{errorMessage}</div>
//                 )}

//                 <button type='submit'>Ingresar</button>
//             </form>
//         </div>
//     );
// };

// export default Login;

import React, { useState } from 'react';
import { useNavigate } from 'react-router-dom';
import api from '../services/api';

const Login = () => {
    const [email, setEmail] = useState(''); // Estado para el correo
    const [password, setPassword] = useState(''); // Estado para la contraseña
    const [errorMessage, setErrorMessage] = useState(''); // Estado para el mensaje de error
    const navigate = useNavigate();

    const handleSubmit = async (e) => {
        e.preventDefault();

        try {
            const response = await api.post('/login', {
                email,
                password,
            });

            localStorage.setItem('token', response.data.token); // Guarda el token
            localStorage.setItem('userId', response.data.user.id); // Guarda el ID del usuario
            localStorage.setItem('userName', response.data.user.name); // Guarda el nombre del usuario

            navigate('/'); // Redirige a la página de inicio
        } catch (error) {
            // Actualiza el estado del mensaje de error
            setErrorMessage(error.response ? error.response.data.message : error.message);
        }
    };

    return (
        <div>
            <h2> Iniciar sesión </h2>
            <form onSubmit={handleSubmit}>
                <div>
                    <label>Correo electrónico</label>
                    <input
                        type='text'
                        placeholder='Ingresa tu correo aquí'
                        value={email}
                        onChange={(e) => setEmail(e.target.value)}
                    />
                </div>

                <div>
                    <label>Contraseña</label>
                    <input
                        type='password'
                        placeholder='Ingresa tu contraseña aquí'
                        value={password}
                        onChange={(e) => setPassword(e.target.value)}
                    />
                </div>
                
                {errorMessage && ( // Muestra el mensaje de error si existe
                    <div style={{ color: 'red' }}>{errorMessage}</div>
                )}

                <button type='submit'>Ingresar</button>
            </form>
        </div>
    );
};

export default Login;