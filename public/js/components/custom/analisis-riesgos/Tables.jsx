import '../../../../css/templateAnalisisRiesgo/tables.css'
import { BtnIcon, BtnSecondary, BtnSimple, BtnTertiary } from '../../common/Buttons';
import { CardContainer } from '../../common/Containers';
import { HrSimple } from '../../common/Hr';
import { InputSimpleDisabled } from '../../common/Inputs';
export const TableFormulas = ({registers, addVariable, removeVariable}) => {
    return(
        <div style={{overflow:"auto"}}>
            {/* <table className='tbl-formulas'>
                <thead>
                    <tr>
                        <th className='title' style={{width:"10%"}}>ID</th>
                        <th className='title' style={{width:"37%"}}>Variable</th>
                        <th className='title' style={{width:"52%"}}>Utilizar</th>
                    </tr>
                </thead>
                <tbody>
                    <tr >
                        <td className='title d-flex align-items-center'>1</td>
                        <td>
                        <InputSimpleDisabled title={""} name={`title-`} value={"test"} />
                        </td>
                        <td className='d-flex gap-2'>
                        <BtnSimple title="AGREGAR" width="100%"/>
                        <BtnSimple title="AGREGAR" width="100%" />
                        </td>
                    </tr>

                </tbody>
            </table> */}
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

export const TableSettigs = () => {
    return(
        <CardContainer width="100%">
            <div className="row d-flex align-items-center">
                <div className="col-10">
                    <h6 className='mb-0'>Respuestas</h6>
                </div>
                <div className="col-2 d-flex justify-content-end" style={{paddingRight:"2px"}}>
                    <BtnIcon icon="lightbulb_circle"/>
                </div>
            </div>
            <HrSimple/>
        </CardContainer>
    )
}
