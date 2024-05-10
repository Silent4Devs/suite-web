import React from 'react'
import { createPortal } from 'react-dom';
import { useSettingsAnalisisRiesgos } from '../../hooks/AnalisisRiesgo'
import { DndContext, closestCorners, DragOverlay } from '@dnd-kit/core';
import { ContainerInfoTemplate, ContainerSettings } from '../../components/custom/analisis-riesgos/Containers';
import { SectionSettigns } from '../../components/custom/analisis-riesgos/Section';
import { TableSettigs } from '../../components/custom/analisis-riesgos/Tables';



const SettingsAnalisisRiesgos = () => {
    const {sections, questions, loading, activeSection, activeQuestion, handleDragStart,
        handleDragEnd, handleDragOver, sensors, changeSize, handleSubmit, template} = useSettingsAnalisisRiesgos();

    if(loading){
        return(<div>Cargando</div>)
    }

  return (
    <div style={{display: "flex", flexDirection:"column", justifyContent:"flex-start", alignItems:"flex-start" }}>
        <ContainerInfoTemplate template={template} icon={true}/>
        <DndContext sensors={sensors} collisionDetection={closestCorners} onDragEnd={handleDragEnd} onDragStart={handleDragStart} onDragOver={handleDragOver}>
                <ContainerSettings sections={sections} questions={questions} changeSize={changeSize} />
                {createPortal(
                    <DragOverlay>
                        {activeSection && (
                        <SectionSettigns
                            id={activeSection.id}
                            title={activeSection.title}
                            questions={activeSection.questions}
                            changeSize={changeSize}
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

        <TableSettigs/>

        <button onClick={handleSubmit}>Guardar</button>
    </div>
  )
}

export default SettingsAnalisisRiesgos
