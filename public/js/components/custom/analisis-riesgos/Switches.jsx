export const SwitchObligatory = ({id, value, handleSwitchChange}) => {
    return(
        <div className="custom-control custom-switch d-flex align-items-center">
            <input type="checkbox" className="custom-control-input" id={`switchObligatory-${id}`} checked={value} onChange={handleSwitchChange}/>
            <label className="custom-control-label" htmlFor={`switchObligatory-${id}`} style={{userSelect:"none"}}>Campo obligatorio</label>
        </div>
    )
 }
