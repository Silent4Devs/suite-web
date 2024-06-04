import React from "react";
import "../../../../../css/templateAnalisisRiesgo/calculator/display.css"
// import "./styles/Display.css";

const Display = ({ input, setInput, answer }) => {
  const onChangeTagInput = (e) => {
    const re = /^[!%(-+\x2D-9^glox\xF7\u221A]+$/;

    // if (e.target.value === "" || re.test(e.target.value)) {
      setInput(e.target.value);
    // }
  };

  return (
    <>
      <div className="display">
          <input
            type="text"
            name="input"
            className="input"
          //   style={{ padding: "29px" }}
            value={input}
            placeholder="0"
            // maxLength={12}
            // disabled
            onChange={onChangeTagInput}
            autoComplete="off"
            autoFocus
          />
        </div>
    </>
  );
};

export default Display;
