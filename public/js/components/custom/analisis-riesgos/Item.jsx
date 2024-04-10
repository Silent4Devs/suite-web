import React from 'react';
import { useSortable } from "@dnd-kit/sortable";
import { CSS } from "@dnd-kit/utilities";

const Item = ({item, id}) => {
    const {
        attributes,
        listeners,
        setNodeRef,
        transform,
        transition
      } = useSortable({ id, data: {
        type: "Question"}, });

      const style = {
        transform: CSS.Transform.toString(transform),
        transition
      };

    return (
    <div class="card"  ref={setNodeRef} style={style} {...attributes} {...listeners}>
        <div className="card-body">
            {item.title}
        </div>
    </div>
    )
}

export default Item
