import React, {useState} from 'react';

const Saludo = () => {
    const [first, setFirst] = useState("hola first");
  return (
    <div>
      <h1>Saludo {first}</h1>
      <p>Este es el componente de inicio</p>
      <p>HOLA HOLA</p>
    </div>
  );
};

export default Saludo;
