import React from 'react'
import { createPortal } from 'react-dom';
import { useSettingsAnalisisRiesgos } from '../../hooks/AnalisisRiesgo'
import { DndContext, closestCorners, DragOverlay } from '@dnd-kit/core';
import { ContainerInfoTemplate, ContainerSettings, ContainerTableSettigs } from '../../components/custom/analisis-riesgos/Containers';
import { SectionSettigns } from '../../components/custom/analisis-riesgos/Section';
import { BtnSimple } from '../../components/common/Buttons';



const SettingsAnalisisRiesgos = ({templateId}) => {
    const {sections, questions, loadingInfoTemplate,loadingTableSettigns,loadingQuestions, activeSection, activeQuestion, handleDragStart,
        handleDragEnd, handleDragOver, sensors, changeSize, handleSubmit, template, tableSettings, btnSaveSettigns} = useSettingsAnalisisRiesgos(templateId);

    if(loadingInfoTemplate || loadingTableSettigns || loadingQuestions){
        return(<div>Cargando</div>)
    }

  return (
    <form id="generateTemplateSettigns" onSubmit={handleSubmit} style={{display: "flex", flexDirection:"column", justifyContent:"flex-start", alignItems:"flex-start" }}>
        <ContainerInfoTemplate template={template} icon={true}/>
        {
            sections ? (
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
            ):
            <></>
        }

        <ContainerTableSettigs data={tableSettings}/>

        <button ref={btnSaveSettigns} type='submit' style={{visibility:"hidden"}}>Guardar</button>
        {/* <BtnSimple title="Guardar" onClick={handleSubmit}/> */}
        {/* <button onClick={handleSubmit}>Guardar</button> */}
    </form>
  )
}

export default SettingsAnalisisRiesgos
