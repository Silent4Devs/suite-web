import React from 'react'
import { Section } from './Section';
import { Question } from './Question';
import { SortableContext, verticalListSortingStrategy } from '@dnd-kit/sortable';

export const Columns = ({sections,questions}) => {
  return (
    // <div className="column">
      <SortableContext items={sections} strategy={verticalListSortingStrategy}>
        {sections.map((item)=>{
            return(
                // <div className="col-12">
                    <Section id={item.id} title={item.title} key={item.id} questions={questions.filter(itm => itm.columnId === item.id)}/>
                // </div>
            )
        })}
      </SortableContext>
    // </div>
  )
}


