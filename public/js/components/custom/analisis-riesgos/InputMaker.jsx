import React from "react";
import { InputSimple } from "../../common/Inputs";

export const InputMaker = ({ type, id, title, handleTileChange }) => {
    switch (type) {
        case "1":
            return (
                <InputSimple
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
                <InputSimple
                    title="Pregunta Larga"
                    name={`pregunta-larga-${id}`}
                    size={8}
                    styles="p-0"
                />
            );
        case "3":
            return (
                <InputSimple
                    title="Pregunta Númerica"
                    name={`pregunta-numerica-${id}`}
                    size={8}
                    styles="p-0"
                />
            );
        case "5":
            return (
                <InputSimple
                    title="Pregunta Opciones"
                    name={`pregunta-opciones-${id}`}
                    size={8}
                    styles="p-0"
                />
            );
        case "6":
            return (
                <InputSimple
                    title="Pregunta Multiple"
                    name={`pregunta-multiple-${id}`}
                    size={8}
                    styles="p-0"
                />
            );
        case "7":
            return (
                <InputSimple
                    title="Pregunta Desplegable"
                    name={`pregunta-desplegable-${id}`}
                    size={8}
                    styles="p-0"
                />
            );
        case "8":
            return (
                <InputSimple
                    title="Fecha"
                    name={`pregunta-fecha-${id}`}
                    size={8}
                    styles="p-0"
                />
            );
        case "9":
            return (
                <InputSimple
                    title="Hora"
                    name={`pregunta-hora-${id}`}
                    size={8}
                    styles="p-0"
                />
            );
        default:
            return <></>;
    }
};
