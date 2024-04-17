import React , {useRef, useEffect, useState} from 'react'
import { InputSimple } from './Inputs'
import { SelectAnalisisRiesgo } from './Selects'
import { useGenerateTemplateAnalisisRiesgo } from '../../hooks/AnalisisRiesgo';
import TemplateARComponentFactory from '../custom/factory/TemplateARComponentFactory';
import { HrSimple } from './Hr';
import { CSS } from "@dnd-kit/utilities";
import { InputMaker } from '../custom/analisis-riesgos/InputMaker';

export const CardTemplateAnalisisRiesgos = ({id, question, deleteQuestion}) => {
    const [showSize, setShowSize] = useState(false)
    const [divPosition, setDivPosition] = useState({ top: 0, left: 0 });
    const styleSelect = {background: "#F8FAFC"}
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
        templateComponent = templateARComponentFactory.createTemplateARComponent(option, id);
    }

    const handleShowSizes = (e) => {
        const buttonRect = e.target.getBoundingClientRect();
        console.log(buttonRect)
        const flag = !showSize;
        setShowSize(flag)
        setDivPosition({
            top: buttonRect.bottom, // Alinea el div al fondo del botón
            left: buttonRect.left // Alinea el div a la izquierda del botón
          });
    }

  return (
    // ref={setNodeRef} style={style} {...attributes} {...listeners}
        <div className="col-12" ref={setNodeRef} style={style} >
            <div className="card">
                <div className="card-title">
                <div className="d-flex justify-content-center mt-3">
                <i class="material-symbols-outlined" style={{fontSize:"30px"}} {...attributes} {...listeners}>
                    drag_indicator
                </i>
                </div>
                </div>
                <div className="card-body" style={{paddingTop:"17px", paddingBottom:"17px"}}>
                    <div className="d-flex flex-row-reverse">
                        <SelectAnalisisRiesgo options={options} name="options" size={4} handleChangeOption={handleChangeOption} style={styleSelect} />
                        <InputMaker type={option} id={id}/>
                    </div>
                    <div className="row">
                        <div className="col-12">
                            {templateComponent}
                        </div>
                    </div>
                    <HrSimple styles={{width:"100%", borderWidth: "1px", borderColor:"#C5C5C5", marginTop:"40px"}} />

                    <div className="d-flex flex-row-reverse align-items-center gap-2">
                        {
                            showSize ?  (
                                <div  style={{
                                    position:"absolute",
                                    minWidth: "112px",
                                    height: "148px",
                                    right:60,
                                   background: "#FFFFFF 0% 0% no-repeat padding-box",
                                   boxShadow: "0px 3px 3px #0000001A",
                                   borderRadius: "9px",
                                   opacity: 1,
                                   padding:"10px",
                                  }}>
                                    <p className='m-0'>Tamaño</p>
                                    <div style={{width: "100%",
                                        height: "17px",background: "#C3EBC1 0% 0% no-repeat padding-box",
                                        opacity: 1, marginBottom:10}}>

                                    </div>
                                    <div className="d-flex" style={{gap:"5px"}}>
                                    <div style={{width: "75%",
                                        height: "17px",background: "#C3EBC1 0% 0% no-repeat padding-box",
                                        opacity: 1,  marginBottom:10}}></div>
                                    <div style={{width: "25%",
                                        height: "17px",background: "#CCCCCC 0% 0% no-repeat padding-box",
                                        opacity: 1,  marginBottom:10}}></div>
                                    </div>
                                    <div className="d-flex" style={{gap:"5px"}}>
                                    <div style={{width: "50%",
                                        height: "17px",background: "#C3EBC1 0% 0% no-repeat padding-box",
                                        opacity: 1,  marginBottom:10,}}></div>
                                        <div style={{width: "50%",
                                        height: "17px",background: "#CCCCCC 0% 0% no-repeat padding-box",
                                        opacity: 1,  marginBottom:10}}></div>
                                    </div>
                                    <div className="d-flex" style={{gap:"5px"}}>
                                    <div style={{width: "25%",
                                        height: "17px",background: "#C3EBC1 0% 0% no-repeat padding-box",
                                        opacity: 1,  marginBottom:10}}></div>
                                        <div style={{width: "25%",
                                        height: "17px",background: "#CCCCCC 0% 0% no-repeat padding-box",
                                        opacity: 1,  marginBottom:10}}></div>
                                        <div style={{width: "25%",
                                        height: "17px",background: "#CCCCCC 0% 0% no-repeat padding-box",
                                        opacity: 1,  marginBottom:10}}></div>
                                        <div style={{width: "25%",
                                        height: "17px",background: "#CCCCCC 0% 0% no-repeat padding-box",
                                        opacity: 1,  marginBottom:10}}></div>
                                    </div>
                                  </div>
                            ): (<></>)
                        }
                        <i class="material-symbols-outlined" style={{cursor:"pointer", userSelect:"none"}} onClick={handleShowSizes}>
                            more_vert
                        </i>
                        <span class="material-symbols-outlined">
                            lightbulb
                        </span>
                        <div style={{height:"40px",width:"1px", background:"#C5C5C5"}}></div>
                        <i class="material-symbols-outlined" onClick={()=>deleteQuestion(id)} style={{cursor:"pointer", userSelect:"none"}}>
                            delete
                        </i>
                        <span class="material-symbols-outlined">
                            content_copy
                        </span>
                    </div>

                </div>
            </div>
        </div>
  )
}
