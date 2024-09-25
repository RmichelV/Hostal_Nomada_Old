import { FaBell, FaSearch } from 'react-icons/fa';

const Header = () => {
  return (
    <header className="header">
      <div className="search-bar">
        <FaSearch />
        <input type="text" placeholder="Search..." />
      </div>
      <div className="user-info">
        <FaBell />
        <span>Austin Robertson (Admin)</span>
      </div>
    </header>
  );
};

export default Header;
