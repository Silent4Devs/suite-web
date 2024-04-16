import React, {useState} from 'react'
import { useSortable } from '@dnd-kit/sortable';

export const useGenerateTemplateAnalisisRiesgo = (item) => {

    const {
        attributes,
        listeners,
        setNodeRef,
        transform,
        transition,
        isDragging
      } = useSortable({ id:item.id, data: {
        type: "Question",
        id: item.id,
        size:item.size,
        question:{
            type:item.type
        }
    }});

    const [option, setOption] = useState(item.type);

    const handleChangeOption = (e) => {
        const newValue = e.target.value;
        setOption(newValue);
     }

     return { option, handleChangeOption, attributes, listeners, setNodeRef, transform, transition, isDragging}
 }
