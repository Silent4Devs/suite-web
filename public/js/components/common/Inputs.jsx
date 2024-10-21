import React, { useState } from "react";

export const InputSimple = ({ title, name, type="text", value, handleChange, background=null, color=null, width=null, required=true } ) => {
    const [error, setError] = useState('');
    const inputStyle = {
        background: background ? background : "#FFFFFF",
        color: color ? color : "#575757",
        width: width ? width : "auto",
    }
    return (
            <div className="form-group pl-0 anima-focus">
                <input
                    type={type}
                    className="form-control"
                    style={inputStyle}
                    placeholder=""
                    name={name}
                    value={value}
                    onChange={(e)=>handleChange(e.target.value)}
                    required={required}

                />
                <label >{title}</label>
            </div>
    );
};

export const InputSimpleDisabled = ({ title, name, type="text", value, background=null, color=null, width=null, heigth=null }) => {
    const inputStyle = {
        background: background ? background : "#EFEFEF",
        color: color ? color : "#575757",
        width: width ? width : "auto",
        heigth: heigth ? heigth : "auto",
    }
    return (
            <div className="form-group pl-0 anima-focus">
                <input
                    type={type}
                    className="form-control"
                    style={inputStyle}
                    placeholder=""
                    name={name}
                    value={value}
                    disabled
                />
                <label >{title}</label>
            </div>
    );
 }


