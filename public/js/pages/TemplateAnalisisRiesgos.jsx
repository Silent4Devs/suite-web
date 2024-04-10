import React, {useState} from 'react'
import { DndContext, MouseSensor, TouchSensor, closestCorners, useSensor, useSensors,  PointerSensor } from '@dnd-kit/core';
import { arrayMove } from '@dnd-kit/sortable';
import { Container } from '../components/custom/analisis-riesgos/Containers';

const TemplateAnalisisRiesgos = () => {
    const [sections, setSections] = useState([
        {id:"sec-1", section: "Seccion 1", title:"Sin nombre 1"},
        {id:"sec-2", section: "Seccion 2", title:"Sin nombre 2"},

    ]);

    const [questions, setQuestions] = useState([
        { id: 1, columnId: "sec-1", title:"Question 1" },
        { id: 2, columnId: "sec-2", title:"Question 2" },
        { id: 3, columnId: "sec-1", title:"Question 3" },

    ]);

    const [activeSection, setActiveSection] = useState(null);
    const [activeQuestion, setActiveQuestion] = useState(null);


    const getQuestionPos = (id) => questions.findIndex((item) => item.id === id);
    const getSectionPos = (id) => sections.findIndex((item) => item.id === id);

    const handleDragStart = (event) => {
        if(event.active.data.current?.type === "Section"){
            setActiveSection(event.active.id);
        }
    }

    const handleDragEnd = (event) => {
        const { active, over } = event;

        if (!over) return;


        // console.log(active.data.current.type);

        // if(active.data.current.type === "Question"){
        //     if (active.id === over.id) return;

        //     setQuestions((questions) => {
        //     const originalPos = getQuestionPos(active.id);
        //     const newPos = getQuestionPos(over.id);

        //     return arrayMove(questions, originalPos, newPos);
        //     });

        // }

        // if(active.data.current.type === "Section"){
        //     if (active.id === over.id) return;

        //     setSections((sections) => {
        //     const originalPos = getSectionPos(active.id);
        //     const newPos = getSectionPos(over.id);

        //     return arrayMove(sections, originalPos, newPos);
        //     });
        // }
      };

    const handleDragOver = (event) => {
        const { active, over } = event;
        if (!over) return;

        const activeId = active.id;
        const overId = over.id;

        console.log(activeId,overId)
    }

    const addSection = () => {
        let nextSection = sections.length + 1;
        let nextQuestion = questions.length +1;
        setSections((sections) => [...sections, { id: `sec-${nextSection}`, section: `Seccion ${nextSection}`, title:`Sin nombre ${nextSection}` }]);
        setQuestions((questions)=> [...questions, {id: nextQuestion, columnId:nextSection}])
    }


    // const sensors = useSensors(
    //     useSensor(MouseSensor),
    //     useSensor(TouchSensor)
    //   );

    const sensors = useSensors(
        useSensor(PointerSensor, {
          activationConstraint: {
            distance: 10,
          },
        })
      );



    return (
    <div>

        <DndContext sensors={sensors} collisionDetection={closestCorners} onDragEnd={handleDragEnd} onDragStart={handleDragStart} onDragOver={handleDragOver}>
            <div className="row">
                <Container sections={sections} questions={questions} />
            </div>
        </DndContext>


        <button onClick={addSection}>Agregar seccion</button>
    </div>
  )
}

export default TemplateAnalisisRiesgos
