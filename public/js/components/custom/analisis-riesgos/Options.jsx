import React, { useState } from "react";
import {
    InputDate,
    InputSimple,
    InputTime,
    TextAreaSimple,
} from "../../common/Inputs";
import { HrSimple } from "../../common/Hr";
import { v4 as uuidv4 } from 'uuid';

export const OptionTextSimple = () => {
    return (
        <div className="row">
            <InputSimple
                title="Respuesta corta"
                name="respuesta-corta"
                size={12}
                styles="p-0"
            />
            <label> Texto de respuesta corta</label>
            <HrSimple
                styles={{
                    width: "100%",
                    borderWidth: "1px",
                    borderColor: "#C5C5C5",
                    borderStyle: "dashed",
                    marginTop: "0px",
                }}
            />
        </div>
    );
};

export const OptionParrafo = () => {
    return (
        <div className="row">
            <TextAreaSimple
                title="Respuesta Larga"
                name="respuesta-larga"
                size={12}
                className="p-0"
            />
            <label> Texto de respuesta corta</label>
            <HrSimple
                styles={{
                    width: "100%",
                    borderWidth: "1px",
                    borderColor: "#C5C5C5",
                    borderStyle: "dashed",
                    marginTop: "0px",
                }}
            />
        </div>
    );
};

export const OptionNumber = () => {
    return (
        <div className="row">
            <InputSimple
                title="Respuesta corta"
                name="respuesta-corta"
                size={12}
                styles="p-0"
                type="number"
            />
            <label> Campo numérico</label>
            <HrSimple
                styles={{
                    width: "100%",
                    borderWidth: "1px",
                    borderColor: "#C5C5C5",
                    borderStyle: "dashed",
                    marginTop: "0px",
                }}
            />
        </div>
    );
};

export const OptionRound = ({select=1}) => {
    const [options, setOptions] = useState([
        { id: 1, title: "respuesta 1", name: "respuesta1" },
        { id: 2, title: "respuesta 2", name: "respuesta2" },
        { id: 3, title: "respuesta 2", name: "respuesta2" },
    ]);
    const [selectedOption, setSelectedOption] = useState(select);

    const handleOptionChange = (optionId) => {
        setSelectedOption(optionId);
    };

    const handleChange = (id, newValue) => {
        setOptions(prevInputs =>
          prevInputs.map(input =>
            input.id === id ? { ...input, title: newValue } : input
          )
        );
      };

    const addOption = () => {
       const lastOption = options.length + 1;
        const newOption = {id: uuidv4(), title: "", name: `respuesta${lastOption}`}
        setOptions([...options, newOption])
    }

    const deleteOption = (id) =>{
        if(options.length >2){
            const filter = options.filter(item => item.id !== id);
            setOptions(filter);
        }
    }

    return (
        <div className="row">
            <InputSimple
                title="Pregunta opciones"
                name="pregunta-opciones"
                size={12}
                styles="p-0"
            />
            <div className="col-12">
                <div className="row ">
                    {options.map((item, index) => {
                        return (
                            <>
                                <div className="col-10 mt-3 " key={index}>
                                    <form className="d-flex align-items-center">
                                        <input
                                            style={{
                                                width: "24px",
                                                height: "24px",
                                            }}
                                            class="form-control mr-3"
                                            type="radio"
                                            id={`radio-${item.id}`}
                                            name="options"
                                            value={item.id}
                                            checked={selectedOption === item.id}
                                            onChange={() =>
                                                handleOptionChange(item.id)
                                            }
                                        />
                                        <input
                                            type={"text"}
                                            className="form-control"
                                            placeholder="Respuesta"
                                            name={item.name}
                                            value={item.title}
                                            onChange={e => handleChange(item.id, e.target.value)}
                                        />
                                    </form>
                                </div>
                                {
                                    options.length >2 ? (
                                        <div className="col-2 mt-3">
                                            <i class="material-symbols-outlined" style={{marginTop:"11px", cursor:"pointer"}} onClick={()=>deleteOption(item.id)}>
                                                close
                                            </i>
                                        </div>
                                    ):
                                    (
                                        <></>
                                    )
                                }
                            </>
                        );
                    })}
                    <div className="col-12 mt-3 d-flex align-items-center">
                        <input
                            style={{ width: "24px", height: "24px" }}
                            class="form-control mr-3"
                            type="checkbox"
                            value=""
                            id="flexCheckDefault"
                            disabled
                        />
                        <button type="button" class="btn btn-link" onClick={addOption}>Agregar opcion o añadir respuesta</button>
                    </div>
                </div>
            </div>
        </div>
    );
};

export const OptionSquard = () => {
    const [options, setOptions] = useState([
        { id: 1, title: "respuesta 1", name: "respuesta1", isTrue:true },
        { id: 2, title: "respuesta 2", name: "respuesta2", isTrue:false },
        { id: 3, title: "respuesta 2", name: "respuesta2", isTrue:false },
    ]);
    const [selectedOption, setSelectedOption] = useState(1);

    const handleOptionChange = (optionId) => {
        setSelectedOption(optionId);
    };

    const handleChange = (id, newValue) => {
        setOptions(prevInputs =>
          prevInputs.map(input =>
            input.id === id ? { ...input, title: newValue } : input
          )
        );
      };

    const addOption = () => {
       const lastOption = options.length + 1;
        const newOption = {id: uuidv4(), title: "", name: `respuesta${lastOption}`}
        setOptions([...options, newOption])
    }

    const deleteOption = (id) =>{
        if(options.length >2){
            const filter = options.filter(item => item.id !== id);
            setOptions(filter);
        }
    }
    return (
        <div className="row">
            <InputSimple
                title="Pregunta multiple"
                name="pregunta-multiple"
                size={12}
                styles="p-0"
            />
            <div className="col-12">
                <div className="row ">
                    {options.map((item, index) => {
                        return (
                            <>
                                <div className="col-10 mt-3 " key={index}>
                                    <form className="d-flex align-items-center">
                                        {/* <input
                                            style={{
                                                width: "24px",
                                                height: "24px",
                                            }}
                                            class="form-control mr-3"
                                            type="radio"
                                            id={`radio-${item.id}`}
                                            name="options"
                                            value={item.id}
                                            checked={selectedOption === item.id}
                                            onChange={() =>
                                                handleOptionChange(item.id)
                                            }
                                        /> */}
                                        <input class="form-check-input" type="checkbox" value=""  id="flexCheckDefault" checked={item.isTrue}></input>
                                        <input
                                            type={"text"}
                                            className="form-control"
                                            placeholder="Respuesta"
                                            name={item.name}
                                            value={item.title}
                                            onChange={e => handleChange(item.id, e.target.value)}
                                        />
                                    </form>
                                </div>
                                {
                                    options.length >2 ? (
                                        <div className="col-2 mt-3">
                                            <i class="material-symbols-outlined" style={{marginTop:"11px", cursor:"pointer"}} onClick={()=>deleteOption(item.id)}>
                                                close
                                            </i>
                                        </div>
                                    ):
                                    (
                                        <></>
                                    )
                                }
                            </>
                        );
                    })}
                    <div className="col-12 mt-3 d-flex align-items-center">
                        <input
                            style={{ width: "24px", height: "24px" }}
                            class="form-control mr-3"
                            type="checkbox"
                            value=""
                            id="flexCheckDefault"
                            disabled
                        />
                        <button type="button" class="btn btn-link" onClick={addOption}>Agregar opcion o añadir respuesta</button>
                    </div>
                </div>
            </div>
        </div>
    );
};

export const OptionSelect = () => {
    return (
        <div className="row">
            <InputSimple
                title="Pregunta desplegable"
                name="pregunta-desplegable"
                size={10}
                styles="p-0"
            />
        </div>
    );
};

export const OptionDate = () => {
    return (
        <div className="row">
            <InputDate title="Fecha" name="date" size={3} styles="p-0" />
        </div>
    );
};

export const OptionTime = () => {
    return (
        <div className="row">
            <InputTime title="Hora" name="time" size={3} styles="p-0" />
        </div>
    );
};
