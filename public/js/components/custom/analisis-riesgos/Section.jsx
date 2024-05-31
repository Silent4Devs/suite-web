import {
    SortableContext,
    useSortable,
    rectSortingStrategy,
} from "@dnd-kit/sortable";
import { CSS } from "@dnd-kit/utilities";
import React, {useState} from "react";
import { QuestionSettings, QuestionTemplateAnalisisRiesgos, QuestionViewPrev } from "./Question";
import "../../../../css/templateAnalisisRiesgo/sections.css";
import { InputSection } from "./Inputs";

export const Section = ({
    id,
    title,
    questions,
    changeSize,
    changeQuestionProps,
    deleteQuestion,
    duplicateQuestion,
    changeTitle,
    deleteSection,

}) => {
    const [editMode, setEditMode] = useState(false);
    const {
        attributes,
        listeners,
        setNodeRef,
        transform,
        transition,
        isDragging,
    } = useSortable({
        id,
        data: {
            type: "Section",
            title,
            questions,
            id,
        },
        disabled: editMode,
    });

    const onChangeTitle = (newValue) => {
        const newTitle = newValue;
        changeTitle(id,newTitle)
    }

    const style = {
        transform: CSS.Transform.toString(transform),
        transition,
        width: "100%",
    };

    if (isDragging) {
        return (
            <div ref={setNodeRef} style={style} className="mb-3">
                <div className="encabezado">
                    <div className="section" >
                            <h5 className="m-0 enc-title">
                                {title}
                            </h5>
                    </div>
                    <div className="section2"></div>
                </div>
                <div className="card">
                    <div className="card-body"></div>
                </div>
            </div>
        );
    }

    return (
        <div style={{width:"100%"}} ref={setNodeRef} {...attributes} {...listeners} >
            <div className="encabezado">
                <div className="section d-flex justify-content-between">
                        <h5 className="m-0 enc-title" onClick={()=>setEditMode(true)}>
                            {!editMode && title}
                        </h5>
                            {editMode && (<InputSection title={title} id={id} onChangeTitle={onChangeTitle} setEditMode={setEditMode}/>
                            )}
                            <div className="mr-2">
                                <i className="material-symbols-outlined" onClick={()=>deleteSection(id)} style={{cursor:"pointer", userSelect:"none", fontSize:"22px"}}>
                                    delete
                                </i>
                            </div>
                </div>
                <div className="section2"></div>
            </div>
            <div style={style} className="">
                <div className="">
                    <div className="row">
                        <SortableContext
                            items={questions}
                            strategy={rectSortingStrategy}
                        >
                            {questions.map((item) => {
                                return (
                                    <QuestionTemplateAnalisisRiesgos
                                        key={item.id}
                                        id={item.id}
                                        question={item}
                                        changeSize={changeSize}
                                        changeQuestionProps={changeQuestionProps}
                                        deleteQuestion={deleteQuestion}
                                        duplicateQuestion={duplicateQuestion}
                                    />
                                );
                            })}
                        </SortableContext>
                    </div>
                </div>
            </div>
        </div>
    );
};

export const SectionSettigns = ({id, title,questions,changeSize}) => {
    const {
        attributes,
        listeners,
        setNodeRef,
        transform,
        transition,
        isDragging,
    } = useSortable({
        id,
        data: {
            type: "Section",
            title,
            questions,
            id,
        },
    });

    const style = {
        transform: CSS.Transform.toString(transform),
        transition,
        width: "100%",
    };

    if (isDragging) {
        return (
            <div ref={setNodeRef} style={style} className="mb-3">
                <div className="encabezado">
                    <div className="section" >
                            <h5 className="m-0 enc-title">
                                {title}
                            </h5>
                    </div>
                    <div className="section2"></div>
                </div>
                <div className="card">
                    <div className="card-body"></div>
                </div>
            </div>
        );
    }


  return (
    <div style={{width:"100%"}} ref={setNodeRef} {...attributes} {...listeners}>
            <div className="encabezado">
                <div className="section d-flex justify-content-between">
                        <h5 className="m-0 enc-title" >
                            {title}
                        </h5>
                </div>
                <div className="section2"></div>
            </div>
            <div style={style} className="">
                <div className="">
                    <div className="row">
                        <SortableContext
                            items={questions}
                            strategy={rectSortingStrategy}
                        >
                            {questions.map((item) => {
                                return (
                                    <QuestionSettings key={item.id} id={item.id} question={item} changeSize={changeSize}/>
                                );
                            })}
                        </SortableContext>
                    </div>
                </div>
            </div>
    </div>
  )
}

export const SectionViewPrev = ({id, title,questions}) => {
    return(
        <div style={{width:"100%"}}>
        <div className="encabezado">
            <div className="section d-flex justify-content-between">
                    <h5 className="m-0 enc-title" >
                        {title}
                    </h5>
            </div>
            <div className="section2"></div>
        </div>
        <div className="">
            <div className="">
                <div className="row">
                        {questions.map((item) => {
                            return (
                                <QuestionViewPrev key={item.id} id={item.id} question={item} />
                            );
                        })}
                </div>
            </div>
        </div>
    </div>
    )
}

