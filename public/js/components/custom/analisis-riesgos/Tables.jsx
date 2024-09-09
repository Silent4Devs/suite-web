import { useEffect, useState } from 'react';
import '../../../../css/templateAnalisisRiesgo/tables.css'
import { BtnIcon, BtnSecondary, BtnSimple, BtnTertiary } from '../../common/Buttons';
import { InputSimpleDisabled } from '../../common/Inputs';
export const TableFormulas = ({registers, addVariable, removeVariable}) => {
    return(
        <div style={{overflow:"auto"}}>
            <table class="table table-borderless">
                <thead>
                    <tr>
                        <th scope="col" className='title' style={{width:"10%"}}>ID</th>
                        <th scope="col" className='title' style={{width:"37%"}}>Variable</th>
                        <th scope="col" className='title' style={{width:"52%"}}>Utilizar</th>
                    </tr>
                </thead>
                <tbody>
                    {registers.map((item, index)=>{
                        return(
                            <tr key={index}>
                                <td className='title d-flex align-items-center'>{index + 1}</td>
                                <td >
                                <InputSimpleDisabled title={""} name={`title-`} value={item.title} heigth="40px" />
                                </td>
                                <td className='d-flex gap-2'>
                                <BtnSecondary title="USAR" width="100%" onClick={()=>addVariable(item)}/>
                                <BtnTertiary title="LIMPIAR" width="100%" onClick={()=>removeVariable(item.id)}/>
                                </td>
                            </tr>
                        )
                    })}
                </tbody>
            </table>
        </div>
    );
}

export const TableSettigs = ({data}) => {
    const [columnas, setColumnas] = useState(2);
    const [questions, setQuestions] = useState(data.questions)
    const [formulas, setFormulas] = useState(data.formulas);

    const headerTable = (columnas) => {
        const headers = []
        for(let i=0; i<=columnas; i++){
            headers.push(
                <div className="col-12 col-md-4" key={i}>
                    <div className="row">
                        <div className="col-6 col-md-9">
                            Campo
                        </div>
                        <div className="col-6 col-md-3 d-flex justify-content-center">
                            Mostrar
                        </div>
                    </div>
                </div>
            );

        }
        return headers;
    }

    const changeStatusQuestion = (id, status) => {
        const newStatus = !status;
        const updateQuestions = data.questions.map((item)=>{
            if(item.id === id){
                const updateItem = item;
                updateItem.is_show = newStatus;
                return updateItem;
            }
            return item
        });
        setQuestions(updateQuestions);
        data.questions = updateQuestions;
    };

    const changeStatusFormula = (id, status) => {
        const newStatus = !status;
        const updateFormulas = data.formulas.map((item)=>{
            if(item.id === id){
                const updateItem = item;
                updateItem.is_show = newStatus;
                return updateItem;
            }
            return item
        });
        setFormulas(updateFormulas);
        data.formulas = updateFormulas;
    };

    const handleResize = () => {
        if (window.innerWidth <= 700) {
          setColumnas(0);
        } else {
          setColumnas(2);
        }
      };

    useEffect(() => {
        window.addEventListener('resize', handleResize);
        // Llamar a la función al montar el componente
        handleResize();
      }, []);

    return(
        <div>
            <div className="row" style={{marginBottom:"20px"}}>
                {headerTable(columnas)}
            </div>
            <div className="row">
            {questions.map((item)=>{
                return(
                    <div className='col-12 col-md-4' style={{marginBottom:"33px"}}>
                        <div className="row">
                            <div className="col-6 col-md-9">{item.title}</div>
                            <div className="col-6 col-md-3 d-flex justify-content-center">
                            <input
                                    style={{
                                        width: "24px",
                                        height: "24px",
                                    }}
                                    className="form-control "
                                    type="checkbox"
                                    value=""
                                    id={`checkoutSettigns-q-${item.question_id}`}
                                    checked={item.is_show}
                                    onChange={() =>
                                        changeStatusQuestion(item.id, item.is_show)
                                    }
                                ></input>
                            </div>
                        </div>
                    </div>
                )
            })}
            {formulas.map((item)=>{
                return(
                    <div className='col-12 col-md-4'>
                        <div className="row">
                            <div className="col-6 col-md-9">{item.title}</div>
                            <div className="col-6 col-md-3 d-flex justify-content-center">
                            <input
                                    style={{
                                        width: "24px",
                                        height: "24px",
                                    }}
                                    className="form-control"
                                    type="checkbox"
                                    value=""
                                    id={`checkoutSettigns-f-${item.formula_id}`}
                                    checked={item.is_show}
                                    onChange={() =>
                                        changeStatusFormula(item.id, item.is_show)
                                    }
                                ></input>
                            </div>
                        </div>
                    </div>
                )
            })}
            </div>
        </div>
    )
}
