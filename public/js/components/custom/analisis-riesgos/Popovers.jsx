export const ContainerShowSizes = ({handleChangeSize}) => {
    return(
        <div  style={{
            position:"absolute",
            minWidth: "112px",
            height: "148px",
            right:60,
           background: "#FFFFFF 0% 0% no-repeat padding-box",
           boxShadow: "0px 3px 3px #0000001A",
           borderRadius: "9px",
           opacity: 1,
           padding:"10px",
           zIndex:2,
          }}>
            <p className='m-0'>Tamaño</p>
            <div style={{width: "100%",
                height: "17px",background: "#C3EBC1 0% 0% no-repeat padding-box",
                opacity: 1, marginBottom:10, cursor:"pointer"}} onClick={()=>handleChangeSize(12)}></div>
            <div className="d-flex" style={{gap:"5px", cursor:"pointer"}} onClick={()=>handleChangeSize(9)}>
            <div style={{width: "75%",
                height: "17px",background: "#C3EBC1 0% 0% no-repeat padding-box",
                opacity: 1,  marginBottom:10}}></div>
            <div style={{width: "25%",
                height: "17px",background: "#CCCCCC 0% 0% no-repeat padding-box",
                opacity: 1,  marginBottom:10}}></div>
            </div>
            <div className="d-flex" style={{gap:"5px", cursor:"pointer"}} onClick={()=>handleChangeSize(6)}>
            <div style={{width: "50%",
                height: "17px",background: "#C3EBC1 0% 0% no-repeat padding-box",
                opacity: 1,  marginBottom:10,}}></div>
                <div style={{width: "50%",
                height: "17px",background: "#CCCCCC 0% 0% no-repeat padding-box",
                opacity: 1,  marginBottom:10}}></div>
            </div>
            <div className="d-flex" style={{gap:"5px", cursor:"pointer"}} onClick={()=>handleChangeSize(3)}>
            <div style={{width: "25%",
                height: "17px",background: "#C3EBC1 0% 0% no-repeat padding-box",
                opacity: 1,  marginBottom:10}}></div>
                <div style={{width: "25%",
                height: "17px",background: "#CCCCCC 0% 0% no-repeat padding-box",
                opacity: 1,  marginBottom:10}}></div>
                <div style={{width: "25%",
                height: "17px",background: "#CCCCCC 0% 0% no-repeat padding-box",
                opacity: 1,  marginBottom:10}}></div>
                <div style={{width: "25%",
                height: "17px",background: "#CCCCCC 0% 0% no-repeat padding-box",
                opacity: 1,  marginBottom:10}}></div>
            </div>
          </div>
    )
}

export const ContainerMoreInfo = () => {
  return(
    <div  style={{
        position:"absolute",
        maxWidth: "350px",
        minHeight: "51px",
        right:90,
       background: "#FFFFFF 0% 0% no-repeat padding-box",
       boxShadow: "0px 3px 3px #0000001A",
       borderRadius: "9px",
       opacity: 1,
       padding:"18px",
       display:"flex",
       justifyContent:"center",
       alignItems:"center",
       zIndex:2,
      }}>
        <p className="m-0 p-0">
        Selecciona el tamaño que le asignaras al campo seleccionado.
        </p>
      </div>
  )
}

export const PopoverTemplateSettings = () => {
    return(
        <div  style={{
                        position:"absolute",
                        maxWidth: "800px",
                        width:"800px",
                        minHeight: "60px",
                        top:-20,
                        right:60,
                        background: "#FFFFFF 0% 0% no-repeat padding-box",
                        boxShadow: "0px 3px 3px #0000001A",
                        borderRadius: "9px",
                        opacity: 1,
                        padding:"18px",
                        display:"flex",
                        justifyContent:"center",
                        alignItems:"center",
                        zIndex:4,
                    }}>
            <p className="m-0 p-0">
                Los campos que no se definieron en el template y que ahora son visibles en la configuración, son necesarios para evaluar el nievel de riesgo, es por ello que la herramienta los proporciona y no podrán eliminarse.
            </p>
        </div>

    )
}

export const PopoverTableSettings = () => {
    return(
        <div  style={{
                        position:"absolute",
                        maxWidth: "800px",
                        width:'400px',
                        minHeight: "30px",
                        right:90,
                        top:-20,
                        background: "#FFFFFF 0% 0% no-repeat padding-box",
                        boxShadow: "0px 3px 3px #0000001A",
                        borderRadius: "9px",
                        opacity: 1,
                        padding:"18px",
                        display:"flex",
                        justifyContent:"center",
                        alignItems:"center",
                        zIndex:4,
                    }}>
            <p className="m-0 p-0">
                Selecciona los campos que se mostrarán en la tabla de resultados de tu formulario.
            </p>
        </div>

    )
}
