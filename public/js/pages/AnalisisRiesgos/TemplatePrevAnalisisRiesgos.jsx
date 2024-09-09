import React from 'react'
import { useTemplateViewPrevAnalisisRiesgo } from '../../hooks/AnalisisRiesgo'
import { ContainerInfoTemplate } from '../../components/custom/analisis-riesgos/Containers';
import { SectionViewPrev } from '../../components/custom/analisis-riesgos/Section';

export const TemplatePrevAnalisisRiesgos = ({templateId}) => {
    const {loadingInfoTemplate, loadingQuestions,sections,questions,template} = useTemplateViewPrevAnalisisRiesgo(templateId);
    if(loadingInfoTemplate || loadingQuestions){
        return (
            <>Cargando</>
        )
    }
  return (
      <div>
        <ContainerInfoTemplate template={template}/>
        {
            sections ? (
                <>
                    {sections.map((item) => {
                        return(
                            <SectionViewPrev id={item.id} title={item.title} key={item.id}questions={questions.filter(itm => itm.columnId === item.id)}/>
                        )
                    })}
                </>
            ) : <></>
        }
    </div>
  )
}
