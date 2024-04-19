import {
    SortableContext,
    useSortable,
    rectSortingStrategy,
} from "@dnd-kit/sortable";
import { CSS } from "@dnd-kit/utilities";
import React from "react";
import { CardTemplateAnalisisRiesgos } from "../../common/Cards";

export const Section = ({
    id,
    title,
    questions,
    changeSize,
    changeQuestionProps,
    deleteQuestion,
}) => {
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
                <div className="card m-0 p-0">
                    <div className="card-body "></div>
                </div>
            </div>
        );
    }

    return (
        <div ref={setNodeRef} style={style} className="card">
            <div className="card-title">
                <div className="d-flex justify-content-center">
                    <button {...attributes} {...listeners}>
                        ⣿
                    </button>
                </div>
            </div>
            <div className="card-body">
                <div className="row">
                    <SortableContext
                        items={questions}
                        strategy={rectSortingStrategy}
                    >
                        {questions.map((item) => {
                            return (
                                <CardTemplateAnalisisRiesgos
                                    key={item.id}
                                    id={item.id}
                                    question={item}
                                    changeSize={changeSize}
                                    changeQuestionProps={changeQuestionProps}
                                    deleteQuestion={deleteQuestion}
                                />
                            );
                        })}
                    </SortableContext>
                </div>
            </div>
        </div>
    );
};
