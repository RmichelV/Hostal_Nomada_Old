import React from 'react';
import { Link, useNavigate } from 'react-router-dom';
import '../styles/components/Nav.css'; // Asegúrate de que la ruta sea correcta

const NavBar = () => {
    const navigate = useNavigate();
    const userName = localStorage.getItem('userName'); // Obtiene el nombre del usuario

    const handleLogout = () => {
        localStorage.removeItem('token'); // Elimina el token
        localStorage.removeItem('userId'); // Elimina el ID del usuario
        localStorage.removeItem('userName'); // Elimina el nombre del usuario
        navigate('/'); // Redirige a la página de inicio de sesión
    };

    return (
        <div id='nav' className="navbar bg-base-100">
            <div className="navbar-start">
                <div className="dropdown">
                    <div tabIndex={0} role="button" className="btn btn-ghost lg:hidden">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            className="h-5 w-5"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path
                                strokeLinecap="round"
                                strokeLinejoin="round"
                                strokeWidth="2"
                                d="M4 6h16M4 12h8m-8 6h16" />
                        </svg>
                    </div>
                    <ul
                        tabIndex={0}
                        className="menu menu-sm dropdown-content bg-base-100 rounded-box z-[1] mt-3 w-52 p-2 shadow">
                        <li><Link to="/contact">Contáctanos</Link></li>
                        <li tabIndex={0}>
                            <a>Habitaciones</a>
                            <ul className="p-2">
                                <li><Link to="/rooms">Habitaciones</Link></li>
                                <li><Link to="/salons">Salones</Link></li>
                            </ul>
                        </li>
                        <li><Link to="/services">Servicios</Link></li>
                        <li><Link to="/packages">Paquetes</Link></li>
                        {userName ? (
                            <>
                                <li className='user'><Link to="/userUpdate">Hola, {userName}</Link></li>
                                <li className='user'><button className="nav-link" onClick={handleLogout}>Cerrar Sesión</button></li>
                                <li className='user'><Link to="/reservations">Reservas</Link></li>

                            </>
                        ) : (
                            <>
                                <li className='user'><Link to="/login">Iniciar Sesión</Link></li>
                                <li className='user'><Link to="/register">Registrarse</Link></li>
                            </>
                        )}
                    </ul>
                </div>
                <Link to="/"><img 
                    src="/images/Logo-HNS.png"
                    alt='Logo Hostal Nomada'
                    className='img-logo'
                /></Link>
                
            </div>
            <div className="navbar-center hidden lg:flex">
                <ul className="menu menu-horizontal px-1">
                    <li><Link to="/contact">Contáctanos</Link></li>
                    <li>
                        <details>
                            <summary>Habitaciones</summary>
                            <ul className="p-2">
                                <li><Link to="/rooms">Habitaciones</Link></li>
                                <li><Link to="/salons">Salones</Link></li>
                            </ul>
                        </details>
                    </li>
                    <li><Link to="/services">Servicios</Link></li>
                    <li><Link to="/packages">Paquetes</Link></li>
                    {/* <li><Link to="/reservations">Reservas</Link></li> */}
                    {/* {userName ? (
                        <>
                            <li className="user"><Link to="/userUpdate">Hola, {userName}</Link></li>
                            <li className="user"><button className="nav-link" onClick={handleLogout}>Cerrar Sesión</button></li>
                        </>
                    ) : (
                        <>
                            <li className="user"><Link to="/login">Iniciar Sesión</Link></li>
                            <li className="user"><Link to="/register">Registrarse</Link></li>
                        </>
                    )} */}
                </ul>
            </div>
            <div className="navbar-end">
            <ul className="menu menu-horizontal px-1">
            {userName ? (
                        <>
                            <li className="user"><Link to="/userUpdate">Hola, {userName}</Link></li>
                            <li className="user"><button className="nav-link" onClick={handleLogout}>Cerrar Sesión</button></li>
                            <li className='user'><Link to="/reservations">Reservas</Link></li>

                        </>
                    ) : (
                        <>
                            <li className="user"><Link to="/login">Iniciar Sesión</Link></li>
                            <li className="user"><Link to="/register">Registrarse</Link></li>
                        </>
                    )}
                    </ul>
            </div>
        </div>
    );
};

export default NavBar;
