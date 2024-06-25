export const CardContainer = ({children, width=null}) => {
    return(
        <div className="card" style={{width: width ? width: 'auto'}}>
            <div className="card-body">
                {children}
            </div>
        </div>
    )
 }
