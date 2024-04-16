import React , {useRef, useEffect} from 'react'
import { InputSimple } from './Inputs'
import { SelectAnalisisRiesgo } from './Selects'
import { useGenerateTemplateAnalisisRiesgo } from '../../hooks/AnalisisRiesgo';
import TemplateARComponentFactory from '../custom/factory/TemplateARComponentFactory';
import { HrSimple } from './Hr';
import { CSS } from "@dnd-kit/utilities";

export const CardTemplateAnalisisRiesgos = ({id, question}) => {

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
    const {option, handleChangeOption,attributes, listeners, setNodeRef, transform, transition, isDragging} = useGenerateTemplateAnalisisRiesgo(question);
    const style = {
        transform: CSS.Transform.toString(transform),
        transition,
      };

    const templateARComponentFactory = new TemplateARComponentFactory();
    let templateComponent = ""
    if(option){
        templateComponent = templateARComponentFactory.createTemplateARComponent(option);
    }

  return (
    // ref={setNodeRef} style={style} {...attributes} {...listeners}
        <div className="col-6" ref={setNodeRef} style={style} {...attributes} {...listeners} >
            <div className="card">
                <div className="card-body">
                    <div className="d-flex flex-row-reverse">
                        <SelectAnalisisRiesgo options={options} name="options" size={4} handleChangeOption={handleChangeOption} />
                        <div className="col-8">
                            {templateComponent}
                        </div>
                    </div>
                    <HrSimple styles={{width:"100%", borderWidth: "1px", borderColor:"#C5C5C5", marginTop:"40px"}} />

                    <div className="d-flex flex-row-reverse">
                        <i onClick={()=>clickDelete(id)} className="text-sm text-red-500 fas fa-trash-alt"/>
                    </div>

                </div>
            </div>
        </div>
  )
}
