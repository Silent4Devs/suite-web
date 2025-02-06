import React from "react";
import "../../../../../css/templateAnalisisRiesgo/calculator/buttons.css"

const Buttons = ({ inputHandler, clearInput, backspace, changePlusMinus, addFormula }) => {
  document.addEventListener("keydown", function (event) {
    if (event.key === "Enter") {
      event.preventDefault();
      document.getElementById("equalbtn").click();
    }
  });

  return (
    <div className="show-btn-calculator">
      <button className="btn-calculator exp" onClick={inputHandler}>
        ()
      </button>
      {/* <button className="btn-calculator exp" onClick={inputHandler}>
        )
      </button> */}
      <button type="button" className="btn-calculator clr" onClick={clearInput}>
        AC
      </button>
      <button type="button" className="btn-calculator clr" onClick={backspace}>
        ⌫
      </button>
      <button type="button" className="btn-calculator exp" onClick={inputHandler}>
        ÷
      </button>
      <button type="button" className="btn-calculator" onClick={inputHandler}>
        7
      </button>
      <button type="button" className="btn-calculator" onClick={inputHandler}>
        8
      </button>
      <button type="button" className="btn-calculator" onClick={inputHandler}>
        9
      </button>
      <button type="button" className="btn-calculator exp" onClick={inputHandler}>
        *
      </button>
      <button type="button" className="btn-calculator" onClick={inputHandler}>
        4
      </button>
      <button type="button" className="btn-calculator" onClick={inputHandler}>
        5
      </button>
      <button type="button" className="btn-calculator" onClick={inputHandler}>
        6
      </button>
      <button type="button" className="btn-calculator exp" onClick={inputHandler}>
        +
      </button>
      <button type="button" className="btn-calculator" onClick={inputHandler}>
        1
      </button>
      <button type="button" className="btn-calculator" onClick={inputHandler}>
        2
      </button>
      <button type="button" className="btn-calculator" onClick={inputHandler}>
        3
      </button>
      <button type="button" className="btn-calculator exp" onClick={inputHandler}>
        -
      </button>
      <button type="button" className="btn-calculator exp" onClick={changePlusMinus}>
        ±
      </button>
      <button type="button" className="btn-calculator" onClick={inputHandler}>
        0
      </button>
      <button type="button" className="btn-calculator exp" onClick={inputHandler}>
        .
      </button>
      <button type="button" className="btn-calculator exp equal" id="equalbtn" onClick={()=>addFormula()}>
        =
      </button>
    </div>
  );
};

export default Buttons;
