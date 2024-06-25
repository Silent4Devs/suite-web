export const SelectSimple = ({options,name, value, handleChangeOption = null ,style={}}) => {
    return(
        <div className="form-group pl-0 anima-focus">
            <select id={name} value={value} name={name} className="form-control" onChange={handleChangeOption} style={style}>
            <option value="" disabled selected>Selecciona una opción...</option>
                {options.map( (item,index) => {
                    return(
                        <option key={index} value={item.id} >
                            {item.title}
                        </option>
                    )
                })}
            </select>
        </div>
    )
 }
