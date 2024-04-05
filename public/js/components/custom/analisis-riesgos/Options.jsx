import React from "react";
import { InputDate, InputSimple, InputTime, TextAreaSimple } from "../../common/Inputs";
import { HrSimple } from "../../common/Hr";

export const OptionTextSimple = () => {
    return (
        <div className="row">
            <InputSimple title="Respuesta corta" name="respuesta-corta" size={12} styles="p-0" />
            <label > Texto de respuesta corta</label>
            <HrSimple styles={{width:"100%", borderWidth: "1px", borderColor:"#C5C5C5", borderStyle:"dashed", marginTop:"0px"}} />
        </div>
    );
};

export const OptionParrafo = () => {
    return (
        <div className="row">
            <TextAreaSimple title="Respuesta Larga" name="respuesta-larga" size={12} className="p-0"  />
            <label > Texto de respuesta corta</label>
            <HrSimple styles={{width:"100%", borderWidth: "1px", borderColor:"#C5C5C5", borderStyle:"dashed", marginTop:"0px"}} />
        </div>
    );
};

export const OptionNumber = () => {
    return(
    <div className="row">
        <InputSimple title="Respuesta corta" name="respuesta-corta" size={12} styles="p-0" type="number" />
        <label > Campo numérico</label>
        <HrSimple styles={{width:"100%", borderWidth: "1px", borderColor:"#C5C5C5", borderStyle:"dashed", marginTop:"0px"}} />
    </div>
    )
}

export const OptionRound = () => {
    return(
        <div className="row">
            <InputSimple title="Pregunta opciones" name="pregunta-opciones" size={12} styles="p-0"  />
        </div>
    );
 }

export const OptionSquard = () => {
    return(
        <div className="row">
            <InputSimple title="Pregunta multiple" name="pregunta-multiple" size={12} styles="p-0"  />
        </div>
    );
}

export const OptionSelect = () => {
    return(
        <div className="row">
            <InputSimple title="Pregunta desplegable" name="pregunta-desplegable" size={10} styles="p-0"  />
        </div>
    )
 }

export const OptionDate = () => {
    return(
        <div className="row">
            <InputDate title="Fecha" name="date" size={3} styles="p-0"  />
        </div>
    )
}

export const OptionTime = () => {
    return(
        <div className="row">
            <InputTime title="Hora" name="time" size={3} styles="p-0"  />
        </div>
    )
}


