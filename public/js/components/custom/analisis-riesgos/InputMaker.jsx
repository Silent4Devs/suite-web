import React from "react";
import { ContainerInputAnalisisRiesgo} from "./Inputs";
import { InputSimple, InputSimpleDisabled } from "../../common/Inputs";
import { SelectSimple } from "../../common/Selects";

export const InputMaker = ({ type, id, title, handleTileChange }) => {
    switch (type) {
        case "1":
            return (
                <ContainerInputAnalisisRiesgo
                    title="Pregunta corta"
                    name={`pregunta-corta-${id}`}
                    size={8}
                    styles="p-0"
                    value={title}
                    handleChange={handleTileChange}
                />
            );
        case "2":
            return (
                <ContainerInputAnalisisRiesgo
                    title="Pregunta Larga"
                    name={`pregunta-larga-${id}`}
                    size={8}
                    styles="p-0"
                    value={title}
                    handleChange={handleTileChange}
                />
            );
        case "3":
            return (
                <ContainerInputAnalisisRiesgo
                    title="Pregunta Númerica"
                    name={`pregunta-numerica-${id}`}
                    size={8}
                    styles="p-0"
                    value={title}
                    handleChange={handleTileChange}
                />
            );
        case "5":
            return (
                <ContainerInputAnalisisRiesgo
                    title="Pregunta Opciones"
                    name={`pregunta-opciones-${id}`}
                    size={8}
                    styles="p-0"
                    value={title}
                    handleChange={handleTileChange}
                />
            );
        case "6":
            return (
                <ContainerInputAnalisisRiesgo
                    title="Pregunta Multiple"
                    name={`pregunta-multiple-${id}`}
                    size={8}
                    styles="p-0"
                    value={title}
                    handleChange={handleTileChange}
                />
            );
        case "7":
            return (
                <ContainerInputAnalisisRiesgo
                    title="Pregunta Desplegable"
                    name={`pregunta-desplegable-${id}`}
                    size={8}
                    styles="p-0"
                    value={title}
                    handleChange={handleTileChange}
                />
            );
        case "8":
            return (
                <ContainerInputAnalisisRiesgo
                    title="Fecha"
                    name={`pregunta-fecha-${id}`}
                    size={8}
                    styles="p-0"
                    value={title}
                    handleChange={handleTileChange}
                />
            );
        case "9":
            return (
                <ContainerInputAnalisisRiesgo
                    title="Hora"
                    name={`pregunta-hora-${id}`}
                    size={8}
                    styles="p-0"
                    value={title}
                    handleChange={handleTileChange}
                />
            );
        default:
            return <></>;
    }
};

export const InputMakerSettings = ({question}) => {
    const type = question.type;
    switch(type){
        case "1":
            return(
                <>
                    <label>
                        {question.title} {question.obligatory ? "*":null}
                    </label>
                    <InputSimpleDisabled title="" name={`input-disabled-${question.title}`} type="text" value=""/>
                </>
            );
            break;
        case "2":
            return(
                <>
                    <label>
                        {question.title} {question.obligatory ? "*":null}
                    </label>
                    <InputSimpleDisabled title="" name={`input-disabled-${question.title}`} type="text" value=""/>
                </>
            );
            break;
        case "3":
            // console.log(question)
            return(
                <>
                    <label>
                        {question.title} {question.obligatory ? "*":null}
                    </label>
                    <InputSimpleDisabled title="" name={`input-disabled-${question.title}`} type="text" value=""/>
                    <p>Tu valor debe encontrase entre {question.data.minimo} y el {question.data.maximo}</p>
                </>
            );
            break;
        case "5":
            return(
                <>
                    <label>
                        {question.title} {question.obligatory ? "*":null}
                    </label>
                    {question.data.map((item,index)=>{
                        return(
                            <React.Fragment key={index}>
                        <div
                            className="col-10 col-md-8 mt-3"
                            style={{ paddingRight: "0px" }}
                        >
                            <form className="d-flex align-items-center">
                                <input
                                    style={{
                                        width: "24px",
                                        height: "24px",
                                    }}
                                    className="form-control mr-3"
                                    type="radio"
                                    id={`radio-${item.id}`}
                                    name="options"
                                    defaultValue={item.id}
                                    defaultChecked={false}
                                />
                                <label
                                style={{margin:0}}
                                >
                                    {item.title}
                                </label>

                            </form>
                        </div>
                    </React.Fragment>
                        )
                    })}
                </>
            )
            break;
        case "6":
            return(
                <>
                    <label>
                        {question.title} {question.obligatory ? "*":null}
                    </label>
                    {question.data.map((item,index)=>{
                        return(
                            <React.Fragment key={index}>
                        <div
                            className="col-10 col-md-8 mt-3"
                            style={{ paddingRight: "0px" }}
                        >
                            <form className="d-flex align-items-center">
                                <input
                                    style={{
                                        width: "24px",
                                        height: "24px",
                                    }}
                                    className="form-control mr-3"
                                    type="checkbox"
                                    id={`radio-${item.id}`}
                                    name="options"
                                    defaultValue={item.id}
                                    defaultChecked={false}
                                />
                                <label
                                style={{margin:0}}
                                >
                                    {item.title}
                                </label>

                            </form>
                        </div>
                    </React.Fragment>
                        )
                    })}
                </>
            )
            break;
        case "7":
            return(
                <>
                    <label>
                        {question.title} {question.obligatory ? "*":null}
                    </label>
                    <SelectSimple options={question.data} name={`select-settings-${question.id}`} value="" />
                </>
            )
            break;
        case "8":
            return(
                <>
                    <label>
                        {question.title} {question.obligatory ? "*":null}
                    </label>
                    <InputSimple title="" background="#EFEFEF" name={`input-disabled-${question.title}`} type="date" value=""/>

                </>
            );
            break;
        case "9":
            return(
                <>
                    <label>
                        {question.title} {question.obligatory ? "*":null}
                    </label>
                    <InputSimple title="" background="#EFEFEF" name={`input-disabled-${question.title}`} type="time" value=""/>
                </>
            );
            break;
        case "11":
            return(
                <>
                    <label>
                        {question.title} {question.obligatory ? "*":null}
                    </label>
                    <InputSimpleDisabled title="" name={`input-disabled-${question.title}`} type="text" value=""/>
                </>
            );
            break;
        case "12":
            return(
                <>
                    <label>
                        {question.title} {question.obligatory ? "*":null}
                    </label>
                    <InputSimpleDisabled title="" name={`input-disabled-${question.title}`} type="text" value=""/>
                </>
            );
            break;
        default:

    }
 }
