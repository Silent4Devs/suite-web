import React from "react";
import { InputSimple } from "../../common/Inputs";

export const ContainerInputAnalisisRiesgo = ({ title, name, size = 4 ,styles="", type="text", value, handleChange} ) => {
    return (
        <div className={`col-12 col-sm-${size} ${styles}`}>
            <InputSimple title={title} name={name}  type={type} value={value} handleChange={handleChange}/>
        </div>
    );
};

export const InputSection = ({id,title,onChangeTitle,setEditMode}) => {
    return(
        <input className="form-control mt-3 mb-3" autoFocus value={title} name={`inputSection-${id}`}
            onChange={(e)=>onChangeTitle(e.target.value)} onBlur={() => {setEditMode(false);}}
            onKeyDown={(e) => {
                if (e.key !== "Enter") return; setEditMode(false); }}/>
    )
}

{/* <input className="form-control mt-3 mb-3" autoFocus
                                value={title}
                                onChange={(e)=>onChangeTitle(e.target.value)}
                                onBlur={() => {
                                    setEditMode(false);
                                }}
                                onKeyDown={(e) => {
                                    if (e.key !== "Enter") return;
                                    setEditMode(false);
                                }}/> */}
