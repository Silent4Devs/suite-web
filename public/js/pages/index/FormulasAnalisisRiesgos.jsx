import ReactDOM from 'react-dom/client';
import FormulasAnalisisRiesgos from '../AnalisisRiesgos/FormulasAnalisisRiesgos';

const id = document.getElementById('formulas-analisis-riesgos').getAttribute('data-id');

ReactDOM.createRoot(document.getElementById('formulas-analisis-riesgos')).render(<FormulasAnalisisRiesgos template={id}/>);
