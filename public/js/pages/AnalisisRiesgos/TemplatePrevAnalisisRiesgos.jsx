import React from 'react'
import { useTemplateViewPrevAnalisisRiesgo } from '../../hooks/AnalisisRiesgo'
import { ContainerInfoTemplate } from '../../components/custom/analisis-riesgos/Containers';
import { SectionViewPrev } from '../../components/custom/analisis-riesgos/Section';

export const TemplatePrevAnalisisRiesgos = () => {
    const {loading,sections,questions,template} = useTemplateViewPrevAnalisisRiesgo();
    // console.log(questions)

    if(loading){
        return(<div>Cargando</div>)
    }

  return (
    <div>
         <ContainerInfoTemplate template={template} />
         {sections.map((item) => {
            return(
                <SectionViewPrev id={item.id} title={item.title} key={item.id}questions={questions.filter(itm => itm.columnId === item.id)}/>
            )
        })}
    </div>
  )
}
