import { useSortable } from '@dnd-kit/sortable'
import { CSS } from '@dnd-kit/utilities';
import React from 'react'
import { CardTemplateAnalisisRiesgos } from '../../common/Cards';
import Item from './Item';

export const Section = ({ id, title, questions }) => {
    const { attributes, listeners, setNodeRef, transform, transition } =
      useSortable({ id, data: {
        type: "Section"} });

    const style = {
      transform: CSS.Transform.toString(transform),
      transition,
    };

    return (
      <div
        ref={setNodeRef}
        style={style}
        {...attributes}
        {...listeners}
        className="col-12"
      >
        <div className="card">
            <div className="d-flex justify-content-center">
        {/* <button {...attributes} {...listeners}>⣿</button> */}

            </div>
            <div className="card-title" >
                {title}
            </div>
            <div className="card-body">
            {/* {questions.map((item)=>{
                    return(
                        <Item key={item.id} item={item} id={item.id}/>
                    )
                })} */}
            </div>
        </div>
      </div>
    );
  };

