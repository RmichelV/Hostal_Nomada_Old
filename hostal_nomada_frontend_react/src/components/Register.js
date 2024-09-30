import React, { useState } from 'react';
import axios from 'axios';
import NationalitySelect from './NationalitySelect';
import { useNavigate } from 'react-router-dom';

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
        <form onSubmit={handleSubmit}>
            <h2>Registro de Usuario</h2>

            <div>
                <label>Nombre:</label>
                <input
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
                    type="password"
                    name="confirmPassword" 
                    value={formData.confirmPassword}
                    onChange={handleChange}
                    required
                />
                {errors.confirmPassword && <p>{errors.confirmPassword[0]}</p>}
            </div>

            <button type="submit">Registrar</button>
        </form>
    );
};

export default Register;