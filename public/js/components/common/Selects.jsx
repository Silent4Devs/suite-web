import React from "react";

export const SelectAnalisisRiesgo = ({options,size,name, value, handleChangeOption ,style={}}) => {
    return (
        <div className={`col-12 col-sm-${size}`}>
            <div className="form-group pl-0 anima-focus">
            <select id={name} value={value} name={name} className="form-control" onChange={handleChangeOption} style={style}>
                {options.map( (item,index) => {
                    return(
                        <option key={index} value={item.id} >
                            {item.title}
                        </option>
                    )
                })}
            </select>

            </div>
        </div>
    );
};


