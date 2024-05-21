import '../../../../css/templateAnalisisRiesgo/tables.css'
import { BtnIcon, BtnSecondary, BtnSimple, BtnTertiary } from '../../common/Buttons';
import { CardContainer } from '../../common/Containers';
import { HrSimple } from '../../common/Hr';
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
    console.log(data)
    return(
        <div>
            <div className="row">
                <di className="col-12 col-md-4">
                    <div className="row">
                        <div className="col-12 col-md-8">
                            1.1
                        </div>
                        <div className="col-12 col-md-4">
                            1.2
                        </div>
                    </div>
                </di>
                <di className="col-12 col-md-4">
                    2
                </di>
                <di className="col-12 col-md-4">
                    3
                </di>
            </div>

        </div>
    )
}
