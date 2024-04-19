import React, {useState} from 'react'
import { useSortable } from '@dnd-kit/sortable';
import { useSensor, useSensors,  PointerSensor } from '@dnd-kit/core';
import { arrayMove } from '@dnd-kit/sortable';

export const useAnalisisRiesgo = () => {
    const [sections, setSections] = useState([
        {id:"sec-1", section: "Seccion 1", title:"Sin nombre 1"},

    ]);

    const [questions, setQuestions] = useState([
        { id: 1, columnId: "sec-1", size:12, type:"1", data:{inputTitle:"test"} },
    ]);

    const [activeSection, setActiveSection] = useState(null);
    const [activeQuestion, setActiveQuestion] = useState(null);

    const handleDragStart = (event) => {
        if(event.active.data.current?.type === "Section"){
            setActiveSection(event.active.data.current);
            return;
        }

        if(event.active.data.current?.type === "Question"){
            console.log(event.active.data.current)
            setActiveQuestion(event.active.data.current);
            return;
        }
    }

    const handleDragEnd = (event) => {
        setActiveSection(null);
        setActiveQuestion(null);

        const { active, over } = event;
        if (!over) return;

        const activeId = active.id;
        const overId = over.id;

        if (activeId === overId) return;

        const isActiveASection = active.data.current?.type === "Section";
        if (!isActiveASection) return;

        console.log("DRAG END");

        setSections((sections) => {
          const activeSectionIndex = sections.findIndex((item) => item.id === activeId);

          const overSectionIndex = sections.findIndex((item) => item.id === overId);

          return arrayMove(sections, activeSectionIndex, overSectionIndex);
        });
      };

    const handleDragOver = (event) => {
        const { active, over } = event;
        // console.log(active)
        if (!over) return;

        const activeId = active.id;
        const overId = over.id;

        if (activeId === overId) return;

        const isActiveAQuestion = active.data.current?.type === "Question";
        const isOverAQuestion = over.data.current?.type === "Question";

        if (!isActiveAQuestion) return;

        // Im dropping a Task over another Task
        if (isActiveAQuestion && isOverAQuestion) {
          setQuestions((questions) => {
            const activeIndex = questions.findIndex((item) => item.id === activeId);
            const overIndex = questions.findIndex((item) => item.id === overId);

            if (questions[activeIndex].columnId != questions[overIndex].columnId) {
              // Fix introduced after video recording
              questions[activeIndex].columnId = questions[overIndex].columnId;
              return arrayMove(questions, activeIndex, overIndex - 1);
            }

            return arrayMove(questions, activeIndex, overIndex);
          });
        }

        const isOverASection = over.data.current?.type === "Section";

        // Im dropping a Task over a column
        if (isActiveAQuestion && isOverASection) {
          setQuestions((questions) => {
            console.log(questions)
            const activeIndex = questions.findIndex((item) => item.id === activeId);
            questions[activeIndex].columnId = overId;
            // console.log("DROPPING TASK OVER COLUMN", { activeIndex });
            return arrayMove(questions, activeIndex, activeIndex);
          });
        }
      }


    const addSection = () => {
        let nextSection = sections.length + 1;
        let nextQuestion = questions.length +1;
        setSections((sections) => [...sections, { id: `sec-${nextSection}`, section: `Seccion ${nextSection}`, title:`Sin nombre ${nextSection}` }]);
        setQuestions((questions) => [...questions, {id: nextQuestion, columnId:`sec-${nextSection}`, size:12, title:`Question ${nextQuestion}`, type:"1", data:{}}])

    }

    const addQuestion = () => {
        const lastPositionSection = sections.length - 1;
        const lastSection = sections.find((element,index) => index === lastPositionSection);
        let nextQuestion = questions.length +1;
        setQuestions((questions) => [...questions, {id: nextQuestion, columnId: lastSection.id, size:12, type:"1", data:{}}])
    }

    const deleteQuestion = (id) => {
        const filter = questions.find(item => item.id === id);

        const newQuestions = questions.filter((item) => item.id !== id);
        setQuestions(newQuestions)
    }

    const changeSize = (id, newSize) => {
        console.log(questions)
        const updateQuestions = questions.map((item)=>{
            if(item.id === id){
                const updateItem = item
                updateItem.size = newSize
                return updateItem
            }
            return item;
        })

        setQuestions(updateQuestions)
    }

    const changeQuestionProps = (id,type,props) => {
        let updateQuestions;
        switch(type){
            case 'type':
                updateQuestions = questions.map((item)=>{
                    if(item.id === id){
                        const updateItem = item;
                        item.type=props.type
                        return updateItem;
                    }
                    return item;
                });
                setQuestions(updateQuestions);
                break;
            case "title":
                updateQuestions = questions.map((item)=>{
                    if(item.id === id){
                        const updateItem = item;
                        item.data.inputTitle=props.inputTitle
                        return updateItem;
                    }
                    return item;
                });
                break;

            default:
                console.log("sin cambio")
        }
    }

    const sensors = useSensors(
        useSensor(PointerSensor, {
          activationConstraint: {
            distance: 1,
          },
        })
      );

      return {sections,questions, activeSection, activeQuestion, handleDragStart, handleDragOver, handleDragEnd, addSection, addQuestion,deleteQuestion,changeSize,changeQuestionProps,sensors}
}

export const useGenerateTemplateAnalisisRiesgo = (item, changeQuestionProps) => {
    const [option, setOption] = useState(item.type);
    const [inputTitle, setInputTitle] = useState(item.data.inputTitle)

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

    const handleChangeOption = (e) => {
        const newValue = e.target.value;
        const questionProp = {type:newValue}
        setOption(newValue);
        changeQuestionProps(item.id,"type", questionProp )
     }

     const handleTileChange = (newValue) => {
        const newTitle = newValue;
        setInputTitle(newTitle);
        const questionProp = {inputTitle:newTitle}
        item.data.inputTitle = newValue
        changeQuestionProps(item.id,"title", questionProp )

    };

     return { option, handleChangeOption, attributes, listeners, setNodeRef, transform, transition, isDragging, handleTileChange, inputTitle}
 }
