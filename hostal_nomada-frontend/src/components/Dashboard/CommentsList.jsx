const CommentsList = ({ comments }) => {
    return (
      <div className="comments-list">
        <h3>Comentarios Sobresalientes</h3>
        <ul>
          {comments.map((comment, index) => (
            <li key={index}>
              <p>{comment.text}</p>
              <span>{comment.user}</span>
              <progress value={comment.completion} max="100">{comment.completion}%</progress>
            </li>
          ))}
        </ul>
      </div>
    );
  };
  
  export default CommentsList;
  