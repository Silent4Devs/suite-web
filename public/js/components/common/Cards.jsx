import React , {useRef, useEffect} from 'react'
import { InputSimple } from './Inputs'
import { SelectAnalisisRiesgo } from './Selects'
import { useGenerateTemplateAnalisisRiesgo } from '../../hooks/AnalisisRiesgo';
import TemplateARComponentFactory from '../custom/factory/TemplateARComponentFactory';
import { HrSimple } from './Hr';
export const CardTemplateAnalisisRiesgos = () => {

    const options = [
        {id:"1" , title:'Respuesta corta'},
        {id:"2", title:'Parrafo'},
        {id:"3", title:'Númerico'},
        {id:"4", title:'Catálogo Interno'},
        {id:"5", title:'Varias opciones'},
        {id:"6", title:'Casillas'},
        {id:"7", title:'Desplegable'},
        {id:"8", title:'Fecha'},
        {id:"9", title:'Hora'},
        {id:"10", title:'Imagen'},

    ];
    const {option, handleChangeOption} = useGenerateTemplateAnalisisRiesgo();

    const templateARComponentFactory = new TemplateARComponentFactory();
    let templateComponent = ""
    if(option){
        templateComponent = templateARComponentFactory.createTemplateARComponent(option);
    }

  return (
        <div className="col-12">
            <div className="card">

                <div className="card-body">
                    <div className="d-flex flex-row-reverse">
                        <SelectAnalisisRiesgo options={options} name="options" size={4} handleChangeOption={handleChangeOption} />
                        <div className="col-8">
                            {templateComponent}
                        </div>
                    </div>
                    <HrSimple styles={{width:"100%", borderWidth: "1px", borderColor:"#C5C5C5"}} />

                    {/* <div className="d-flex flex-row-reverse">
                        <i onClick={()=>clickDelete(id)} className="text-sm text-red-500 fas fa-trash-alt"/>
                    </div> */}

                </div>
            </div>
        </div>
  )
}
