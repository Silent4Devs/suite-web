import { SortableContext, useSortable, rectSwappingStrategy, rectSortingStrategy, verticalListSortingStrategy, horizontalListSortingStrategy } from '@dnd-kit/sortable'
import { CSS } from '@dnd-kit/utilities';
import React from 'react'
import { CardTemplateAnalisisRiesgos } from '../../common/Cards';
import Item from './Item';

export const Section = ({ id, title, questions, setQuestions, chanceQuestionSize }) => {
    const { attributes, listeners, setNodeRef, transform, transition, isDragging } =
      useSortable({ id, data: {
        type: "Section",
        title,
        questions,
        id}
    });

    const style = {
      transform: CSS.Transform.toString(transform),
      transition,
    //   border:"solid 1px black",
    //   marginBottom:"30px",
    //   minHeight:"200px",
    //   height:"auto",
      width:"100%",
    //   background:"green",
    // flexWrap: "wrap"

    };

    if (isDragging) {
        return (
          <div
            ref={setNodeRef}
            style={style}
          >
            <div className="card m-0 p-0">
                <div className="card-body "></div>
            </div>

          </div>
        );
      }

    return (
      <div
        ref={setNodeRef}
        style={style}
        // {...attributes}
        // {...listeners}
        className="card"
      >
        <div className="card-title">
            <div className="d-flex justify-content-center">
    <button {...attributes} {...listeners}>⣿</button>

        </div>
        </div>
                <div className='card-body' >
                    <div className="row">
                <SortableContext items={questions} strategy={rectSortingStrategy}>
                    {questions.map((item)=>{
                            return(
                                <CardTemplateAnalisisRiesgos key={item.id} id={item.id} question={item}/>
                                    // <Item key={item.id} id={item.id} size={item.size} setQuestions={setQuestions} questions={questions} chanceQuestionSize={chanceQuestionSize}/>
                            )
                        })}

                </SortableContext>
                    </div>
                </div>
      </div>
    );
  };

