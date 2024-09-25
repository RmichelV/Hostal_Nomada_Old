import Sidebar from './Dashboard/Sidebar';
import Header from './Dashboard/Header';
import StatCard from './Dashboard/StatCard';
import SalesChart from './Dashboard/SalesChart';
import EarningsChart from './Dashboard/EarningsChart';
import ReservationsChart from './Dashboard/ReservationsChart';
import CommentsList from './Dashboard/CommentsList';
import CreditCard from './Dashboard/CreditCard';
import ActivityList from './Dashboard/ActivityList';
import UserStatsCard from './Dashboard/UserStatsCard';
import { FaUsers, FaBell, FaSearch } from 'react-icons/fa';

const comments = [
    { text: 'Buen servicio.', user: 'SP, FM, MM', completion: 60 },
    { text: 'Habitaciones limpias.', user: 'SR, MM', completion: 25 },
    { text: 'Excelente atención.', user: 'PP, TP', completion: 100 },
    { text: 'Volveremos pronto.', user: 'SP, MM', completion: 100 },
    { text: 'Agradable ambiente.', user: 'MM', completion: 75 }
  ];
  const activities = [
    { description: '$2400, Purchase', date: '11 Jul, 8:10 PM' },
    { description: 'New order #8744152', date: '11 Jul, 11 PM' },
    { description: 'Affiliate Payout', date: '11 Jul, 7:64 PM' },
    { description: 'New user added', date: '11 Jul, 1:21 AM' },
    { description: 'Product added', date: '11 Jul, 4:50 AM' }]  
const Dashboard = () => {
  return (
    <div className="dashboard">
      <Sidebar />
      <div className="main-content">
        <Header />
        <div className="stats">
          <StatCard title="Total de Huéspedes" value="15" icon={<FaUsers />} description="This month" />
          {/* Más StatCards */}
        </div>
        <SalesChart />
        <EarningsChart />
        <ReservationsChart />
        <CommentsList comments={comments} />
        <CreditCard cardNumber="5789 **** 2847" name="Mike Smith" balance="12,300" />
        <ActivityList activities={activities} />
        <UserStatsCard title="Total Usuarios" value="750" />
        <UserStatsCard title="Nuevos Usuarios" value="20" />
      </div>
    </div>
  );
};

export default Dashboard;
