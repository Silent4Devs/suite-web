import React, { useState, useEffect } from "react";
import { HrSimple } from "../../common/Hr";
import { v4 as uuidv4 } from "uuid";

import '../../../../css/templateAnalisisRiesgo/inputFile.css'
import { AlertSimple } from "../../common/Alerts";
import { SelectCatalog } from "./Selects";


export const OptionTextSimple = ({id, data = {}, changeQuestionProps}) => {
    useEffect(() => {
      changeQuestionProps(id,'dataDelete',data);
    }, [])

    return (
        <div className="row">
            <div className="col-12 col-md-8">
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
        </div>
    );
};

export const OptionParrafo = ({id, data = {}, changeQuestionProps}) => {
    useEffect(() => {
        changeQuestionProps(id,'dataDelete',data);
      }, []);
    return (
        <div className="row">
            <div className="col-12 col-md-8">
                <label> Texto de respuesta larga</label>
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
        </div>
    );
};

export const OptionNumber = ({id, data = {}, changeQuestionProps}) => {
    const dataDefault = {};
    dataDefault[`minimo-${id}`] = 0;
    dataDefault[`maximo-${id}`] = 0;


    const [inputValues, setInputValues] = useState( Object.hasOwn(data,`minimo-${id}`) || Object.hasOwn(data, `maximo-${id}`) ? data : dataDefault);

      const handleInputChange = async(event) => {
        const { name, value } = event.target;
        data[name] = value;
        setInputValues({
          ...inputValues,
          [name]: value
        });

        changeQuestionProps(id,'minMax', data);
      };

      useEffect(() => {

        if(Object.hasOwn(data, `minimo-${id}`) || Object.hasOwn(data, `maximo-${id}`)){
                    changeQuestionProps(id,'minMax', data);
        }else{
                data = {}
                data = dataDefault;
                changeQuestionProps(id,'minMax', dataDefault);
            }
    }, []);

    return (
        <div className="row d-flex justify-content-between d-flex align-items-baseline">
            <div className="col-12 col-md-8">
                <label> Campo númerico</label>
                <HrSimple
                    styles={{
                        width: "100%",
                        borderWidth: "1px",
                        borderColor: "#C5C5C5",
                        borderStyle: "dashed",
                        marginTop: "0px",
                        marginLeft:"0px",
                    }}
                />
            </div>

            <div className="col-12 col-md-12">
                <p>Definir el rango aceptado</p>
            </div>
            <div className="col-12 col-md-12 d-flex align-items-baseline gap-1">
                <div className="form-group pl-0 anima-focus">
                    <input
                    type="number"
                        className="form-control"
                        placeholder=""
                        name={`minimo-${id}`}
                        value={inputValues[`minimo-${id}`]}
                        onChange={handleInputChange}
                    />
                    <label >Mínimo</label>
                </div>
                <div className="form-group pl-0 anima-focus">
                    <input
                    type="number"
                        className="form-control"
                        placeholder=""
                        name={`maximo-${id}`}
                        value={inputValues[`maximo-${id}`]}
                        onChange={handleInputChange}
                    />
                    <label >Máximo</label>
                </div>
            </div>
        </div>
    );
};

export const OptionCatalog = ({id, data={}, changeQuestionProps, handleTileChange}) => {
    const [value, setValue] = useState(data ? data.catalog: "");

    const options=[
        {id:1, title:"Sede"},
        {id:2, title:"Proceso"},
        {id:3, title:"Activo"},
        {id:4, title:"Colaborador"},
        {id:5, title:"Área"},
        {id:6, title:"Puesto"},
        {id:7, title:"Amenaza"},
        {id:8, title:"Vulnerabilidad"},
        {id:9, title:"Clientes"},
        {id:10, title:"Proyectos"}
    ]
    const handleChangeOption = (e) => {
        const registerId = parseInt(e.target.value)
        const option = options.filter(item => item.id === registerId);
        const newOption = [{
            'id': data.id,
            'title':option[0].title,
            'catalog':option[0].id,
        }]
        changeQuestionProps(id,'catalog', newOption);
        setValue(option[0].id);
        handleTileChange(option[0].title)

    }
    return(
        <SelectCatalog options={options} size={8} name={`select-catalog-${id}`} value={value} handleChangeOption={handleChangeOption} />
    )
}

export const OptionRound = ({ id, data = [],  changeQuestionProps, isNumeric }) => {
    const [numeric, setNumeric] = useState(isNumeric);
    const dataDefault = [
        { id: uuidv4(), title: "respuesta 1", value:0, name: "respuesta1", exist: true, status:true },
        { id: uuidv4(), title: "respuesta 2", value:0, name: "respuesta2", exist: true, status:false },
    ]
    const [options, setOptions] = useState(data.length > 0 ? data : dataDefault);

    const handleOptionChange = (optionId) => {
        const updateData = options.map((item)=>{
            if(item.id === optionId){
                const updateItem = item;
                item.status=true;
                return updateItem;
            }else{
                const updateItem = item;
                item.status=false;
                return updateItem;
            }
        })
        setOptions(updateData);
        changeQuestionProps(id,'round',options);

    };

    const handleTextChange = (optionId, newValue) => {
        const updateOptions = options.map((item) => {
            if(item.id === optionId){
                const updateItem = item;
                updateItem.title=newValue;
                return updateItem;
            }
            return item;
        });
        setOptions(updateOptions);
        changeQuestionProps(id,'round',updateOptions);
    };

    const handleValueChange = (optionId, newValue) => {
        const updateOptions = options.map((item) => {
            if(item.id === optionId){
                const updateItem = item;
                updateItem.value=newValue;
                return updateItem;
            }
            return item;
        });
        setOptions(updateOptions);
        changeQuestionProps(id,'round',updateOptions);
    }

    const addOption = () => {
        if(options.length <=4){
            const lastOption = options.length + 1;
            const newOption = {
                id: uuidv4(),
                title: "Sin respuesta",
                name: `respuesta${lastOption}`,
                exist: true,
                status:false,
            };

            setOptions(prevObjetos => {
                const newOptions = [...prevObjetos, newOption]
                changeQuestionProps(id,'round',newOptions);
                return newOptions;
            }
            );
        }
    };

    const deleteOption = async(deleteId) => {
        const option = options.find((item) => item.id === deleteId);

        const destroyElement = () => {
            const filter = options.filter((item) => item.id !== deleteId);
            setOptions(filter);
            changeQuestionProps(id,'round',filter);
        }
        const destroyRegister = async() => {
            await axios.delete(`http:///suite-web.test/api/api/v1/test/data/question/delete/${deleteId}`);
        }

        if (Object.hasOwn(option, "exist")) {
            destroyElement();
        } else {
            AlertSimple(()=>destroyElement(),()=>destroyRegister());
        }
    };

    const handleNumeric = () => {
        const newValue = !numeric
        setNumeric(newValue);
        changeQuestionProps(id,'numeric',newValue);
    }

    useEffect(() => {
        if(data.length > 0){
            changeQuestionProps(id,'round',data);
        }else{
            changeQuestionProps(id,'round',dataDefault);
        }
    }, [])


    return (
        <div className="row ">
            <div className="col-12 d-flex align-items-center">
                <input style={{ width: "24px",height: "24px",}} className="form-control mr-3" type="checkbox" value="" id="flexCheckDefault" checked={numeric} onChange={handleNumeric}></input>
                <h6  className="m-0">Númerico</h6>
            </div>

            {options.map((item, index) => {
                return (
                    <React.Fragment key={index}>
                        <div
                            className="col-12 col-sm-12 col-md-12 col-lg-8 mt-3"
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
                                    value={item.id}
                                    checked={item.status}
                                    onChange={() => handleOptionChange(item.id)}
                                />
                                <input
                                    type={"text"}
                                    className="form-control"
                                    placeholder="Respuesta"
                                    style={{minWidth:100}}
                                    name={item.name}
                                    value={item.title}
                                    onChange={(e) =>
                                        handleTextChange(item.id, e.target.value)
                                    }
                                />
                                {
                                    numeric ? (<input
                                        type={"number"}
                                        className="form-control ml-3"
                                        style={{maxWidth:100, minWidth:50}}
                                        placeholder="Valor"
                                        name={`numeric-${id}-${item.name}`}
                                        value={item.value}
                                        onChange={(e) =>
                                            handleValueChange(item.id, e.target.value)
                                        }
                                    />): <></>
                                }
                                {options.length > 2 ? (
                                    <div>
                                        <i
                                            className="material-symbols-outlined"
                                            style={{
                                                marginLeft: "18px",
                                                cursor: "pointer",
                                            }}
                                            onClick={() =>
                                                deleteOption(item.id)
                                            }
                                        >
                                            close
                                        </i>
                                    </div>
                                ) : (
                                    <></>
                                )}
                            </form>
                        </div>
                    </React.Fragment>
                );
            })}
            <div className="col-12 mt-3 d-flex align-items-center">
                <input
                    style={{ width: "24px", height: "24px" }}
                    className="form-control "
                    type="radio"
                    value=""
                    id="flexCheckDefault"
                    disabled
                />
                <button
                    type="button"
                    className="btn btn-link"
                    onClick={addOption}
                >
                    Agregar opción o añadir respuesta
                </button>
            </div>
        </div>
    );
};

export const OptionSquard = ({ id, data = [],  changeQuestionProps, isNumeric }) => {
    // console.log(isNumeric)
    const [numeric, setNumeric] = useState(isNumeric);

    const dataDefault = [
        { id: uuidv4(), title: "respuesta 1", value:0, name: "respuesta1", status: true, exist: true, },
        { id: uuidv4(), title: "respuesta 2", value:0, name: "respuesta2", status: false, exist: true, },
    ];

    const [options, setOptions] = useState(data.length > 0 ? data : dataDefault);

    const handleTextChange = (optionId, newValue) => {
        const updateOptions = options.map((item) => {
            if(item.id === optionId){
                const updateItem = item;
                updateItem.title=newValue;
                return updateItem;
            }
            return item;
        });
        setOptions(updateOptions);
        changeQuestionProps(id,'round',updateOptions);
    };

    const handleValueChange = (optionId, newValue) => {
        const updateOptions = options.map((item) => {
            if(item.id === optionId){
                const updateItem = item;
                updateItem.value=newValue;
                return updateItem;
            }
            return item;
        });
        setOptions(updateOptions);
        changeQuestionProps(id,'round',updateOptions);
    }

    const addOption = () => {
        if(options.length <=4){
            const lastOption = options.length + 1;
            const newOption = {
                id: uuidv4(),
                title: "Sin respuesta",
                name: `respuesta${lastOption}`,
                status:false,
                exist: true,
            };

            setOptions(prevObjetos => {
                const newOptions = [...prevObjetos, newOption]
                changeQuestionProps(id,'round',newOptions);
                return newOptions;
            }
            );
        }
    };

    const deleteOption = async(deleteId) => {
        const option = options.find((item) => item.id === deleteId);

        const destroyElement = () => {
            const filter = options.filter((item) => item.id !== deleteId);
            setOptions(filter);
            changeQuestionProps(id,'round',filter);
        }
        const destroyRegister = async() => {
            await axios.delete(`http:///suite-web.test/api/api/v1/test/data/question/delete/${deleteId}`);
        }

        if (Object.hasOwn(option, "exist")) {
            destroyElement();
        } else {
            AlertSimple(()=>destroyElement(),()=>destroyRegister());
        }
    };

    const changeStatus = (id, status) => {
        const newStatus = !status;
        const updateOptions = options.map((item)=>{
            if(item.id === id){
                const updateItem = item;
                updateItem.status=newStatus;
                return updateItem;
            }
            return item
        });
        setOptions(updateOptions);
        changeQuestionProps(id,'round',updateOptions);
    };

    const handleNumeric = () => {
        const newValue = !numeric
        setNumeric(newValue);
        changeQuestionProps(id,'numeric',newValue);
    }

    useEffect(() => {
        if(data.length > 0){
            changeQuestionProps(id,'round',data);
        }else{
            changeQuestionProps(id,'round',dataDefault);
        }
    }, [])

    return (
        <div className="row ">
            <div className="col-12 d-flex align-items-center">
                <input style={{ width: "24px",height: "24px",}} className="form-control mr-3" type="checkbox" value="" id={`isNumeric-${id}`} checked={numeric} onChange={handleNumeric}></input>
                <h6  className="m-0">Númerico</h6>
            </div>
            {options.map((item, index) => {
                return (
                    <React.Fragment key={index}>
                        <div
                            className="col-10 col-sm-8 col-md-8 mt-3"
                        >
                            <form className="d-flex align-items-center">
                                <input
                                    style={{
                                        width: "24px",
                                        height: "24px",
                                    }}
                                    className="form-control mr-3"
                                    type="checkbox"
                                    value=""
                                    id="flexCheckDefault"
                                    checked={item.status}
                                    onChange={() =>
                                        changeStatus(item.id, item.status)
                                    }
                                ></input>
                                <input
                                    type={"text"}
                                    className="form-control"
                                    placeholder="Respuesta"
                                    name={item.name}
                                    value={item.title}
                                    onChange={(e) =>
                                        handleTextChange(
                                            item.id,
                                            e.target.value
                                        )
                                    }
                                />
                                {
                                    numeric ? (<input
                                        type={"number"}
                                        className="form-control ml-3"
                                        style={{maxWidth:100, minWidth:50}}
                                        placeholder="Valor"
                                        name={`numeric-${item.name}`}
                                        value={item.value}
                                        onChange={(e) =>
                                            handleValueChange(item.id, e.target.value)
                                        }
                                    />): <></>
                                }
                                {options.length > 2 ? (
                                    <div>
                                        <i
                                            className="material-symbols-outlined"
                                            style={{
                                                marginLeft: "18px",
                                                cursor: "pointer",
                                            }}
                                            onClick={() =>
                                                deleteOption(item.id)
                                            }
                                        >
                                            close
                                        </i>
                                    </div>
                                ) : (
                                    <></>
                                )}
                            </form>
                        </div>
                    </React.Fragment>
                );
            })}
            <div className="col-12 mt-3 d-flex align-items-center">
                <input
                    style={{ width: "24px", height: "24px" }}
                    className="form-control"
                    type="checkbox"
                    value=""
                    id="flexCheckDefault"
                    disabled
                />
                <button
                    type="button"
                    className="btn btn-link"
                    onClick={addOption}
                >
                    Agregar opción o añadir respuesta
                </button>
            </div>
        </div>
    );
};

export const OptionSelect = ({ id, data = [],  changeQuestionProps, isNumeric }) => {
    const [numeric, setNumeric] = useState(isNumeric);
    const dataDefault = [
        {
            id: uuidv4(),
            title: "respuesta 1",
            name: "respuesta1",
            exist: true,
        },
        {
            id: uuidv4(),
            title: "respuesta 2",
            name: "respuesta2",
            exist: true,
        },
    ];
    const [options, setOptions] = useState(data.length > 0 ? data : dataDefault);

    const handleTextChange = (optionId, newValue) => {
        const updateOptions = options.map((item) => {
            if(item.id === optionId){
                const updateItem = item;
                updateItem.title=newValue;
                return updateItem;
            }
            return item;
        });
        setOptions(updateOptions);
        changeQuestionProps(id,'round',updateOptions);
    };

    const addOption = () => {
        if(options.length <= 4){
            const lastOption = options.length + 1;
            const newOption = {
                id: uuidv4(),
                title: "Sin respuesta",
                name: `respuesta${lastOption}`,
                exist: true,
            };
            setOptions(prevObjetos => {
                const newOptions = [...prevObjetos, newOption]
                changeQuestionProps(id,'round',newOptions);
                return newOptions;
            }
            );
        }
    };

    const deleteOption = async(deleteId) => {
        const option = options.find((item) => item.id === deleteId);

        const destroyElement = () => {
            const filter = options.filter((item) => item.id !== deleteId);
            setOptions(filter);
            changeQuestionProps(id,'round',filter);
        }
        const destroyRegister = async() => {
            await axios.delete(`http:///suite-web.test/api/api/v1/test/data/question/delete/${deleteId}`);
        }

        if (Object.hasOwn(option, "exist")) {
            destroyElement();
        } else {
            AlertSimple(()=>destroyElement(),()=>destroyRegister());
        }
    };

    const handleNumeric = () => {
        const newValue = !numeric
        setNumeric(newValue);
        changeQuestionProps(id,'numeric',newValue);
    }

    useEffect(() => {
        if(data.length > 0){
            changeQuestionProps(id,'round',data);
        }else{
            changeQuestionProps(id,'round',dataDefault);
        }
    }, []);

    return (
        <div className="row ">
            <div className="col-12 d-flex align-items-center">
                <input style={{ width: "24px",height: "24px",}} className="form-control mr-3" type="checkbox" value="" id="flexCheckDefault" checked={numeric} onChange={handleNumeric}></input>
                <h6  className="m-0">Númerico</h6>
            </div>
            {options.map((item, index) => {
                return (
                    <React.Fragment key={index}>
                        <div
                            className="col-10 col-sm-8 col-md-8 mt-3"
                        >
                            <form className="d-flex align-items-center">
                                <label
                                    className="mr-3"
                                    style={{ marginBottom: "0px" }}
                                >
                                    {`${index + 1}.`}
                                </label>
                                <input
                                    type={"text"}
                                    className="form-control"
                                    placeholder="Respuesta"
                                    name={item.name}
                                    value={item.title}
                                    onChange={(e) =>
                                        handleTextChange(
                                            item.id,
                                            e.target.value
                                        )
                                    }
                                />
                                {
                                    numeric ? (<input
                                        type={"number"}
                                        className="form-control ml-3"
                                        style={{maxWidth:100, minWidth:50}}
                                        placeholder="Valor"
                                        name={`numeric-${item.name}`}
                                        value={item.value}
                                        onChange={(e) =>
                                            handleValueChange(item.id, e.target.value)
                                        }
                                    />): <></>
                                }
                                {options.length > 2 ? (
                                    <div>
                                        <i
                                            className="material-symbols-outlined"
                                            style={{
                                                marginLeft: "18px",
                                                cursor: "pointer",
                                            }}
                                            onClick={() =>
                                                deleteOption(item.id)
                                            }
                                        >
                                            close
                                        </i>
                                    </div>
                                ) : (
                                    <></>
                                )}
                            </form>
                        </div>
                    </React.Fragment>
                );
            })}
            <div className="col-12 mt-3 d-flex align-items-center">
                <button
                    type="button"
                    className="btn btn-link"
                    onClick={addOption}
                >
                    Agregar opción o añadir respuesta
                </button>
            </div>
        </div>
    );
};

export const OptionDate = ({id, data = {}, changeQuestionProps}) => {
    useEffect(() => {
        changeQuestionProps(id,'dataDelete',data);
      }, []);
    return (
        <div
            className="d-flex justify-content-between align-items-center"
            style={{
                width: "232px",
                height: "48px",
                background: "#F8FAFC 0% 0% no-repeat padding-box",
                border: "1px solid #D5D5D5",
                borderRadius: "4px",
                opacity: 1,
            }}
        >
            <div>
                <p
                    className="p-0"
                    style={{
                        margin: "0px 0px 0px 18px",
                        font: "normal normal normal 14px/17px Roboto",
                        letterSpacing: "0px",
                        color: "#D5D5D5",
                        opacity: 1,
                    }}
                >
                    dd/mm/aaaa
                </p>
            </div>
            <div>
                <i
                    className="material-symbols-outlined"
                    style={{ marginRight: "13px", color: "#D5D5D5" }}
                >
                    calendar_month
                </i>
            </div>
        </div>
    );
};

export const OptionTime = ({id, data = {}, changeQuestionProps}) => {
    useEffect(() => {
        changeQuestionProps(id,'dataDelete',data);
      }, []);
    return (
        <div
            className="d-flex justify-content-between align-items-center"
            style={{
                width: "232px",
                height: "48px",
                background: "#F8FAFC 0% 0% no-repeat padding-box",
                border: "1px solid #D5D5D5",
                borderRadius: "4px",
                opacity: 1,
            }}
        >
            <div>
                <p
                    className="p-0"
                    style={{
                        margin: "0px 0px 0px 18px",
                        font: "normal normal normal 14px/17px Roboto",
                        letterSpacing: "0px",
                        color: "#D5D5D5",
                        opacity: 1,
                    }}
                >
                    00:00
                </p>
            </div>
            <div>
                <i
                    className="material-symbols-outlined"
                    style={{ marginRight: "13px", color: "#D5D5D5" }}
                >
                    schedule
                </i>
            </div>
        </div>
    );
};

export const OptionImage = ({id, data={}, changeQuestionProps}) => {
    const [file, setfile] = useState(null);

    const handleFile = (e) => {
        const file = e.target.files[0];
        setfile(file);
        changeQuestionProps(id,'image',file);
    };



    return (
        <div>
            <input type="file" id={`inputfile${id}`} onChange={handleFile} />
            <label className="lblFile" htmlFor={`inputfile${id}`}>Cargar Imagen</label>
            {
                file ? (
                    <div className="fileContainer">
                        <img src={URL.createObjectURL(file)} alt="" className="img-fluid fileImg" />
                    </div>
                ):(<></>)
            }
            {
                data.url && !file ? (
                    <div className="fileContainer">
                        <img src={data.url} alt="" className="img-fluid fileImg" />
                    </div>
                ):(<></>)
            }
        </div>
    );
}

export const OptionCurrency = ({id, data = {}, changeQuestionProps}) => {
    const dataDefault = {};
    dataDefault[`minimo-${id}`] = "$";
    dataDefault[`maximo-${id}`] = "$";


    const [inputValues, setInputValues] = useState( Object.hasOwn(data,`minimo-${id}`) || Object.hasOwn(data, `maximo-${id}`) ? data : dataDefault);

    const formatNumber = (number) => {
        return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
      };

    const handleInputChange = async(e) => {
        const { name, value } = e.target;
        const newValue = value.replace(/,/g, '').replace('$', '')
        // console.log(newValue.replace(/\B(?=(\d{3})+(?!\d))/g, ','))
        data[name] = value;
        setInputValues({
          ...inputValues,
          [name]:  "$" + formatNumber(newValue)
        });

        // changeQuestionProps(id,'minMax', data);
    };

    useEffect(() => {

        if(Object.hasOwn(data, `minimo-${id}`) || Object.hasOwn(data, `maximo-${id}`)){
                    changeQuestionProps(id,'minMax', data);
        }else{
                data = {}
                data = dataDefault;
                changeQuestionProps(id,'minMax', dataDefault);
            }
    }, []);

    return (
        <div className="row d-flex justify-content-between d-flex align-items-baseline">
            <div className="col-12 col-md-8">
                <label> Campo divisa</label>
                <HrSimple
                    styles={{
                        width: "100%",
                        borderWidth: "1px",
                        borderColor: "#C5C5C5",
                        borderStyle: "dashed",
                        marginTop: "0px",
                        marginLeft:"0px",
                    }}
                />
            </div>

            <div className="col-12 col-md-12">
                <p>Definir el rango aceptado</p>
            </div>
            <div className="col-12 col-md-12 d-flex align-items-baseline gap-1">
                <div className="form-group pl-0 anima-focus">
                    <input
                        type="text"
                        className="form-control"
                        placeholder=""
                        name={`minimo-${id}`}
                        value={inputValues[`minimo-${id}`]}
                        onChange={handleInputChange}
                        inputMode="numeric"
                    />
                    <label >Minimo</label>
                </div>
                <div className="form-group pl-0 anima-focus">
                    <input
                        type="text"
                        className="form-control"
                        placeholder=""
                        name={`maximo-${id}`}
                        value={inputValues[`maximo-${id}`]}
                        onChange={handleInputChange}
                        inputMode="numeric"
                    />
                    <label >Máximo</label>
                </div>
            </div>
        </div>
    );
}
