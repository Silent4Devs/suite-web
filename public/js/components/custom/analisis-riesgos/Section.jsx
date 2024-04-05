import { useSortable } from '@dnd-kit/sortable'
import { CSS } from '@dnd-kit/utilities';
import React from 'react'
import { CardTemplateAnalisisRiesgos } from '../../common/Cards';

export const Section = ({ id, title, questions }) => {
    console.log(questions);
    const { attributes, listeners, setNodeRef, transform, transition } =
      useSortable({ id });

    const style = {
      transition,
      transform: CSS.Transform.toString(transform),
    };

    return (
      <div
        ref={setNodeRef}
        style={style}
        className="col-12"
      >
        <div className="card">
            <div className="d-flex justify-content-center">
        <button {...attributes} {...listeners}>⣿</button>

            </div>
            <div className="card-body">
                {/* {title} */}
                {questions.map((item)=>{
                    return(
                        <CardTemplateAnalisisRiesgos key={item.id} />
                    )
                })}
            </div>
        </div>
      </div>
    );
  };

