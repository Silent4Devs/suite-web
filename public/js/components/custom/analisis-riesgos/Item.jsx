import React, { useState } from 'react';
import { useSortable } from "@dnd-kit/sortable";
import { CSS } from "@dnd-kit/utilities";
import { CardTemplateAnalisisRiesgos } from '../../common/Cards';

const Item = ({ id, size, questions, chanceQuestionSize}) => {
    const [sizet, setSizet] = useState(size);
    const {
        attributes,
        listeners,
        setNodeRef,
        transform,
        transition,
        isDragging
      } = useSortable({ id, data: {
        type: "Question",
        id,
        size:sizet,
        question:{
            type:""
        }
    }});

      const style = {
        transform: CSS.Transform.toString(transform),
        transition,
      };

      const changeSize6 = () => {
        // setSizet(6)

        console.log(questions)
    }

    const changeSize3 = () => {
        setSizet(3)
        chanceQuestionSize(id,3);
    }

      if (isDragging) {
        return (
          <div
            ref={setNodeRef}
            style={style}
            className={`col-${sizet}`}
          >
            <div className="card">
                <div className="card-body">

                </div>
            </div>

          </div>
        );
      }

    return (
        // <div ref={setNodeRef} style={style} {...attributes} {...listeners} className={`col-${sizet}`} >
        //     <div >
        //         <div className="card" >
        //             <div className="card-body">
        //                 test{id}
        //                 <button onClick={changeSize6}>cambiar 6</button>
        //                 <button onClick={changeSize3}>cambiar 3</button>
        //             </div>
        //         </div>
        //     </div>
        // </div>

        // <div  ref={setNodeRef} style={style} {...attributes} {...listeners} className={`col-${sizet}`}  >
            {/* <CardTemplateAnalisisRiesgos ke id={id}/> */}
        // </div>
        )
}

export default Item
