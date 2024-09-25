import { FaUsers, FaBell, FaSearch } from 'react-icons/fa';

const StatCard = ({ title, value, icon, description }) => {
  return (
    <div className="stat-card">
      <div className="icon">{icon}</div>
      <h3>{title}</h3>
      <p>{value}</p>
      <span>{description}</span>
    </div>
  );
};

export default StatCard;
