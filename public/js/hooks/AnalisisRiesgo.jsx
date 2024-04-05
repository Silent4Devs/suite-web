import React, {useState} from 'react'

export const useGenerateTemplateAnalisisRiesgo = () => {

    const [option, setOption] = useState("1");

    const handleChangeOption = (e) => {
        const newValue = e.target.value;
        setOption(newValue);
     }

     return { option, handleChangeOption}
 }
