import React from 'react';
import { BrowserRouter as Router, Route, Routes } from 'react-router-dom';

import NationalitySelect from './components/NationalitySelect';
import Navbar from './components/NavBar';
import Register from './components/Register';
import Login from './components/Login';
import Home from './components/Home';
import UserUpdate from './components/UpdateUser';
function App() {
    // const handleNationalityChange = (event) => {
    //     const selectedNationality = event.target.value;
    //     console.log('Nacionalidad seleccionada:', selectedNationality);
    // };

    return (
        <div>
            {/* <NationalitySelect onChange={handleNationalityChange} /> */}

            <Router>
                <div>
                    <Navbar />
                    <Routes>
                        <Route path="/" element={<Home />} /> 
                        <Route path="/register" element={<Register />} />
                        <Route path="/login" element={<Login />} />
                        <Route path="/userUpdate" element={<UserUpdate />} />
                    </Routes>
                </div>
            </Router>
        </div>


    );
};

export default App;