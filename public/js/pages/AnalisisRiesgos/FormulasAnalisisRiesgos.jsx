import React, { useState } from 'react'
import { InputSimple } from '../../components/common/Inputs'
import { BtnSecondary, BtnSimple } from '../../components/common/Buttons'
import { CardContainer } from '../../components/common/Containers';
import Calculator from '../../components/custom/analisis-riesgos/calculator/Calculator';
import { TableFormulas } from '../../components/custom/analisis-riesgos/Tables';
import { HrSimple } from '../../components/common/Hr';
import { RecordFormulas } from '../../components/custom/analisis-riesgos/Formulas';
import { useFormulasAnalisisRiesgos } from '../../hooks/AnalisisRiesgo';
import { SelectAnalisisRiesgo } from '../../components/custom/analisis-riesgos/Selects';

const FormulasAnalisisRiesgos = ({template}) => {
    const { formula,setFormula, formulas, handleChangeFormula, handleChangeStatus, handleChangeTitle, hrStyle,
            options, handleChangeOption, option, addOption, registers, addVariable, removeVariable, addFormula,
            deleteFormula, sections, handleChangeSection, handleSubmit,loading, btnEditFormulas} = useFormulasAnalisisRiesgos(template);

    if(loading.options && loading.formulas){
        return(<div>Cargando</div>)
    }
  return (
    <form id='generateTemplateFormulas' onSubmit={handleSubmit} className='mb-3'>
        <CardContainer>
            <h3>Generación de fórmula</h3>
            <div className="row mb-4">
                <div className="col-12 col-md-10">
                    <InputSimple title="" name="formula" value={formula} handleChange={handleChangeFormula} background="#F1F1F1" required={false}/>
                </div>
                <div className="col-12 col-md-2 d-flex justify-content-start">
                    <BtnSimple title="AGREGAR" width="100%" onClick={()=>addFormula()}/>
                </div>
            </div>
            <div className="row d-flex justify-content-between">

                <div className="col-12 col-md-4 d-flex justify-content-center main">
                    <Calculator formula={formula} setFormula={setFormula} addFormula={addFormula} />
                </div>
                <div className="col-12 col-md-8 d-flex align-items-evenly flex-column">
                    <h4>Añadir variable</h4>
                    <p>Seleccionar los campos deseados</p>
                    <div className="row d-flex align-items-baseline" style={{marginBottom:"40px"}}>
                        <SelectAnalisisRiesgo options={options} size={9} name="options-formulas" value={option} handleChangeOption={handleChangeOption}/>
                        <div className="col-12 col-md-3" >
                            <BtnSecondary title="Añadir" onClick={addOption} width="100%"/>
                        </div>
                    </div>
                    <TableFormulas registers={registers} addVariable={addVariable} removeVariable={removeVariable}/>
                </div>
            </div>
            <HrSimple styles={hrStyle}/>
            <h3>Historial de fórmulas</h3>
            <RecordFormulas formulas={formulas} handleChangeStatus={handleChangeStatus} handleChangeTitle={handleChangeTitle} deleteFormula={deleteFormula} options={sections} handleChangeSection={handleChangeSection}/>
        </CardContainer>
        <button ref={btnEditFormulas} type='submit' style={{visibility:"hidden"}}>Guardar</button>

    </form>
  )
}

export default FormulasAnalisisRiesgos
