import React from 'react';
import Nav from '../styles/components/Nav.css'
import { Link } from 'react-router-dom';

const NavBar = () => {
    return(
        <nav>
            <img 
                src="/images/Logo-HNS.png"
                alt='Logo Hostal Nomada'
                className='img-logo'
            />
            <ul
                class="nav-ul"
            >
                <li className="nav-item">
                    <Link className="nav-link" to="/contact">Contáctanos</Link> {/* Agrega to aquí */}
                </li>
                <li className="nav-item">
                    <Link className="nav-link" to="/rooms">Habitaciones</Link> {/* Agrega to aquí */}
                </li>
                <li className="nav-item">
                    <Link className="nav-link" to="/salons">Salones</Link> {/* Agrega to aquí */}
                </li>
                <li className="nav-item">
                    <Link className="nav-link" to="/services">Servicios</Link> {/* Agrega to aquí */}
                </li>
                <li className="nav-item">
                    <Link className="nav-link" to="/packages">Paquetes</Link> {/* Agrega to aquí */}
                </li>
                <li className="nav-item">
                    <Link className="nav-link" to="/reservations">Reservas</Link> {/* Agrega to aquí */}
                </li>
                <li className="nav-item">
                    <Link className="nav-link" to="/login">Iniciar Sesión</Link> {/* Agrega to aquí */}
                </li>
                <li className="nav-item">
                    <Link className="nav-link" to="/register">Registrarse</Link> {/* Esta línea ya está bien */}
                </li>
            </ul>
            
        </nav>
    );
};

export default NavBar;
