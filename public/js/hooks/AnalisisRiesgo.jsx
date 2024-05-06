import React, {useState,useEffect} from 'react'
import { useSortable } from '@dnd-kit/sortable';
import { useSensor, useSensors,  PointerSensor } from '@dnd-kit/core';
import { arrayMove } from '@dnd-kit/sortable';
import axios from 'axios';
import { AlertSimple } from '../components/common/Alerts';

export const useAnalisisRiesgo = () => {
    const [loading, setLoading] = useState(true);
    const [reload, setReload] = useState(0);
    const [edit, setEdit] = useState(false);
    const [sections, setSections] = useState();
    const [questions, setQuestions] = useState();

    const sectionDefault = [{id:'sec-1', title:"Sección 1", template_id:1},];
    const questionDefault = [{ id: "q-1", columnId: "sec-1", size:12, type:"1", obligatory:true, title:"Pregunta 1", data:{}}];

    const [activeSection, setActiveSection] = useState(null);
    const [activeQuestion, setActiveQuestion] = useState(null);

    const expSections = /^ss-\d+$/;
    const expQuestions = /^qs-\d+$/;

    const handleDragStart = (event) => {
        if(event.active.data.current?.type === "Section"){
            setActiveSection(event.active.data.current);
            return;
        }

        if(event.active.data.current?.type === "Question"){
            setActiveQuestion(event.active.data.current);
            return;
        }
    }

    const handleDragEnd = (event) => {

        setActiveSection(null);
        setActiveQuestion(null);

        const { active, over } = event;
        if (!over) return;

        const activeId = active.id;
        const overId = over.id;

        if (activeId === overId) return;

        const isActiveASection = active.data.current?.type === "Section";
        if (!isActiveASection) return;

        setSections((sections) => {
          const activeSectionIndex = sections.findIndex((item) => item.id === activeId);
          const overSectionIndex = sections.findIndex((item) => item.id === overId);
          return arrayMove(sections, activeSectionIndex, overSectionIndex);
        });
      };

    const handleDragOver = (event) => {
        const { active, over } = event;

        if (!over) return;

        const activeId = active.id;
        const overId = over.id;

        if (activeId === overId) return;

        const isActiveAQuestion = active.data.current?.type === "Question";
        const isOverAQuestion = over.data.current?.type === "Question";

        if (!isActiveAQuestion) return;

        // Im dropping a Task over another Task
        if (isActiveAQuestion && isOverAQuestion) {
          setQuestions((questions) => {
            const activeIndex = questions.findIndex((item) => item.id === activeId);
            const overIndex = questions.findIndex((item) => item.id === overId);
            // console.log(overIndex)

            if (questions[activeIndex].columnId != questions[overIndex].columnId) {
              // Fix introduced after video recording
              questions[activeIndex].columnId = questions[overIndex].columnId;
            //   questions[activeIndex].position = overIndex;

              return arrayMove(questions, activeIndex, overIndex - 1);
            }

            questions[activeIndex].position = overIndex;

            return arrayMove(questions, activeIndex, overIndex);
          });
        }

        const isOverASection = over.data.current?.type === "Section";

        // Im dropping a Task over a column
        if (isActiveAQuestion && isOverASection) {
          setQuestions((questions) => {
            // console.log(questions)
            const activeIndex = questions.findIndex((item) => item.id === activeId);
            questions[activeIndex].columnId = overId;
            // console.log("DROPPING TASK OVER COLUMN", { activeIndex });
            return arrayMove(questions, activeIndex, activeIndex);
          });
        }
      }


    const addSection = () => {
        let nextSection = sections.length + 1;
        let nextQuestion = questions.length +1;
        setSections((sections) => [...sections, { id: `sec-${nextSection}`, template_id:1 , title:`Sección ${nextSection}` }]);
        setQuestions((questions) => [...questions, {id: `q-${nextQuestion}`, columnId:`sec-${nextSection}`, size:12, title:`Pregunta ${nextQuestion}`, type:"1", obligatory:true, data:{}}])
    }

    const addQuestion = () => {
        const lastPositionSection = sections.length - 1;
        const lastSection = sections.find((element,index) => index === lastPositionSection);
        const nextQuestion = questions.length +1;
        setQuestions((questions) => [...questions, {id: `q-${nextQuestion}`, columnId: lastSection.id, size:12, title:`Pregunta ${nextQuestion}`, type:"1", obligatory:true, data:{}}])
    }

    const deleteQuestion = async(id) => {
        let newId ="";
        const destroyElement = () => {
            const newQuestions = questions.filter((item) => item.id !== id);
            setQuestions(newQuestions)
        }
        const destroyRegister = async() => {
            await axios.delete(`http:///suite-web.test/api/api/v1/test/question/delete/${newId}`);
        }
        if(expQuestions.test(id)){
            newId = id.slice(3);
            AlertSimple(()=>destroyElement(), ()=>destroyRegister());
        }else{
            destroyElement();
        }
    }

    const duplicateQuestion = (id) => {
        const nextQuestion = questions.length +1;
        const register = questions.find(item => item.id === id);
        const duplicateQuestion = {...register}
        duplicateQuestion.id = `q-${nextQuestion}`;
        setQuestions([...questions,duplicateQuestion]);

    }

    const changeSize = (id, newSize) => {
        console.log(questions)
        const updateQuestions = questions.map((item)=>{
            if(item.id === id){
                const updateItem = item
                updateItem.size = newSize
                return updateItem
            }
            return item;
        })

        setQuestions(updateQuestions)
    }

    const changeQuestionProps = (id,type,props) => {
        let updateQuestions;
        switch(type){
            case 'type':
                updateQuestions = questions.map((item)=>{
                    if(item.id === id){
                        const updateItem = item;
                        item.type=props.type
                        return updateItem;
                    }
                    return item;
                });
                setQuestions(updateQuestions);
                break;
            case "title":
                updateQuestions = questions.map((item)=>{
                    if(item.id === id){
                        const updateItem = item;
                        item.title=props.inputTitle
                        return updateItem;
                    }
                    return item;
                });
                break;
            case 'obligatory':
                updateQuestions = questions.map((item)=>{
                    if(item.id === id){
                        const updateItem = item;
                        item.obligatory=props.obligatory
                        return updateItem;
                    }
                    return item;
                });
                setQuestions(updateQuestions);
                break;
            case 'minMax':
                updateQuestions = questions.map((item)=>{
                    if(item.id === id){
                        const updateItem = item;
                        item.data=props;
                        return updateItem;
                    }
                    return item;
                });
                setQuestions(updateQuestions);
                break;
            case 'round':
                updateQuestions = questions.map((item)=>{
                    if(item.id === id){
                        const updateItem = item;
                        item.data=props;
                        return updateItem;
                    }
                    return item;
                });
                setQuestions(updateQuestions);
                break;
            case 'dataDelete':
                updateQuestions = questions.map((item)=>{
                    if(item.id === id){
                        const updateItem = item;
                        item.data={};
                        return updateItem;
                    }
                    return item;
                });
                setQuestions(updateQuestions);
                break;
            default:
                // console.log("sin cambio")
        }
    }

    const sensors = useSensors(
        useSensor(PointerSensor, {
          activationConstraint: {
            distance: 1,
          },
        })
    );

    const getData = async() => {
        try {
            setLoading(true);
            const response = await axios.get('http:///suite-web.test/api/api/v1/test/1');
            console.log(response.data.data);
            const dataSection = response.data.data.sections;
            const dataQuestion = response.data.data.questions;

            if(dataSection.length >0 ){

                dataSection.map((item)=>{
                    const sectionId = item.id;
                    item.id = `ss-${sectionId}`
                })

                dataQuestion.map((item)=>{
                    const questionId = item.id;
                    const columnId = item.columnId;
                    item.id = `qs-${questionId}`
                    item.columnId = `ss-${columnId}`
                    if(item.type === "3"){
                        const data = item.data[0];
                        item.data = data;
                    }
                });

                dataSection.sort((a, b) => a.position - b.position);
                dataQuestion.sort((a, b) => a.position - b.position);

                setSections(dataSection);
                setQuestions(dataQuestion);
                setEdit(true);
            }else {
                setSections(sectionDefault);
                setQuestions(questionDefault);
            }
            setLoading(false);
        } catch (error) {
            console.log(error);
        }
    }

    const handleSubmit = async() => {
        const dataSections = sections.map((item) => ({...item}));
        const dataQuestions = questions.map((item)=> ({...item}));
        dataSections.map((item, index)=>{
            const id = item.id
            item.position = index;
            if(expSections.test(id)){
                const newId = id.slice(3);
                item.id = parseInt(newId,10);
            }
        });


        dataQuestions.map((item)=>{
            const id = item.id
            const columnId = item.columnId;
            if(expQuestions.test(id)){
                const newId = id.slice(3);
                item.id = parseInt(newId,10);
            }
            if(expSections.test(columnId)){
                const newColumnId = columnId.slice(3);
                item.columnId = parseInt(newColumnId,10);
            }
        })

        dataSections.map(item => {
            const dataFilter = dataQuestions.filter(itm => itm.columnId === item.id);
            dataFilter.map((item,index) => {
                item.position = index;
                const itemIdFound = dataQuestions.findIndex(itm => itm.id === item.id);
                dataQuestions[itemIdFound] = {...item}
            });
        });

        // console.log(dataQuestions);

        if(edit){
            editData(dataSections,dataQuestions);
        }else{
            createData(dataSections,dataQuestions);
        }
    }

    const createData = async(dataSections,dataQuestions) =>{
        const url = 'http:///suite-web.test/api/api/v1/test'
        try {
            const response = await axios.post(url,{sections:dataSections,questions:dataQuestions});
            console.log(response);
            if(response.status === 200){
                setReload(reload+1);
            }
        } catch (error) {
            console.log(error)
        }
    }

    const editData = async(dataSections,dataQuestions) => {
        const url = 'http:///suite-web.test/api/api/v1/test/edit'
        try {
            const response = await axios.put(url,{sections:dataSections,questions:dataQuestions});
            console.log(response);
            if(response.status === 200){
                setReload(reload+1);
            }
        } catch (error) {
            console.log(error)
        }
    }

    const changeTitle = (id,newTitle) => {

        const updateSections = sections.map((item)=>{
            if(item.id === id){
                const updateItem = item;
                item.title=newTitle
                return updateItem;
            }
            return item;
            });
        setSections(updateSections)

    }

    const deleteSection = async(id) => {
        let newId ="";
        const destroyElement = () => {
            console.log("destroyElement")
            const newSections = sections.filter((item) => item.id !== id);
            const newQuestions = questions.filter((item) => item.columnId !== id);
            setSections(newSections);
            setQuestions(newQuestions);
        }
        const destroyRegister = async() => {
            await axios.delete(`http:///suite-web.test/api/api/v1/test/section/delete/${newId}`);
        }
        if(expSections.test(id)){
            newId = id.slice(3);
            AlertSimple(()=>destroyElement(), ()=>destroyRegister());
        }else{
            destroyElement();
        }
    }

    useEffect(() => {
      getData();
    }, [reload])

    return { sections,questions, activeSection, activeQuestion, handleDragStart, handleDragOver,
        handleDragEnd, addSection, addQuestion,deleteQuestion,changeSize,changeQuestionProps,
        sensors, loading, handleSubmit, duplicateQuestion, changeTitle, deleteSection}
}

export const useGenerateTemplateAnalisisRiesgo = (item, changeQuestionProps,changeSize) => {
    const [option, setOption] = useState(item.type);
    const [inputTitle, setInputTitle] = useState(item.title);
    const [showSize, setShowSize] = useState(false)
    const [showInfo, setShowInfo] = useState(false)


    const {
        attributes,
        listeners,
        setNodeRef,
        transform,
        transition,
        isDragging
      } = useSortable({ id:item.id, data: {
        type: "Question",
        id: item.id,
        size:item.size,
        position:item.position,
        question:{
            type:item.type
        },
        title:item.title,
    }});

    const handleChangeOption = (e) => {
        const newValue = e.target.value;
        const questionProp = {type:newValue}
        setOption(newValue);
        changeQuestionProps(item.id,"type", questionProp )
     }

     const handleTileChange = (newValue) => {
        const newTitle = newValue;
        setInputTitle(newTitle);
        const questionProp = {inputTitle:newTitle}
        item.title = newValue
        changeQuestionProps(item.id,"title", questionProp )

    };

    const handleShowSizes = () => {
        const flag = !showSize;
        setShowSize(flag)
    }

    const handleChangeSize = (newSize) => {
        changeSize(item.id, newSize)
        handleShowSizes()
    }

    const moreInfo = (newValue) => {
        const flag = newValue;
        setShowInfo(flag);
    }

    const handleObligatoryChange = () => {
       const newValue = !item.obligatory
       const questionProp = {obligatory:newValue}
       changeQuestionProps(item.id,"obligatory", questionProp )
    }

     return { option, handleChangeOption, attributes, listeners, setNodeRef, transform,
            transition, isDragging, handleTileChange, inputTitle, showSize, showInfo,
            handleShowSizes, handleChangeSize, moreInfo, handleObligatoryChange}
 }

export const useFormulasAnalisisRiesgos = () => {
    const [options, setOptions] = useState([]);
    const [option, setOption] = useState("");
    const [registers, setRegisters] = useState([]);
    const [formula, setFormula] = useState("");
    const [formulas, setFormulas] = useState([
        // {id:1,riesgo:true,title:"Formula 1", formula:"9(5*5)"},
        // {id:2,riesgo:false,title:"Formula 1", formula:"9(5*5)"}
    ]);

    const expFormulas = /^rf-\d+$/;


    const handleChangeFormula = (newValue) =>{
        setFormula(newValue);
    }

    const handleChangeStatus = (id) => {
        const newChanges = formulas.map((item)=>{
            if(item.id === id){
                const newStatus = item.riesgo;
                item.riesgo = !newStatus;
                return item;
            }
            return item;
        })
        setFormulas(newChanges);
    }

    const handleChangeTitle = (id,newValue) => {
        const newChanges = formulas.map((item)=>{
            if(item.id === id){
                const newTitle = newValue;
                item.title = newTitle;
                return item;
            }
            return item;
        });

        setFormulas(newChanges);
    }

    const hrStyle = {
            border: "1px dashed #C5C5C5",
            opacity: 1,
    }

    const handleChangeOption = (e) => {
        const newOption = e.target.value;
        setOption(newOption);
    }

    const addOption = () => {
        // console.log(option, options);
        const id = parseInt(option);

        // const newRegister =
        const newRegister = options.filter(item => item.id === id);
        setRegisters([...registers, newRegister[0]]);
    }

    const addVariable = (item) => {
        console.log(item)
        const question = item.title;
        const id = `$fv${item.id}`
        const element = `${id}${question}`
        setFormula(`${formula}${id}`);
    }

    const removeVariable = (id) => {
        const newRegisters = registers.filter(item => item.id !== id);
        setRegisters(newRegisters);
    }

    const addFormula = () => {
        if(formula !== ""){
            const lastFormula = formulas.length + 1;
            const newId = `nf-${lastFormula}`;

            const newFormula = {
                id:newId,
                riesgo:false,
                title:`Formula ${lastFormula}`,
                formula:formula
            }
            setFormulas([...formulas,newFormula]);
            setFormula("");
        }
    }

    const deleteFormula = async(id) => {
        let newId ="";
        const destroyElement = () => {
            const newElements = formulas.filter(item => item.id !== id);
            setFormulas(newElements);
        }
        const destroyRegister = async() => {
            await axios.delete(`http:///suite-web.test/api/api/v1/ar/formulas/${newId}`);
        }
        if(expFormulas.test(id)){
            newId = id.slice(3);
            AlertSimple(()=>destroyElement(), ()=>destroyRegister());
        }else{
            destroyElement();
        }
    }

    const getOptions = async() => {
        try {
            const response = await axios.get('http:///suite-web.test/api/api/v1/ar/formulas/options/1');
            if(response.status === 200){
                const data = response.data.data.options
                // console.log(data);
                setOptions(data);
            }
        } catch (error) {

        }
    }

    const getFormulas = async() => {
        try {
            const response = await axios.get('http:///suite-web.test/api/api/v1/ar/formulas/1');
            if(response.status === 200){
                const registerFormulas = response.data.data.formulas;
                registerFormulas.map((item)=>{
                   const formulaId = item.id;
                   item.id = `rf-${formulaId}`;
                })
                setFormulas(registerFormulas);
            }

        } catch (error) {

        }
    }

    useEffect(() => {
      getOptions();
      getFormulas();
    }, [])


    return { formula,setFormula,formulas, handleChangeFormula, handleChangeStatus, handleChangeTitle,
             hrStyle, options, handleChangeOption, option, addOption, registers, addVariable,
             removeVariable, addFormula, deleteFormula }
}
