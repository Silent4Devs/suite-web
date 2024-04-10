import React from 'react'
import { Section } from './Section';
import { SortableContext, verticalListSortingStrategy, rectSortingStrategy } from '@dnd-kit/sortable';

export const Container = ({sections, questions}) => {
  return (
    <>
        {sections.map((item) => {
            return(
                <SortableContext items={[...questions, ...sections]} strategy={rectSortingStrategy}>
                    <Section id={item.id} title={item.title} key={item.id} questions={questions.filter(itm => itm.columnId === item.id)}/>
                </SortableContext>
            )
        })}
    </>
  )
}


