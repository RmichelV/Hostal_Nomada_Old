import { BarChart, Bar, XAxis, YAxis, CartesianGrid, Tooltip, Legend, ResponsiveContainer } from 'recharts';

const data = [
  { day: 'Mon', reserved: 12 },
  { day: 'Tue', reserved: 15 },
  { day: 'Wed', reserved: 8 },
  // Agregar más días...
];

const ReservationsChart = () => {
  return (
    <ResponsiveContainer width="100%" height={300}>
      <BarChart data={data}>
        <CartesianGrid strokeDasharray="3 3" />
        <XAxis dataKey="day" />
        <YAxis />
        <Tooltip />
        <Legend />
        <Bar dataKey="reserved" fill="#8884d8" />
      </BarChart>
    </ResponsiveContainer>
  );
};

export default ReservationsChart;
