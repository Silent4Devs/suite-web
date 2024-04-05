export const Question = ({ id, content }) => {
    return (
      <div
        style={{
          border: '1px solid #ccc',
          borderRadius: '4px',
          padding: '8px',
          marginBottom: '4px',
          cursor: 'grab',
        }}
        data-id={id}
      >
        {content}
      </div>
    );
  };
