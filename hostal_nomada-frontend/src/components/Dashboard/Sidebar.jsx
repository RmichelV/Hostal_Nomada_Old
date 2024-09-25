import { FaHome, FaUsers, FaHotel } from 'react-icons/fa';

const Sidebar = () => {
  return (
    <div className="sidebar">
      <h2>Hostal Nómada</h2>
      <ul>
        <li><FaHome /> Dashboard</li>
        <li><FaUsers /> Users</li>
        <li><FaHotel /> Reservaciones</li>
      </ul>
    </div>
  );
};

export default Sidebar;
