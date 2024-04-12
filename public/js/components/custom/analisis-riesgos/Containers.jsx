import React from 'react'
import { Section } from './Section';
import { SortableContext, verticalListSortingStrategy , rectSortingStrategy, rectSwappingStrategy, horizontalListSortingStrategy } from '@dnd-kit/sortable';

export const Container = ({sections, questions}) => {
  return (
    <>
        <SortableContext items={sections} strategy={verticalListSortingStrategy} >
            {/* <div className="row"> */}
            {sections.map((item) => {
                return(
                            <Section id={item.id} title={item.title} key={item.id} questions={questions.filter(itm => itm.columnId === item.id)}/>
                    )
                })}
            {/* </div> */}
        </SortableContext>
    </>
  )
}


