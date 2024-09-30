import React, { useState } from 'react';
import axios from 'axios';
import NationalitySelect from './NationalitySelect';
import { useNavigate } from 'react-router-dom';
import register from '../styles/components/Register.css'
const Register = () => {
    const [formData, setFormData] = useState({
        name: '',
        last_name: '',
        nationality_id: '',
        identity_number: '',
        birthday: '',
        phone: '',
        email: '',
        password: '',
        confirmPassword: '', 
    });
    
    const [errors, setErrors] = useState({});
    const navigate = useNavigate(); 

    const handleNationalityChange = (event) => {
        const selectedNationality = event.target.value;
        setFormData({ ...formData, nationality_id: selectedNationality });
        console.log('Nacionalidad seleccionada:', selectedNationality);
    };

    const handleChange = (e) => {
        const { name, value } = e.target;
        setFormData({ ...formData, [name]: value });
    };

    const handleSubmit = async (e) => {
        e.preventDefault();
        console.log('Datos del formulario antes de enviar:', formData); 

        if (formData.password !== formData.confirmPassword) {
            setErrors({ confirmPassword: ["Las contraseñas no coinciden."] });
            return; 
        }

        try {
            const response = await axios.post('http://localhost:8000/api/users', formData);
            console.log('Usuario registrado:', response.data);
            localStorage.setItem('userName', formData.name);
            // //nueva modificacion
            // localStorage.setItem('userLastName', formData.name);
            // localStorage.setItem('userBirthday', formData.name);
            // localStorage.setItem('userNationalitiyId', formData.name);
            // localStorage.setItem('userIdentityNumber', formData.name);

            navigate('/');
        } catch (error) {
            console.error('Error en la solicitud:', error); 
            if (error.response && error.response.data.errors) {
                setErrors(error.response.data.errors);
                console.log('Errores:', error.response.data.errors); 
            } else {
                console.error('Error al registrar el usuario:', error);
            }
        }
    };

    return (
        <div className='fondo-register'>
            <div className='fondo-form-register'>
            <h2 className='title-form-register'>Registro de Usuario</h2>
            <form onSubmit={handleSubmit} className='form-register'>

                <div>
                    <label>Nombre:</label>
                    <input
                        className='input-register'
                        type="text"
                        name="name"
                        value={formData.name}
                        onChange={handleChange}
                        required
                    />
                    {errors.name && <p>{errors.name[0]}</p>}
                </div>

                <div>
                    <label>Apellido:</label>
                    <input
                        className='input-register'
                        type="text"
                        name="last_name"
                        value={formData.last_name}
                        onChange={handleChange}
                        required
                    />
                    {errors.last_name && <p>{errors.last_name[0]}</p>}
                </div>

                <div>
                    <label>País de origen:</label>
                    <NationalitySelect onChange={handleNationalityChange} />
                </div>

                <div>
                    <label>Número de Identidad:</label>
                    <input
                        className='input-register'
                        type="text"
                        name="identity_number"
                        value={formData.identity_number}
                        onChange={handleChange}
                        pattern="[0-9]*" // Solo permite números
                    />
                    {errors.identity_number && <p>{errors.identity_number[0]}</p>}
                </div>

                <div>
                    <label>Fecha de Nacimiento:</label>
                    <input
                        className='input-register'
                        type="date"
                        name="birthday"
                        value={formData.birthday}
                        onChange={handleChange}
                        required
                    />
                    {errors.birthday && <p>{errors.birthday[0]}</p>}
                </div>

                <div>
                    <label>Teléfono:</label>
                    <input
                        className='input-register'
                        type="text"
                        name="phone"
                        value={formData.phone}
                        onChange={handleChange}
                        required
                        pattern="[0-9]*" // Solo permite números
                    />
                    {errors.phone && <p>{errors.phone[0]}</p>}
                </div>

                <div>
                    <label>Email:</label>
                    <input
                        className='input-register'
                        type="email"
                        name="email"
                        value={formData.email}
                        onChange={handleChange}
                        required
                    />
                    {errors.email && <p>{errors.email[0]}</p>}
                </div>

                <div>
                    <label>Contraseña:</label>
                    <input
                        className='input-register'
                        type="password"
                        name="password"
                        value={formData.password}
                        onChange={handleChange}
                        required
                    />
                    {errors.password && <p>{errors.password[0]}</p>}
                </div>

                <div>
                    <label>Confirmar Contraseña:</label>
                    <input
                        className='input-register'
                        type="password"
                        name="confirmPassword" 
                        value={formData.confirmPassword}
                        onChange={handleChange}
                        required
                    />
                    {errors.confirmPassword && <p>{errors.confirmPassword[0]}</p>}
                </div>
                <div className='form-button-register'>
                    <button type="submit">Registrar</button>
                </div>
            </form>
            </div>
        </div>
    );
};

export default Register;