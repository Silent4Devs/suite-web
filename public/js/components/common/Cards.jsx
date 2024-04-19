import React , {useRef, useEffect, useState} from 'react'
import { InputSimple } from './Inputs'
import { SelectAnalisisRiesgo } from './Selects'
import { useGenerateTemplateAnalisisRiesgo } from '../../hooks/AnalisisRiesgo';
import TemplateARComponentFactory from '../custom/factory/TemplateARComponentFactory';
import { HrSimple } from './Hr';
import { CSS } from "@dnd-kit/utilities";
import { InputMaker } from '../custom/analisis-riesgos/InputMaker';
import { ContainerMoreInfo, ContainerShowSizes } from '../custom/analisis-riesgos/Popovers';

export const CardTemplateAnalisisRiesgos = ({id, question, changeSize, changeQuestionProps, deleteQuestion}) => {
    const [showSize, setShowSize] = useState(false)
    const [showInfo, setShowInfo] = useState(false)
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
    const {option, handleChangeOption,attributes, listeners, setNodeRef, transform, transition, isDragging, handleTileChange, inputTitle} = useGenerateTemplateAnalisisRiesgo(question, changeQuestionProps);
    const style = {
        transform: CSS.Transform.toString(transform),
        transition,
      };

    const templateARComponentFactory = new TemplateARComponentFactory();
    let templateComponent = ""
    if(option){
        templateComponent = templateARComponentFactory.createTemplateARComponent(option, id, changeQuestionProps);
    }

    const handleShowSizes = () => {
        const flag = !showSize;
        setShowSize(flag)
    }

    const handleChangeSize = (newSize) => {
        changeSize(id, newSize)
        handleShowSizes()

        // console.log("tamaño de question",question.size)
    }

    const moreInfo = () => {
        const flag = !showInfo;
        setShowInfo(flag);
    }

    if (isDragging) {
        return (
          <div
            ref={setNodeRef}
            style={style}
            className={`col-${question.size}`}
          >
            <div className="card">
                <div className="card-body">

                </div>
            </div>

          </div>
        );
      }

  return (
        <div className={`col-12 col-md-${question.size}`} ref={setNodeRef} style={style} >
            <div className="card">
                <div className="card-title">
                <div className="d-flex justify-content-center mt-3">
                <i class="material-symbols-outlined" style={{fontSize:"30px"}} {...attributes} {...listeners}>
                    drag_indicator
                </i>
                </div>
                </div>
                <div className="card-body" style={{paddingTop:"17px", paddingBottom:"17px"}}>
                    <div className=" row d-flex flex-row-reverse">
                        <SelectAnalisisRiesgo options={options} value={option} name="options" size={4} handleChangeOption={handleChangeOption} style={styleSelect} />
                        <InputMaker type={option} id={id} title={question.data.inputTitle} handleTileChange={handleTileChange}/>
                    </div>
                    <div className="row">
                        <div className="col-12">
                            {templateComponent}
                        </div>
                    </div>
                    <HrSimple styles={{width:"100%", borderWidth: "1px", borderColor:"#C5C5C5", marginTop:"40px"}} />

                    <div className="row">
                        <div className="col-12">
                            <div className="d-flex flex-row-reverse align-items-center gap-2">
                                {
                                    showSize ?  (
                                        <ContainerShowSizes handleChangeSize={handleChangeSize}/>
                                    ): (<></>)
                                }
                                <i class="material-symbols-outlined" style={{cursor:"pointer", userSelect:"none"}} onClick={handleShowSizes}>
                                    more_vert
                                </i>
                                {
                                    showInfo ? (<ContainerMoreInfo/>):(<></>)
                                }
                                <span class="material-symbols-outlined" onMouseOver={moreInfo} onMouseOut={moreInfo}>
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
            </div>
        </div>
  )
}
