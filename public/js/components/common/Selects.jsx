import React from "react";

export const SelectAnalisisRiesgo = ({options,size,name, handleChangeOption}) => {
    return (
        <div className={`col-${size}`}>
            <div className="form-group pl-0 anima-focus">
            <select id={name} name={name} className="form-control" onChange={handleChangeOption}>
                {options.map( (item,index) => {
                    return(
                        <option key={index} value={item.id}>{item.title}</option>
                    )
                })}
            </select>

            </div>
        </div>
    );
};
