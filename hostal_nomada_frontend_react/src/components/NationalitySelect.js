import React, { useEffect, useState } from 'react';
import api from '../services/api';

const NationalitySelect = ({ onChange }) => {
    const [nationalities, setNationalities] = useState([]);
    const [error, setError] = useState(null);

    useEffect(() => {
        const fetchNationalities = async () => {
            try {
                const response = await api.get('/nationalities');
                // Ordena las nacionalidades en orden alfabético por el nombre
                const sortedNationalities = response.data.nationalities.sort((a, b) => {
                    if (a.name < b.name) return -1;
                    if (a.name > b.name) return 1;
                    return 0;
                });
                setNationalities(sortedNationalities); // Establece el array ordenado
            } catch (err) {
                setError(err.message);
            }
        };
    
        fetchNationalities();
    }, []);

    if (error) {
        return <div>Error: {error}</div>; // Muestra el error si ocurre
    }

    // Comprueba si nationalities es un array
    if (!Array.isArray(nationalities)) {
        return <div>Cargando nacionalidades...</div>; // Mensaje de carga
    }

    return (
        <select onChange={onChange}>
            <option value="">Seleccione una nacionalidad</option>
            {nationalities.map(nationality => (
                <option key={nationality.id} value={nationality.id}>
                    {nationality.name}
                </option>
            ))}
        </select>
    );
};

export default NationalitySelect;