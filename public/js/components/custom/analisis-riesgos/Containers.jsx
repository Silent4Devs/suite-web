import React, { useState } from 'react';
import { Section, SectionSettigns } from './Section';
import { SortableContext, verticalListSortingStrategy } from '@dnd-kit/sortable';
import { CardContainer } from '../../common/Containers';
import "../../../../css/templateAnalisisRiesgo/containerTemplate.css";
import { BtnIcon } from '../../common/Buttons';
import { PopoverTemplateSettings } from './Popovers';
import { HrSimple } from '../../common/Hr';
import {TableSettigs} from '../analisis-riesgos/Tables.jsx'

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
                <div className='d-flex justify-content-end'>
                    <BtnIcon icon="lightbulb_circle" colorIcon="#006DDB" sizeIcon={29} fill={true} onClick={handleInfo}/>
                    {showInfo ? <PopoverTemplateSettings/>:<></>}
                </div>
            ): <></> }
            <h2 className='template-title'>{template.title}</h2>
            <p className='template-norma'>{template.norma}</p>
            <p className='template-description'>{template.description}</p>
        </CardContainer>
    )
}

export const ContainerTableSettigs = ({data}) => {
    return(
        <CardContainer width="100%">
            <div className="row d-flex align-items-center">
                <div className="col-10">
                    <h6 className='mb-0'>Respuestas</h6>
                </div>
                <div className="col-2 d-flex justify-content-end" style={{paddingRight:"2px"}}>
                    <BtnIcon icon="lightbulb_circle"/>
                </div>
            </div>
            <HrSimple/>
            <TableSettigs/>
        </CardContainer>
    )
}
