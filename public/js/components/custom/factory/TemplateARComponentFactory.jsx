import { OptionCatalog, OptionCurrency, OptionDate, OptionImage, OptionNumber, OptionParrafo, OptionRound, OptionSelect, OptionSquard, OptionTextSimple, OptionTime } from "../analisis-riesgos/Options";

class TemplateARComponentFactory {
    createTemplateARComponent(type, id, changeQuestionProps, data, handleTileChange, isNumeric) {
        switch (type) {
            case "1":
                return <OptionTextSimple id={id} changeQuestionProps={changeQuestionProps} data={data}/>;
            case "2":
                return <OptionParrafo id={id} changeQuestionProps={changeQuestionProps} data={data}/>;
            case "3":
                return <OptionNumber id={id} changeQuestionProps={changeQuestionProps} data={data}/>;
            case "4":
                return <OptionCatalog id={id} changeQuestionProps={changeQuestionProps} data={data} handleTileChange={handleTileChange}/>;
            case "5":
                return <OptionRound id={id} changeQuestionProps={changeQuestionProps} data={data} isNumeric={isNumeric}/>;
            case "6":
                return <OptionSquard id={id} changeQuestionProps={changeQuestionProps} data={data} isNumeric={isNumeric}/>;
            case "7":
                return <OptionSelect id={id} changeQuestionProps={changeQuestionProps} data={data} isNumeric={isNumeric}/>;
            case "8":
                return <OptionDate id={id} changeQuestionProps={changeQuestionProps} data={data}/>;
            case "9":
                return <OptionTime id={id} changeQuestionProps={changeQuestionProps} data={data}/>;
            case "10":
                return <OptionImage id={id} changeQuestionProps={changeQuestionProps} data={data}/>
            case "15":
                return <OptionCurrency id={id} changeQuestionProps={changeQuestionProps} data={data}/>
            default :
                return <div>Sin option</div>

        }
    }
}

export default TemplateARComponentFactory;
