import React from "react";

export const InputSimple = ({ title, name, type="text", value, handleChange} ) => {
    return (
            <div className="form-group pl-0 anima-focus">
                <input
                type={type}
                    className="form-control"
                    placeholder=""
                    name={name}
                    value={value}
                    onChange={(e)=>handleChange(e.target.value)}
                />
                <label >{title}</label>
            </div>
    );
};
