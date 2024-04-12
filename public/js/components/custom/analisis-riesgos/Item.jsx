import React from 'react';
import { useSortable } from "@dnd-kit/sortable";
import { CSS } from "@dnd-kit/utilities";
import { CardTemplateAnalisisRiesgos } from '../../common/Cards';

const Item = ({title, id, size}) => {
    const {
        attributes,
        listeners,
        setNodeRef,
        transform,
        transition,
        isDragging
      } = useSortable({ id, data: {
        type: "Question",
        title,
        id,
        size,
        question:{
            type:""
        }
    }});

      const style = {
        transform: CSS.Transform.toString(transform),
        transition,
        // width:"50%",
        // width:size

      };

      if (isDragging) {
        return (
          <div
            ref={setNodeRef}
            style={style}
            className={`col-${size}`}
          >
            <div className="card">
                <div className="card-body">

                </div>
            </div>

          </div>
        );
      }

    return (
        <div ref={setNodeRef} style={style} {...attributes} {...listeners} className={`col-${size}`} >
            <div >
                <div className="card" >
                    <div className="card-body">
                        {title}
                    </div>
                </div>
            </div>
        </div>

        // <div  ref={setNodeRef} style={style} {...attributes} {...listeners} >
        //     <CardTemplateAnalisisRiesgos/>
        // </div>
        // <CardTemplateAnalisisRiesgos ref={setNodeRef} style={style} attributes ={attributes} listeners={listeners}/>
    )
}

export default Item
