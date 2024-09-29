import axios from 'axios';

const api = axios.create({
    baseURL:'http://127.0.0.1:8000/api'
});

api.interceptors.response.use(
    response => response,
    error => {
        let errorMessage = 'Error desconocido';

        if (error.response) {
            errorMessage = error.response.data.message || 'Error en la respuesta del servidor';
        } else if (error.request) {
            errorMessage = 'No se recibió respuesta del servidor';
        } else {
            errorMessage = error.message;
        }
        // console.error('Manejo de errores:', errorMessage);
        
        return Promise.reject(new Error(errorMessage));
    }
);



export default api;