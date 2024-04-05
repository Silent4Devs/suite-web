import React, {useState,useEffect} from 'react'
import { CardTemplateAnalisisRiesgos } from '../components/common/Cards'
import { DndContext, MouseSensor, TouchSensor, closestCorners, useSensor, useSensors } from '@dnd-kit/core';
import { arrayMove } from '@dnd-kit/sortable';
import { Columns } from '../components/custom/analisis-riesgos/Columns';

const TemplateAnalisisRiesgos = () => {
    const [sections, setSections] = useState([
        {id:1, section: "Seccion 1", title:"Sin nombre 1"},
        {id:2, section: "Seccion 2", title:"Sin nombre 2"}

    ])

    const [questions, setQuestions] = useState([
        { id: 1, columnId: 1 },
        { id: 2, columnId: 2 },
        // { id: 3, columnId: 2 },
        // { id: 4, columnId: 2 },
        // { id: 5, columnId: 2 }
    ]);


    const getSectionPos = (id) => sections.findIndex((item) => item.id === id);

    const handleDragEnd = (event) => {
        const { active, over } = event;

        if (active.id === over.id) return;

        setSections((sections) => {
        const originalPos = getSectionPos(active.id);
        const newPos = getSectionPos(over.id);

        return arrayMove(sections, originalPos, newPos);
        });
      };

    const addSection = () => {
        let nextSection = sections.length + 1;
        let nextQuestion = questions.length +1;
        setSections((sections) => [...sections, { id: nextSection, section: `Seccion ${nextSection}`, title:`Sin nombre ${nextSection}` }]);
        setQuestions((questions)=> [...questions, {id: nextQuestion, columnId:nextSection}])
    }

    const addQuestion = () => {
        let ultimaSection = sections.length - 1;
        let ultimoObjeto = sections[ultimaSection];
        let idSection = ultimoObjeto.id;
        let nextQuestion = questions.length +1;

        setQuestions((questions)=> [...questions, {id: nextQuestion, columnId:idSection}])
    }

    const deletedQuestion = () => {

    }

    const sensors = useSensors(
        useSensor(MouseSensor),
        useSensor(TouchSensor)
      );


    // const [optionsGenerate, setOptionsGenerate] = useState([{id:0}]);

    // const addOption = () => {
    //     const nextNumber = optionsGenerate.length;
    //     setOptionsGenerate([...optionsGenerate, {id:nextNumber}]);
    // };

    // const eliminarCarta = (id) => {
    //     setOptionsGenerate(
    //         optionsGenerate.filter((option) => option.id !== id)
    //       );
    //   };

    return (
    <div>

        <DndContext sensors={sensors} collisionDetection={closestCorners} onDragEnd={handleDragEnd}>
            <div className="row">
                <Columns sections={sections} questions={questions} />
            </div>
        </DndContext>

        {/* <div className="row">
        {optionsGenerate.map((item)=>{
            return(
                    <CardTemplateAnalisisRiesgos id={item.id} clickDelete={eliminarCarta} key={item.id}/>
            )
        })}
        </div>

        <button onClick={addOption}>Agregar Carta</button> */}

        <button onClick={addSection}>Agregar seccion</button>
        <button onClick={addQuestion}>Agregar pregunta</button>
    </div>
  )
}

export default TemplateAnalisisRiesgos
