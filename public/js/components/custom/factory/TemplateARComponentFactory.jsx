import { OptionDate, OptionImage, OptionNumber, OptionParrafo, OptionRound, OptionSelect, OptionSquard, OptionTextSimple, OptionTime } from "../analisis-riesgos/Options";

class TemplateARComponentFactory {
    createTemplateARComponent(type, id) {
        switch (type) {
            case "1":
                return <OptionTextSimple/>;
            case "2":
                return <OptionParrafo/>;
            case "3":
                return <OptionNumber/>;
            case "5":
                return <OptionRound/>;
            case "6":
                return <OptionSquard/>;
            case "7":
                return <OptionSelect/>;
            case "8":
                return <OptionDate/>;
            case "9":
                return <OptionTime/>;
            case "10":
                return <OptionImage id={id}/>
            default :
                return <div>Sin option</div>

        }
    }
}

export default TemplateARComponentFactory;
