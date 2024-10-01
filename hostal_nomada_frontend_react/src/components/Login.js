import React, { useState } from 'react';
import { useNavigate } from 'react-router-dom';
import api from '../services/api';
import login from '../styles/components/Login.css'

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
        <div className='fondo-login'>
            
            <div className='fondo-form-login'>
                <h2 className='title-form-login'> Bienvenid@ </h2>
                <form onSubmit={handleSubmit} className='form-login'>
                    <div>
                        {/* <label>Correo electrónico</label> */}
                        <input
                            className='input-login'
                            type='text'
                            placeholder='Ingresa tu correo electrónico aquí'
                            value={email}
                            onChange={(e) => setEmail(e.target.value)}
                        />
                    </div>

                    <div>
                        {/* <label>Contraseña</label> */}
                        <input
                            className='input-login'
                            type='password'
                            placeholder='Ingresa tu contraseña aquí'
                            value={password}
                            onChange={(e) => setPassword(e.target.value)}
                        />
                    </div>
                    
                    {errorMessage && ( // Muestra el mensaje de error si existe
                        <div style={{ color: 'red' }}>{errorMessage}</div>
                    )}
                    <div className='form-button-login'>
                        <button type='submit'>Ingresar</button>
                    </div>
                </form>
            </div>
        </div>
    );
};

export default Login;