import React, {useState,useEffect, useRef} from 'react'
import { useSortable } from '@dnd-kit/sortable';
import { useSensor, useSensors,  PointerSensor } from '@dnd-kit/core';
import { arrayMove } from '@dnd-kit/sortable';
import axios from 'axios';
import { AlertSimple } from '../components/common/Alerts';
import { instance } from '../services/base';
import { analysisRiskTemplateEditFormulas, analysisRiskTemplateFormulas, analysisRiskTemplateOptions, analysisRiskTemplateSaveFormula, analysisRiskTemplateSections, deleteAnalysisRiskTemplateFormulas, deleteQuestionTemplateGenerateAR, deleteSectionTemplateGenerateAR, generateSettignsTableTemplateAR, generateTemplateCreate, generateTemplateEdit, getInfoTemplateAR, getSettingsTemplateAR, getTableSettignsTemplateAR, getTemplateSectionsQuestion } from '../services/url/templateAnalisisRiesgos';

export const useAnalisisRiesgo = (template) => {
    const [loading, setLoading] = useState(true);
    const [reload, setReload] = useState(false);
    const btnSaveTemplate = useRef(0);
    const [edit, setEdit] = useState(false);
    const [sections, setSections] = useState();
    const [questions, setQuestions] = useState();

    const sectionDefault = [{id:'sec-1', title:"Sección 1", template_id:template},];
    const questionDefault = [{ id: "q-1", columnId: "sec-1", size:12, type:"1", obligatory:true, title:"Pregunta 1", isNumeric:false, data:{}}];

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

            if (questions[activeIndex].columnId != questions[overIndex].columnId) {
              questions[activeIndex].columnId = questions[overIndex].columnId;

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

            const activeIndex = questions.findIndex((item) => item.id === activeId);
            questions[activeIndex].columnId = overId;

            return arrayMove(questions, activeIndex, activeIndex);
          });
        }
      }

    const addSection = () => {
        let nextSection = sections.length + 1;
        let nextQuestion = questions.length +1;
        setSections((sections) => [...sections, { id: `sec-${nextSection}`, template_id:template , title:`Sección ${nextSection}` }]);
        setQuestions((questions) => [...questions, {id: `q-${nextQuestion}`, columnId:`sec-${nextSection}`, size:12, title:`Pregunta ${nextQuestion}`, type:"1", obligatory:true, isNumeric:false, data:{}}])
    }

    const addQuestion = () => {
        const lastPositionSection = sections.length - 1;
        const lastSection = sections.find((element,index) => index === lastPositionSection);
        const nextQuestion = questions.length +1;
        setQuestions((questions) => [...questions, {id: `q-${nextQuestion}`, columnId: lastSection.id, size:12, title:`Pregunta ${nextQuestion}`, type:"1", obligatory:true, isNumeric:false, data:{}}])
    }

    const deleteQuestion = async(id) => {
        let newId ="";
        const destroyElement = () => {
            const newQuestions = questions.filter((item) => item.id !== id);
            setQuestions(newQuestions)
        }
        const destroyRegister = async() => {
            await instance.delete(deleteQuestionTemplateGenerateAR + newId);
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
        duplicateQuestion.data = {};
        setQuestions([...questions,duplicateQuestion]);

    }

    const changeSize = (id, newSize) => {
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
                setQuestions(updateQuestions);
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
            case 'image':
                updateQuestions = questions.map((item)=>{
                    if(item.id === id){
                        const updateItem = item;
                        item.data={...item.data,file:props};
                        return updateItem;
                    }
                    return item;
                });
                setQuestions(updateQuestions);
                break;
            case 'catalog':
                updateQuestions = questions.map((item)=>{
                    if(item.id === id){
                        const updateItem = item;
                        item.data=props[0];
                        return updateItem;
                    }
                    return item;
                });
                setQuestions(updateQuestions);
                break;
            case 'numeric':
                updateQuestions = questions.map((item)=>{
                    if(item.id === id){
                        const updateItem = item;
                        updateItem.isNumeric=props;
                        return updateItem;
                    }
                    return item;
                });
                setQuestions(updateQuestions);
                break;
            default:
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
            const response = await instance.get(getTemplateSectionsQuestion + template);
            if(response.status === 200){
                const dataSection = response.data.data.sections;
                const dataQuestion = response.data.data.questions;

                if(dataSection.length > 0 ){

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
                            const propMin = `minimo-${item.id}`
                            const propMax = `maximo-${item.id}`
                            data[propMin] = data.minimo
                            data[propMax] = data.maximo
                            delete data.minimo
                            delete data.maximo
                            item.data = data;
                        }
                        if(item.type === "4"){
                            const data = item.data[0];
                            item.data = data;
                        }
                        if(item.type === "10"){
                            const data = item.data[0];
                            item.data = data;
                        }
                        if(item.type === "15"){
                            const data = item.data[0];
                            const propMin = `minimo-${item.id}`
                            const propMax = `maximo-${item.id}`
                            data[propMin] = "$" + data.minimo
                            data[propMax] = "$" + data.maximo
                            delete data.minimo
                            delete data.maximo
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
            }
            setLoading(false);
        } catch (error) {
            console.log(error);
        }
    }

    const handleSubmit = async(e) => {
        e.preventDefault();
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
            if(item.type === "3"){
                const propMin = `minimo-${id}`
                const propMax = `maximo-${id}`

                item.data.minimo = item.data[propMin]
                item.data.maximo = item.data[propMax]

                delete item.data[propMin]
                delete item.data[propMax]

            }
            if(item.type === "15"){
                const propMin = `minimo-${id}`
                const propMax = `maximo-${id}`

                item.data.minimo = item.data[propMin]
                item.data.maximo = item.data[propMax]

                item.data.minimo = parseInt(item.data.minimo.replace(/[$,]/g, ''));

                item.data.maximo = parseInt(item.data.maximo.replace(/[$,]/g, ''));

                delete item.data[propMin]
                delete item.data[propMax]
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

        if(edit){
            editData(dataSections,dataQuestions);
        }else{
            createData(dataSections,dataQuestions);
        }
    }

    const createData = async(dataSections,dataQuestions) =>{
        const dataForm = new FormData();
        dataQuestions.forEach((item, index) => {
            if(item.type === '10'){
                dataForm.append(`image[${item.id}]`, item.data.file);
            }
          });
        dataForm.append('sections', JSON.stringify(dataSections));
        dataForm.append('questions', JSON.stringify(dataQuestions));
        try {
            const response = await instance.post(generateTemplateCreate,dataForm,{headers: {
                'Content-Type': 'multipart/form-data'
            }});
            if(response.status === 200){
                const event = new CustomEvent('advanceModuleTemplate', { detail: { message:true } });
                window.dispatchEvent(event);
            }
        } catch (error) {
            console.log(error)
        }
    }

    const editData = async(dataSections,dataQuestions) => {
        const dataForm = new FormData();
        dataQuestions.forEach((item) => {
            if(item.type === '10'){
                const isFile = item.data.file instanceof File;
                if(isFile){
                    dataForm.append(`image[${item.id}]`, item.data.file);
                    delete item.data.file;
                }
            }
          });

        dataForm.append('sections', JSON.stringify(dataSections));
        dataForm.append('questions', JSON.stringify(dataQuestions));
        try {
            const response = await instance.post(generateTemplateEdit + template,dataForm,{
                params: {
                    '_method' : "PUT"
                }
              });
            if(response.status === 200){
                const event = new CustomEvent('advanceModuleTemplate', { detail: { message:true } });
                window.dispatchEvent(event);
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
            const newSections = sections.filter((item) => item.id !== id);
            const newQuestions = questions.filter((item) => item.columnId !== id);
            setSections(newSections);
            setQuestions(newQuestions);
        }
        const destroyRegister = async() => {
            await instance.delete(deleteSectionTemplateGenerateAR + newId);
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
      setReload(false);
    }, [reload]);

    //useEfect para cuando se recarge el modulo (click en el stepper)
    useEffect(() => {
        const handleUpdateReload = (event) => {
            setReload(event.detail.reload);
        };
        window.addEventListener('updateReload', handleUpdateReload);
    }, []);

    //useEfect para cuando se avanza al siguiente modulo (click avanzar)
    useEffect(() => {
        const handleSaveForm = (e) => {
            btnSaveTemplate.current.click();
        };
        window.addEventListener('saveFormTemplate',handleSaveForm );
    }, []);

    return { sections,questions, activeSection, activeQuestion, handleDragStart, handleDragOver,
        handleDragEnd, addSection, addQuestion,deleteQuestion,changeSize,changeQuestionProps,
        sensors, loading, handleSubmit, duplicateQuestion, changeTitle, deleteSection, btnSaveTemplate}
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
        isNumeric:item.isNumeric,
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

export const useFormulasAnalisisRiesgos = (template) => {
    const [loading, setLoading] = useState({
        options:true,
        sections:true,
        formulas:true,
    });
    const [options, setOptions] = useState([]);
    const [option, setOption] = useState("");
    const [registers, setRegisters] = useState([]);
    const [formula, setFormula] = useState("");
    const [formulas, setFormulas] = useState([]);
    const [sections, setSections] = useState([]);
    const [reload, setReload] = useState(false);
    const [reloadFormulas, setReloadFormulas] = useState(false);
    const btnEditFormulas = useRef(0);
    const expFormulas = /^rf-\d+$/;

    const handleChangeFormula = (newValue) =>{
        setFormula(newValue);
    }

    const handleChangeStatus = (id) => {
        const newChanges = formulas.map((item)=>{
            if(item.id === id){
                const newStatus = true;
                item.riesgo = newStatus;
                return item;
            }else{
                const newStatus = false;
                item.riesgo = newStatus;
                return item;
            }
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

    const handleChangeSection = (e,id) => {
        const newsectionId = e.target.value;
        const newFormulas = formulas.map((item)=>{
            if(item.id === id){
                item.section_id = parseInt(newsectionId);
                return item;
            }
            return item;
        });

        setFormulas(newFormulas);
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
        if(option !== ""){
            const id = parseInt(option);
            const newRegister = options.filter(item => item.id === id);
            setRegisters([...registers, newRegister[0]]);
        }

    }

    const addVariable = (item) => {
        const id = `$fv${item.uuid_formula}`
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
                formula:formula,
                section_id:sections[0].id,
                template_id:template,
            }
            handleSaveFormula(newFormula);
        }
    }

    const deleteFormula = async(id) => {

        const destroyElement = () => {
            const newElements = formulas.filter(item => item.id !== id);
            setFormulas(newElements);
        }
        const destroyRegister = async() => {
            await instance.delete(deleteAnalysisRiskTemplateFormulas + id);
        }

        AlertSimple(()=>destroyElement(), ()=>destroyRegister());

    }

    const getOptions = async() => {
        try {
            setLoading(prevLoading => ({ ...prevLoading, options: true }));
            const response = await instance.get(analysisRiskTemplateOptions + template);
            console.log(response)
            if(response.status === 200){
                const data = response.data.data.options
                setOptions(data);
            }
        } catch (error) {
            console.log(error)
        } finally {
            setLoading(prevLoading => ({ ...prevLoading, options: false }));
        }
    }

    const getFormulas = async() => {
        try {
            setLoading(prevLoading => ({ ...prevLoading, formulas: true }));
            const response = await instance.get(analysisRiskTemplateFormulas + template);
            if(response.status === 200){
                const registerFormulas = response.data.data.formulas;
                setFormulas(registerFormulas);
            }

        } catch (error) {
            console.log(error)
        } finally {
            setLoading(prevLoading => ({ ...prevLoading, formulas:false }));
        }
    }

    const getSections = async() => {
        try {
            const response = await instance.get(analysisRiskTemplateSections + template);
            if(response.status === 200){
                const newSections = response.data.data.sections;
                setSections(newSections);
            }
        } catch (error) {
            console.log(error);
        }
    }

    const handleSaveFormula = async (newFormula) => {
        const response = await instance.post(analysisRiskTemplateSaveFormula,{formula:newFormula});
        if(response.status === 200){
            setReloadFormulas(!reload);
            setFormula("");
        }
    }

    const handleSubmit = async(e) =>{
        e.preventDefault();
        const response = await instance.put(analysisRiskTemplateEditFormulas,{formulas:formulas});
        console.log(response)
        if(response.status === 200){
            const event = new CustomEvent('advanceModuleTemplate', { detail: { message:true } });
            window.dispatchEvent(event);
        }
    }

    useEffect(() => {
      getOptions();
      getFormulas();
      getSections();
      setReload(false);
    }, [reload])

    useEffect(()=>{
        getFormulas();
    },[reloadFormulas])

    useEffect(() => {
        const handleUpdateReload = (event) => {
            setReload(event.detail.reload);
        };
        window.addEventListener('reloadModuleFormulas', handleUpdateReload);
    }, []);

    useEffect(() => {
        const handleSaveForm = (e) => {
            btnEditFormulas.current.click();
        };
        window.addEventListener('saveFormTemplateFormulas',handleSaveForm );
    }, []);


    return { formula,setFormula,formulas, handleChangeFormula, handleChangeStatus, handleChangeTitle,
             hrStyle, options, handleChangeOption, option, addOption, registers, addVariable,
             removeVariable, addFormula, deleteFormula, sections, handleChangeSection, handleSubmit, loading, btnEditFormulas }
}

export const useSettingsAnalisisRiesgos = (templateId) => {
    const [loadingInfoTemplate, setLoadingInfoTemplate] = useState(true)
    const [loadingQuestions, setLoadingQuestions] = useState(true)
    const [loadingTableSettigns, setLoadingTableSettigns] = useState(true)
    const [reload, setReload] = useState(false);
    const btnSaveSettigns = useRef(0);
    const [sections, setSections] = useState();
    const [questions, setQuestions] = useState();
    const [activeSection, setActiveSection] = useState(null);
    const [activeQuestion, setActiveQuestion] = useState(null);
    const [template, setTemplate] = useState({});
    const [tableSettings, setTableSettings] = useState({});

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


            if (questions[activeIndex].columnId != questions[overIndex].columnId) {

              questions[activeIndex].columnId = questions[overIndex].columnId;

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
            const activeIndex = questions.findIndex((item) => item.id === activeId);
            questions[activeIndex].columnId = overId;

            return arrayMove(questions, activeIndex, activeIndex);
          });
        }
    }

    const sensors = useSensors(
        useSensor(PointerSensor, {
          activationConstraint: {
            distance: 1,
          },
        })
    );

    const changeSize = (id, newSize) => {
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

    const getData = async() => {
        try {
            setLoadingQuestions(true);
            const response = await instance.get(getSettingsTemplateAR + templateId);
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
                    if(item.type === "10"){
                        const data = item.data[0];
                        item.data = data;
                    }
                    if(item.type === "15"){
                        const data = item.data[0];
                        // data.minimo = "$" + data.minimo.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',')
                        // data.maximo = "$" + data.maximo.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',')
                        item.data = data;
                    }
                });

                dataSection.sort((a, b) => a.position - b.position);
                dataQuestion.sort((a, b) => a.position - b.position);
                console.log(dataQuestion);
                setSections(dataSection);
                setQuestions(dataQuestion);
            }
        } catch (error) {
            console.log(error);
        } finally {
            setLoadingQuestions(false)
        }
    }

    const getInfoTemplate = async() => {
        try {
            setLoadingInfoTemplate(true)
            const response = await instance.get(getInfoTemplateAR + templateId);
            if(response.status === 200){
                const register = response.data.data.template
                setTemplate(register)
            }
        } catch (error) {
            console.log(error)
        } finally {
            setLoadingInfoTemplate(false)
        }
    }

    const getTableSettings = async() => {
        try {
            setLoadingTableSettigns(true);
            const response = await instance.get(getTableSettignsTemplateAR + templateId);

            if(response.status === 200){
                const register = response.data.data
                setTableSettings(register);
            }
        } catch (error) {
        } finally{
            setLoadingTableSettigns(false);
        }
     }

    const editData = async(dataSections,dataQuestions) => {

        const dataForm = new FormData();
        dataForm.append('sections', JSON.stringify(dataSections));
        dataForm.append('questions', JSON.stringify(dataQuestions));

        try {
            const response = await instance.post(generateTemplateEdit + templateId ,dataForm,{
                params: {
                    '_method' : "PUT"
                },
              });
            const response2 = await instance.put(generateSettignsTableTemplateAR,tableSettings);

            if(response.status === 200 && response2.status === 200){
                const event = new CustomEvent('advanceModuleTemplate', { detail: { message:true } });
                window.dispatchEvent(event);
            }

        } catch (error) {
            console.log(error)
        }
    }

    const handleSubmit = async(e) => {
        e.preventDefault();
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

        editData(dataSections,dataQuestions);
    }

    useEffect(() => {
        getData();
        getInfoTemplate();
        getTableSettings();
        setReload(false);
      }, [reload])

    //useEfect para cuando se recarge el modulo (click en el stepper)
    useEffect(() => {
        const handleUpdateReload = (event) => {
            setReload(event.detail.reload);
        };
        window.addEventListener('reloadModuleSettigns', handleUpdateReload);
    }, []);

    // useEfect para cuando se avanza al siguiente modulo (click avanzar)
    useEffect(() => {
        const handleSaveForm = (e) => {
            btnSaveSettigns.current.click();
        };
        window.addEventListener('saveFormTemplateSettigns',handleSaveForm );
    }, []);

    return {loadingInfoTemplate,loadingTableSettigns, loadingQuestions ,sections,questions, activeSection, activeQuestion, handleDragStart,
        handleDragEnd, handleDragOver, sensors, changeSize, handleSubmit, template, tableSettings, btnSaveSettigns }
}

export const useSettingsQuestionAnalisisRiesgo = (item, changeSize) =>{
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

    return { showSize, showInfo, handleShowSizes, handleChangeSize, moreInfo, attributes, listeners, setNodeRef, transform,
            transition, isDragging, }
}

export const useTemplateViewPrevAnalisisRiesgo = (templateId) => {
    const [loadingInfoTemplate, setLoadingInfoTemplate] = useState(true)
    const [loadingQuestions, setLoadingQuestions] = useState(true)
    const [reload, setReload] = useState(false);
    const [template, setTemplate] = useState({});
    const [sections, setSections] = useState();
    const [questions, setQuestions] = useState();

    const getData = async() => {
        try {
            setLoadingQuestions(true);
            const response = await instance.get(getSettingsTemplateAR + templateId);
            const dataSection = response.data.data.sections;
            const dataQuestion = response.data.data.questions;
            if(dataSection.length >0 ){

                dataQuestion.map((item)=>{
                    if(item.type === "3"){
                        const data = item.data[0];
                        item.data = data;
                    }
                    if(item.type === "10"){
                        const data = item.data[0];
                        item.data = data;
                    }
                });

                dataSection.sort((a, b) => a.position - b.position);
                dataQuestion.sort((a, b) => a.position - b.position);

                setSections(dataSection);
                setQuestions(dataQuestion);
            }
        } catch (error) {
            console.log(error);
        } finally {
            setLoadingQuestions(false)
        }
    }

    const getInfoTemplate = async() => {
        try {
            setLoadingInfoTemplate(true);
            const response = await instance.get(getInfoTemplateAR + templateId);
            if(response.status === 200){
                const register = response.data.data.template
                setTemplate(register)
            }
        } catch (error) {
        } finally{
            setLoadingInfoTemplate(false)
        }
    }

    useEffect(() => {
        getData();
        getInfoTemplate();
        setReload(false)
    }, [reload]);

    //useEfect para cuando se recarge el modulo (click en el stepper)
    useEffect(() => {
        const handleUpdateReload = (event) => {
            setReload(event.detail.reload);
        };
        window.addEventListener('reloadModulePreview', handleUpdateReload);
    }, []);

    return {loadingInfoTemplate,loadingQuestions,sections,questions,template}
}
