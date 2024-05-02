import React from "react";
import { ContainerInputAnalisisRiesgo} from "./Inputs";

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
