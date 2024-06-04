import ReactDOM from 'react-dom/client';
import TemplateAnalisisRiesgos from '../TemplateAnalisisRiesgos';

const id = document.getElementById('template-analisis-riesgos').getAttribute('data-id');

ReactDOM.createRoot(document.getElementById('template-analisis-riesgos')).render(<TemplateAnalisisRiesgos template={id} />);
