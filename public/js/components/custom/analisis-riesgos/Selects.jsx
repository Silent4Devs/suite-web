import React from "react";
import { SelectSimple } from "../../common/Selects";

export const SelectAnalisisRiesgo = ({options,size,name, value, handleChangeOption ,style}) => {
    return (
        <div className={`col-12 col-sm-${size}`}>
            <SelectSimple options={options} name={name} value={value} handleChangeOption={handleChangeOption} style={style}/>
        </div>
    );
};


