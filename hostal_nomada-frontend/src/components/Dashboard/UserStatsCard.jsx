const UserStatsCard = ({ title, value }) => {
    return (
      <div className="user-stats-card">
        <h3>{title}</h3>
        <p>{value}</p>
      </div>
    );
  };
  
  export default UserStatsCard;
  