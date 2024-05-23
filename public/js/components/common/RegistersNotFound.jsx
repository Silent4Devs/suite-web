export const RegisterNotFound = (message = null) => {
    return (
        <div>
            <h5>
                {
                    message ? message : "No hay elementos registrados"
                }
            </h5>
        </div>
    )
 }
