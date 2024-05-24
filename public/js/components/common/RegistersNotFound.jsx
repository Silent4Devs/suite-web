export const RegisterNotFound = (message=null) => {
    const showText = () => {
        if(message){
            return "No hay Elementos registrados"
        }else{
            return message
        }
    }
    return (
        <div>
            <h6>
                {showText()}
            </h6>
        </div>
    )
 }
