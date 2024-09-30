// import React from 'react';
// import Nav from '../styles/components/Nav.css'
// import { Link } from 'react-router-dom';

// const NavBar = () => {
//     return(
//         <div>
//             <nav>
//                 <img 
//                     src="/images/Logo-HNS.png"
//                     alt='Logo Hostal Nomada'
//                     className='img-logo'
//                 />
//                 <ul
//                     class="nav-ul"
//                 >
//                     <li className="nav-item">
//                         <Link className="nav-link" to="/contact">Contáctanos</Link> {/* Agrega to aquí */}
//                     </li>
//                     <li className="nav-item">
//                         <Link className="nav-link" to="/rooms">Habitaciones</Link> {/* Agrega to aquí */}
//                     </li>
//                     <li className="nav-item">
//                         <Link className="nav-link" to="/salons">Salones</Link> {/* Agrega to aquí */}
//                     </li>
//                     <li className="nav-item">
//                         <Link className="nav-link" to="/services">Servicios</Link> {/* Agrega to aquí */}
//                     </li>
//                     <li className="nav-item">
//                         <Link className="nav-link" to="/packages">Paquetes</Link> {/* Agrega to aquí */}
//                     </li>
//                     <li className="nav-item">
//                         <Link className="nav-link" to="/reservations">Reservas</Link> {/* Agrega to aquí */}
//                     </li>
//                     <li className="nav-item">
//                         <Link className="nav-link" to="/login">Iniciar Sesión</Link> {/* Agrega to aquí */}
//                     </li>
//                     <li className="nav-item">
//                         <Link className="nav-link" to="/register">Registrarse</Link> {/* Esta línea ya está bien */}
//                     </li>
//                 </ul>
                
//             </nav>


//         </div>

        
//     );
// };

// export default NavBar;


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
        <div>
            <nav>
                <img 
                    src="/images/Logo-HNS.png"
                    alt='Logo Hostal Nomada'
                    className='img-logo'
                />
                <ul className="nav-ul">
                    <li className="nav-item">
                        <Link className="nav-link" to="/contact">Contáctanos</Link>
                    </li>
                    <li className="nav-item">
                        <Link className="nav-link" to="/rooms">Habitaciones</Link>
                    </li>
                    <li className="nav-item">
                        <Link className="nav-link" to="/salons">Salones</Link>
                    </li>
                    <li className="nav-item">
                        <Link className="nav-link" to="/services">Servicios</Link>
                    </li>
                    <li className="nav-item">
                        <Link className="nav-link" to="/packages">Paquetes</Link>
                    </li>
                    <li className="nav-item">
                        <Link className="nav-link" to="/reservations">Reservas</Link>
                    </li>

                    {userName ? ( // Si hay un nombre de usuario, muestra esto
                        <>
                            <li className="nav-item">
                                {/* <span className="nav-user">Hola, {userName}</span> Muestra el nombre del usuario */}
                                <Link className='nav-user' to='/userUpdate'> Hola, {userName}</Link>
                            </li>
                            <li className="nav-item">
                                <button className="nav-link" onClick={handleLogout} >Cerrar Sesión</button> {/* Botón para cerrar sesión */}
                            </li>
                        </>
                    ) : (
                        <>
                            <li className="nav-item">
                                <Link className="nav-link" to="/login">Iniciar Sesión</Link>
                            </li>
                            <li className="nav-item">
                                <Link className="nav-link" to="/register">Registrarse</Link>
                            </li>
                        </>
                    )}
                </ul>
            </nav>
        </div>
    );
};

export default NavBar;