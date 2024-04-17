import React from "react";

export const InputSimple = ({ title, name, size = 4 ,styles="", type="text"} ) => {
    return (
        <div className={`col-${size} ${styles}`}>
            <div className="form-group pl-0 anima-focus">
                <input
                type={type}
                    className="form-control"
                    placeholder=""
                    name={name}
                />
                <label >{title}</label>
            </div>
        </div>
    );
};

export const TextAreaSimple = ({title, name, size = 4 ,className=""}) => {
    return (
        <div className={`col-${size} ${className}`} >
            <div className="form-group pl-0 anima-focus">
                <textarea
                    className="form-control"
                    placeholder=""
                    name={name}
                    style={{minHeight:"31px"}}
                />
                <label >{title}</label>
            </div>
        </div>
    );
}

export const InputDate = ({ title, name, size = 4 ,styles="", disabled=false}) => {
    return (
        <div className={`col-${size} ${styles}`}>
            <div className="form-group pl-0 anima-focus">
                <input
                    type="date"
                    className="form-control"
                    placeholder=""
                    name={name}
                    disabled={disabled}
                />
                <label >{title}</label>
            </div>
        </div>
    );
};

export const InputTime = ({ title, name, size = 4 ,styles=""}) => {
    return (
        <div className={`col-${size} ${styles}`}>
            <div className="form-group pl-0 anima-focus">
                <input
                    type="time"
                    className="form-control"
                    placeholder=""
                    name={name}
                />
                <label >{title}</label>
            </div>
        </div>
    );
};
