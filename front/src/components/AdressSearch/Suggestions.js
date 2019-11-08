import React from 'react';

const Suggestions = ({ results }) => {
  const options = results.map((r) => <li key={r.id}>{r.name}</li>);
  return <ul>{results}</ul>;
};

export default Suggestions;
