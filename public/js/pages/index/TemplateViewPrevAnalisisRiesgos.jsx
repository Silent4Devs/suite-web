import ReactDOM from 'react-dom/client';
import { TemplatePrevAnalisisRiesgos } from '../AnalisisRiesgos/TemplatePrevAnalisisRiesgos';

const id = document.getElementById('formulas-analisis-riesgos').getAttribute('data-id');

ReactDOM.createRoot(document.getElementById('template-view-prev-analisis-riesgos')).render(<TemplatePrevAnalisisRiesgos template={id}/>);
