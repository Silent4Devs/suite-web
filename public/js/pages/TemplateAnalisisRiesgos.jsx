import React from 'react';
import { DndContext, closestCorners, DragOverlay } from '@dnd-kit/core';
import { Container } from '../components/custom/analisis-riesgos/Containers';
import { Section } from '../components/custom/analisis-riesgos/Section';
import { createPortal } from 'react-dom';
import { useAnalisisRiesgo } from '../hooks/AnalisisRiesgo';
import { BtnAddSection } from '../components/custom/analisis-riesgos/Buttons';

const TemplateAnalisisRiesgos = () => {

    const { sections,questions, activeSection, activeQuestion, handleDragStart, handleDragOver, handleDragEnd,
        addSection, addQuestion,deleteQuestion,changeSize,changeQuestionProps,sensors,loading,
        handleSubmit, duplicateQuestion, changeTitle, deleteSection} = useAnalisisRiesgo();

    if(loading){
        return(<div>Cargando</div>)
    }
    return (
    <div style={{display: "flex", flexDirection:"column", justifyContent:"flex-start", alignItems:"flex-start" }}>

        <DndContext sensors={sensors} collisionDetection={closestCorners} onDragEnd={handleDragEnd} onDragStart={handleDragStart} onDragOver={handleDragOver}>

                <Container sections={sections} questions={questions} changeSize={changeSize} deleteQuestion={deleteQuestion}
                changeQuestionProps={changeQuestionProps} duplicateQuestion={duplicateQuestion} changeTitle={changeTitle} deleteSection={deleteSection}/>
                {createPortal(
                    <DragOverlay>
                        {activeSection && (
                        <Section
                            id={activeSection.id}
                            title={activeSection.title}
                            questions={activeSection.questions}
                            changeQuestionProps={changeQuestionProps}

                        />
                        )}
                        {activeQuestion && (
                        <div className="card">
                            <div className="card-body"></div>
                        </div>
                        )}
                    </DragOverlay>,
                    document.body
                )}
        </DndContext>

        <div className="d-flex">
        <BtnAddSection onClick={addQuestion} title="AGREGAR CAMPO NUEVO" icon="add_box"/>
        <BtnAddSection onClick={addSection} title="AGREGAR SECCIÓN" icon="view_agenda"/>
        </div>
        <button onClick={handleSubmit}>Guardar</button>


    </div>
  )
}

export default TemplateAnalisisRiesgos
