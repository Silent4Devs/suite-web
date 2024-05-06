import React, { useState } from "react";
import Display from "./Display";
import Buttons from "./Buttons";
// import "../../../../../css/templateAnalisisRiesgo/calculator/calculator.css"
// import "./styles/Calculator.css";
// import { evaluate, round } from "mathjs";

function Calculator({formula,setFormula}) {
//   const [input, setInput] = useState("");
  const [answer, setAnswer] = useState("");

  //input
  const inputHandler = (event) => {
    if (answer === "Invalid Input!!") return;
    let val = event.target.innerText;

    let str = formula + val;
    // if (str.length > 14) return;

    if (answer !== "") {
      setFormula(answer + val);
      setAnswer("");
    } else setFormula(str);
    // setInput(str);
  };

  //Clear screen
  const clearInput = () => {
    setFormula("");
    setAnswer("");
  };

  // check brackets are balanced or not
  const checkBracketBalanced = (expr) => {
    let stack = [];
    for (let i = 0; i < expr.length; i++) {
      let x = expr[i];
      if (x === "(") {
        stack.push(x);
        continue;
      }

      if (x === ")") {
        if (stack.length === 0) return false;
        else stack.pop();
      }
    }
    return stack.length === 0;
  };

  // calculate final answer
  const calculateAns = () => {
    if (formula === "") return;
    let result = 0;
    let finalexpression = formula;

    finalexpression = finalexpression.replaceAll("x", "*");
    finalexpression = finalexpression.replaceAll("÷", "/");

    try {
      // check brackets are balanced or not
      if (!checkBracketBalanced(finalexpression)) {
        const errorMessage = { message: "Brackets are not balanced!" };
        throw errorMessage;
      }
      result = finalexpression; //mathjs
    } catch (error) {
      result =
        error.message === "Brackets are not balanced!"
          ? "Brackets are not balanced!"
          : "Invalid Input!!"; //error.message;
    }
    // isNaN(result) ? setAnswer(result) : setAnswer(Math.round(result, 3));

    if(isNaN(result)){
    console.log(result)
    }else{
        console.log(result)
    }


  };

  // remove last character
  const backspace = () => {
    if (answer !== "") {
      setFormula(answer.toString().slice(0, -1));
      setAnswer("");
    } else setFormula((prev) => prev.slice(0, -1));
  };

  // change prefix of expression
  const changePlusMinus = () => {
    //need to change for answer
    if (answer === "Invalid Input!!") return;
    else if (answer !== "") {
      let ans = answer.toString();
      if (ans.charAt(0) === "-") {
        let plus = "+";
        setFormula(plus.concat(ans.slice(1, ans.length)));
      } else if (ans.charAt(0) === "+") {
        let minus = "-";
        setFormula(minus.concat(ans.slice(1, ans.length)));
      } else {
        let minus = "-";
        setFormula(minus.concat(ans));
      }
      setAnswer("");
    } else {
      if (formula.charAt(0) === "-") {
        let plus = "+";
        setFormula((prev) => plus.concat(prev.slice(1, prev.length)));
      } else if (formula.charAt(0) === "+") {
        let minus = "-";
        setFormula((prev) => minus.concat(prev.slice(1, prev.length)));
      } else {
        let minus = "-";
        setFormula((prev) => minus.concat(prev));
      }
    }
  };

  return (
    <>
      <div className="container">

          <Display input={formula} setInput={setFormula} answer={answer} />
          <Buttons
            inputHandler={inputHandler}
            clearInput={clearInput}
            backspace={backspace}
            changePlusMinus={changePlusMinus}
            calculateAns={calculateAns}
          />

      </div>
    </>
  );
}

export default Calculator;
