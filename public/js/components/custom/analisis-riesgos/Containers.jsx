import React, { useState } from 'react';
import { Section, SectionSettigns } from './Section';
import { SortableContext, verticalListSortingStrategy } from '@dnd-kit/sortable';
import { CardContainer } from '../../common/Containers';
import "../../../../css/templateAnalisisRiesgo/containerTemplate.css";
import { BtnIcon } from '../../common/Buttons';
import { PopoverTableSettings, PopoverTemplateSettings } from './Popovers';
import { HrSimple } from '../../common/Hr';
import {TableSettigs} from '../analisis-riesgos/Tables.jsx'
import { RegisterNotFound } from '../../common/RegistersNotFound.jsx';

export const Container = ({sections, questions, changeSize, deleteQuestion, changeQuestionProps,
                            duplicateQuestion,  changeTitle, deleteSection}) => {
  return (
    <>
        <SortableContext items={sections} strategy={verticalListSortingStrategy} >
            {sections.map((item) => {
                return(
                        <Section id={item.id} title={item.title} key={item.id} position={item.position}
                        questions={questions.filter(itm => itm.columnId === item.id)}
                        changeSize={changeSize} changeQuestionProps={changeQuestionProps}
                        deleteQuestion={deleteQuestion} duplicateQuestion={duplicateQuestion}
                        changeTitle={ changeTitle} deleteSection={deleteSection}/>
                    )
                })}
        </SortableContext>
    </>
  )
}

export const ContainerSettings = ({sections, questions, changeSize}) => {
    return (
        <>
            <SortableContext items={sections} strategy={verticalListSortingStrategy} >
                {sections.map((item) => {
                    return(
                            <SectionSettigns id={item.id} title={item.title} key={item.id}
                            questions={questions.filter(itm => itm.columnId === item.id)}
                            changeSize={changeSize} />
                        )
                    })}
            </SortableContext>
        </>
      )
}

export const ContainerInfoTemplate = ({template, icon=false}) => {
    const [showInfo, setShowInfo] = useState(false);
    const handleInfo = () => {
        setShowInfo(!showInfo);
    }
    return(
        <CardContainer width="100%">
            {icon ? (
                <div style={{position:"absolute", right:30, top:22}}>
                    <BtnIcon icon="lightbulb" colorIcon="#FFBB00" sizeIcon={29} fill={true} onClick={handleInfo} family='material-icons'/>
                    {showInfo ? <PopoverTemplateSettings/>:<></>}
                </div>
            ): <></> }
            <h4 className='template-title' style={{marginTop:'33px'}}>{template.title}</h4>
            <p className='template-norma'>{template.norma}</p>
            <p className='template-description'>{template.description}</p>
        </CardContainer>
    )
}

export const ContainerTableSettigs = ({data}) => {
    const [showInfo, setShowInfo] = useState(false);
    const handleInfo = () => {
        setShowInfo(!showInfo);
    }
    return(
        <CardContainer width="100%">
            <div className="row d-flex align-items-center">
                <div className="col-10">
                    <h6 className='mb-0'>Respuestas</h6>
                </div>
                <div className="col-2 d-flex justify-content-end" style={{paddingRight:"2px"}}>
                    <BtnIcon icon="lightbulb" colorIcon="#FFBB00" sizeIcon={29} onClick={handleInfo} family='material-icons' />
                    {showInfo ? <PopoverTableSettings/>:<></>}
                </div>
            </div>
            <HrSimple/>
            {
                data.questions.length >= 1 || data.formulas.length >= 1 ? (<TableSettigs data={data}/>) : (<RegisterNotFound/>)
            }
        </CardContainer>
    )
}
