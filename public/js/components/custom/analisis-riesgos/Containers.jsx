import React from 'react';
import { Section } from './Section';
import { SortableContext, verticalListSortingStrategy } from '@dnd-kit/sortable';

export const Container = ({sections, questions, changeSize, deleteQuestion, changeQuestionProps}) => {
  return (
    <>
        <SortableContext items={sections} strategy={verticalListSortingStrategy} >
            {sections.map((item) => {
                return(
                        <Section id={item.id} title={item.title} key={item.id} questions={questions.filter(itm => itm.columnId === item.id)} changeSize={changeSize} changeQuestionProps={changeQuestionProps} deleteQuestion={deleteQuestion} />
                    )
                })}
        </SortableContext>
    </>
  )
}
