import { PieChart, Pie, Cell, Tooltip } from 'recharts';

const data = [
  { name: 'Fashion', value: 251000 },
  { name: 'Accessories', value: 170000 },
];

const COLORS = ['#0088FE', '#00C49F'];

const EarningsChart = () => {
  return (
    <PieChart width={200} height={200}>
      <Pie
        data={data}
        cx={100}
        cy={100}
        innerRadius={60}
        outerRadius={80}
        fill="#8884d8"
        paddingAngle={5}
        dataKey="value"
      >
        {data.map((entry, index) => (
          <Cell key={`cell-${index}`} fill={COLORS[index % COLORS.length]} />
        ))}
      </Pie>
      <Tooltip />
    </PieChart>
  );
};

export default EarningsChart;
