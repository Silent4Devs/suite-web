export const BtnAddSection = ({onClick, icon, title}) => {
    return(
        <button type="button" className="btn" style={{textAlign:"center", color:"#306BA9"}} onClick={onClick}>
            <span className="material-symbols-outlined">
                {icon}
            </span>
            {title}
        </button>
    )
 }
