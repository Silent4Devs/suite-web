import React, {useState} from 'react'
import { DndContext, MouseSensor, TouchSensor, closestCorners, useSensor, useSensors,  PointerSensor, DragOverlay } from '@dnd-kit/core';
import { arrayMove } from '@dnd-kit/sortable';
import { Container } from '../components/custom/analisis-riesgos/Containers';
import { Section } from '../components/custom/analisis-riesgos/Section';
import { createPortal } from 'react-dom';
import Item from '../components/custom/analisis-riesgos/Item';

const TemplateAnalisisRiesgos = () => {
    const [sections, setSections] = useState([
        {id:"sec-1", section: "Seccion 1", title:"Sin nombre 1"},
        // {id:"sec-2", section: "Seccion 2", title:"Sin nombre 2"},



    ]);

    const [questions, setQuestions] = useState([
        { id: 1, columnId: "sec-1", title:"Question 1", size:3 },
        { id: 2, columnId: "sec-1", title:"Question 2", size:6 },
        { id: 3, columnId: "sec-1", title:"Question 3", size:3 },
        { id: 4, columnId: "sec-1", title:"Question 4", size:3 },
        { id: 5, columnId: "sec-1", title:"Question 5", size:3 },
        { id: 6, columnId: "sec-1", title:"Question 6", size:6 },
        { id: 7, columnId: "sec-1", title:"Question 7", size:3 },
        { id: 8, columnId: "sec-1", title:"Question 8", size:3 },
        // { id: 5, columnId: "sec-2", title:"Question 4", size:12 },





    ]);

    const [activeSection, setActiveSection] = useState(null);
    const [activeQuestion, setActiveQuestion] = useState(null);

    const handleDragStart = (event) => {
        if(event.active.data.current?.type === "Section"){
            console.log(event.active)
            setActiveSection(event.active.data.current);
            return;
        }

        if(event.active.data.current?.type === "Question"){
            // console.log(event.active.data.current)
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
        if(isOverASection){
            console.log("sobre section")

        }

        // Im dropping a Task over a column
        if (isActiveAQuestion && isOverASection) {
          setQuestions((questions) => {
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
        setQuestions((questions) => [...questions, {id: nextQuestion, columnId:`sec-${nextSection}`, size:12, title:`Question ${nextQuestion}`}])

    }

    const addQuestion = () => {
        let lastSection = sections.length;
        let nextQuestion = questions.length +1;
        setQuestions((questions) => [...questions, {id: nextQuestion, columnId:`sec-${lastSection}`, size:3, title:`Question ${nextQuestion}`}])
        console.log(questions)
    }


    // const sensors = useSensors(
    //     useSensor(MouseSensor),
    //     useSensor(TouchSensor)
    //   );

    const sensors = useSensors(
        useSensor(PointerSensor, {
          activationConstraint: {
            distance: 1,
          },
        })
      );



    return (
    <div style={{display: "flex", flexDirection:"column", justifyContent:"flex-start", alignItems:"center" }}>

        <DndContext sensors={sensors} collisionDetection={closestCorners} onDragEnd={handleDragEnd} onDragStart={handleDragStart} onDragOver={handleDragOver}>
            {/* <div className="row"> */}
                <Container sections={sections} questions={questions} />
            {/* </div> */}
            {createPortal(
                <DragOverlay>
                    {activeSection && (
                    <Section
                        id={activeSection.id}
                        title={activeSection.title}
                        questions={questions.filter(
                        (item) => item.columnId === activeSection.id
                        )}
                    />
                    )}
                    {activeQuestion && (
                    <Item
                        id={activeQuestion.id}
                        title={activeQuestion.title}
                        size={12}
                    />
                    )}
                </DragOverlay>,
                document.body
        )}
        </DndContext>


        <button onClick={addSection}>Agregar seccion</button>
        <button onClick={addQuestion}>Agregar Pregunta</button>

    </div>
  )
}

export default TemplateAnalisisRiesgos
