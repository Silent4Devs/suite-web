import "../../../css/common/buttons.css";
export const BtnSimple = ({title ,onClick = null, background=null, color=null, height=null, width=null, type="button"}) => {
    const btnStyle = {
        background: background ? background : "#006AD6",
        color : color ? color : "#FFFFFF",
        height: height ? height : "45px",
        width: width ? width : "154px",
    }
    return(
        <button type={type} className="btn btn-simple" style={btnStyle} onClick={onClick}>
            {title}
        </button>
    )
 }

export const BtnSecondary = ({title, onClick=null ,background=null, color=null, height=null, width=null, borderColor=null,}) => {
    const btnStyle = {
        background: background ? background : "#FFFFFF",
        color : color ? color : "#006DDB",
        height: height ? height : "45px",
        width: width ? width : "154px",
        borderColor: borderColor ? borderColor : "#006DDB" ,
    }
    return(
        <button type="button" className="btn btn-simple-secondary" style={btnStyle} onClick={onClick}>
            {title}
        </button>
    )
  }

  export const BtnTertiary = ({title, onClick=null ,background=null, color=null, height=null, width=null,}) => {
    const btnStyle = {
        background: background ? background : "#FFFFFF",
        color : color ? color : "#006DDB",
        height: height ? height : "45px",
        width: width ? width : "154px",
        border: "none" ,
    }
    return(
        <button type="button" className="btn btn-simple-secondary" style={btnStyle} onClick={onClick}>
            {title}
        </button>
    )
  }

export const BtnIcon = ({onClick=null, icon, title=null, colorIcon=null, sizeIcon=null, family='material-symbols-outlined' }) => {
    const styleIcon = {
        color: colorIcon ? colorIcon : null,
        fontSize: sizeIcon ? sizeIcon: '24px',
    }

    return(
        <button className="btn" style={{textAlign:"center"}} onClick={onClick}>
            <span className={family} style={styleIcon}>
                {icon}
            </span>
            {title}
        </button>
    )
 }

