const ActivityList = ({ activities }) => {
    return (
      <div className="activity-list">
        <h3>Activity Overview</h3>
        <ul>
          {activities.map((activity, index) => (
            <li key={index}>
              <span>{activity.description}</span>
              <time>{activity.time}</time>
            </li>
          ))}
        </ul>
      </div>
    );
  };
  
  export default ActivityList;
  