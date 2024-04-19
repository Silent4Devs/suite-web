import React from 'react';
import { DndContext, closestCorners, DragOverlay } from '@dnd-kit/core';
import { Container } from '../components/custom/analisis-riesgos/Containers';
import { Section } from '../components/custom/analisis-riesgos/Section';
import { createPortal } from 'react-dom';
import { useAnalisisRiesgo } from '../hooks/AnalisisRiesgo';

const TemplateAnalisisRiesgos = () => {

    const {sections,questions, activeSection, activeQuestion, handleDragStart, handleDragOver, handleDragEnd, addSection, addQuestion,deleteQuestion,changeSize,changeQuestionProps,sensors} = useAnalisisRiesgo();

    return (
    <div style={{display: "flex", flexDirection:"column", justifyContent:"flex-start", alignItems:"center" }}>

        <DndContext sensors={sensors} collisionDetection={closestCorners} onDragEnd={handleDragEnd} onDragStart={handleDragStart} onDragOver={handleDragOver}>

                <Container sections={sections} questions={questions} changeSize={changeSize} deleteQuestion={deleteQuestion} changeQuestionProps={changeQuestionProps} />
                {createPortal(
                    <DragOverlay>
                        {activeSection && (
                        <Section
                            id={activeSection.id}
                            title={activeSection.title}
                            questions={activeSection.questions}
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

        <button onClick={addSection}>Agregar seccion</button>
        <button onClick={addQuestion}>Agregar Pregunta</button>

    </div>
  )
}

export default TemplateAnalisisRiesgos
