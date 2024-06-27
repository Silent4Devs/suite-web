import ReactDOM from 'react-dom/client';

import Saludo from './saludo';


ReactDOM.createRoot(document.getElementById('test')).render(<Saludo/>);

// configuracion en el blade
{/* <>
@viteReactRefresh
    @vite('../public/js/home.jsx')
    <div id="test"></div>
</> */}
