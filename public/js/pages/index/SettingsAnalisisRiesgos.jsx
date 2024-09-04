import ReactDOM from 'react-dom/client';
import SettingsAnalisisRiesgos from '../AnalisisRiesgos/SettingsAnalisisRiesgos';

const id = document.getElementById('formulas-analisis-riesgos').getAttribute('data-id');

ReactDOM.createRoot(document.getElementById('settings-analisis-riesgos')).render(<SettingsAnalisisRiesgos templateId={id}/>);
