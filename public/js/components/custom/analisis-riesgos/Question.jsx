import React from 'react'
import { SelectAnalisisRiesgo } from './Selects'
import { useGenerateTemplateAnalisisRiesgo, useSettingsQuestionAnalisisRiesgo } from '../../../hooks/AnalisisRiesgo';
import TemplateARComponentFactory from '../factory/TemplateARComponentFactory';
import { HrSimple } from '../../common/Hr';
import { CSS } from "@dnd-kit/utilities";
import { InputMaker, InputMakerSettings } from './InputMaker';
import { ContainerMoreInfo, ContainerShowSizes } from './Popovers';
import { SwitchObligatory } from './Switches';

export const QuestionTemplateAnalisisRiesgos = ({id, question, changeSize, changeQuestionProps, deleteQuestion, duplicateQuestion}) => {

    const options = [
        {id:"1" , title:'Respuesta corta'},
        {id:"2", title:'Párrafo'},
        {id:"3", title:'Númerico'},
        {id:"4", title:'Catálogo Interno'},
        {id:"5", title:'Varias opciones'},
        {id:"6", title:'Casillas'},
        {id:"7", title:'Desplegable'},
        {id:"8", title:'Fecha'},
        {id:"9", title:'Hora'},
        {id:"10", title:'Imagen'},
        {id:"15", title:"Divisa ($)"}

    ];
    const {option, handleChangeOption,attributes, listeners, setNodeRef, transform, transition,
           isDragging, handleTileChange, showSize, showInfo, handleShowSizes,
           handleChangeSize, moreInfo, handleObligatoryChange} = useGenerateTemplateAnalisisRiesgo(question, changeQuestionProps,changeSize);
    const style = {
        transform: CSS.Transform.toString(transform),
        transition,
    };

    const templateARComponentFactory = new TemplateARComponentFactory();
    let templateComponent = ""
    if(option){
        templateComponent = templateARComponentFactory.createTemplateARComponent(option, id, changeQuestionProps, question.data, handleTileChange, question.isNumeric);
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
                <i className="material-symbols-outlined" style={{fontSize:"30px"}} {...attributes} {...listeners}>
                    drag_indicator
                </i>
                </div>
                </div>
                <div className="card-body" style={{paddingTop:"17px", paddingBottom:"17px"}}>
                    <div className=" row d-flex flex-row-reverse">
                        <SelectAnalisisRiesgo options={options} value={option} name="options" size={4} handleChangeOption={handleChangeOption}  />
                        <InputMaker type={option} id={id} title={question.title} handleTileChange={handleTileChange}/>
                    </div>
                    <div className="row">
                        <div className="col-12">
                            {templateComponent}
                        </div>
                    </div>
                    <HrSimple styles={{width:"100%", borderWidth: "1px", borderColor:"#C5C5C5", marginTop:"40px"}} />

                    <div className="row">
                        <div className="col-12">
                            <div className="d-flex flex-row-reverse flex-wrap align-items-center" style={{gap:"10px 8px"}}>
                                {
                                    showSize ?  (
                                        <ContainerShowSizes handleChangeSize={handleChangeSize}/>
                                    ): (<></>)
                                }
                                <i className="material-symbols-outlined" style={{cursor:"pointer", userSelect:"none"}} onClick={handleShowSizes}>
                                    more_vert
                                </i>

                                <span className="material-icons" style={{color:"#FFBB00",fontVariationSettings:`'FILL' 1`,}} onMouseOver={()=>moreInfo(true)} onMouseOut={()=>moreInfo(false)}>
                                    lightbulb
                                </span>
                                {option === "10" ? (<></>):(
                                    <SwitchObligatory value={question.obligatory} id={id} handleSwitchChange={handleObligatoryChange}/>
                                )}

                                {
                                    showInfo ? (<ContainerMoreInfo/>):(<></>)
                                }
                                {/* <SwitchObligatory value={question.obligatory} id={id} handleSwitchChange={handleObligatoryChange}/> */}
                                <div style={{height:"40px",width:"1px", background:"#C5C5C5"}}></div>
                                <i className="material-symbols-outlined" onClick={()=>deleteQuestion(id)} style={{cursor:"pointer", userSelect:"none"}}>
                                    delete
                                </i>
                                <span className="material-symbols-outlined" onClick={()=>duplicateQuestion(id)}>
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


export const QuestionSettings = ({id, question, changeSize}) => {
    const {showSize, showInfo, handleShowSizes, handleChangeSize, moreInfo, attributes, listeners, setNodeRef, transform,
        transition, isDragging, } = useSettingsQuestionAnalisisRiesgo(question, changeSize)
    const style = {
        transform: CSS.Transform.toString(transform),
        transition,
    };
  return (
    <div className={`col-12 col-md-${question.size}`} ref={setNodeRef} style={style}>
            <div className="card">
                <div className="card-title">
                <div className="d-flex justify-content-center mt-3">
                <i className="material-symbols-outlined" style={{fontSize:"30px"}} {...attributes} {...listeners}>
                    drag_indicator
                </i>
                </div>
                </div>
                <div className="card-body" style={{paddingTop:"17px", paddingBottom:"17px"}}>
                    {/* <div className="row"> */}
                        <InputMakerSettings question={question}/>
                    {/* </div> */}
                    <div className="row">
                        <div className="col-12">
                            <div className="d-flex flex-row-reverse flex-wrap align-items-center" style={{gap:"10px 8px"}}>
                                {
                                    showSize ?  (
                                        <ContainerShowSizes handleChangeSize={handleChangeSize}/>
                                    ): (<></>)
                                }
                                <i className="material-symbols-outlined" style={{cursor:"pointer", userSelect:"none"}} onClick={handleShowSizes}>
                                    more_vert
                                </i>

                                <span className="material-icons" style={{color:"#FFBB00",fontVariationSettings:`'FILL' 1`,}} onMouseOver={()=>moreInfo(true)} onMouseOut={()=>moreInfo(false)}>
                                    lightbulb
                                </span>
                                {
                                    showInfo ? (<ContainerMoreInfo/>):(<></>)
                                }
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
  )
}

export const QuestionViewPrev =({question}) => {
    return(
        <div className={`col-12 col-md-${question.size}`} >
            <div className="card">
                <div className="card-body" style={{paddingTop:"17px", paddingBottom:"17px"}}>
                    <InputMakerSettings question={question}/>
                </div>
            </div>
        </div>
    )
}
