<style>
    #comentariosEvaluacion ul,
    #comentariosEvaluacion li {
        list-style: none;
        padding: 0;
    }

    #comentariosEvaluacion .container {
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 0 1rem;
        background: linear-gradient(45deg, #209cff, #68e0cf);
        padding: 3rem 0;
    }

    #comentariosEvaluacion .wrapper {
        /* background: #eaf6ff;
        padding: 2rem; */
        border-radius: 15px;
    }

    #comentariosEvaluacion h1 {
        font-size: 1.1rem;
        font-family: sans-serif;
    }

    #comentariosEvaluacion .sessions {
        margin-top: 2rem;
        border-radius: 12px;
        position: relative;
    }

    #comentariosEvaluacion li {
        padding-bottom: 1.5rem;
        border-left: 1px solid #abaaed;
        position: relative;
        padding-left: 20px;
        margin-left: 10px;
    }

    #comentariosEvaluacion li:last-child {
        border: 0px;
        padding-bottom: 0;
    }

    #comentariosEvaluacion li:before {
        content: "";
        width: 15px;
        height: 15px;
        background: white;
        border: 1px solid #4e5ed3;
        box-shadow: 3px 3px 0px #bab5f8;
        box-shadow: 3px 3px 0px #bab5f8;
        border-radius: 50%;
        position: absolute;
        left: -10px;
        top: 0px;
    }

    #comentariosEvaluacion .time {
        color: #2a2839;
        font-family: "Poppins", sans-serif;
        font-weight: 500;
    }

    @media screen and (min-width: 601px) {
        #comentariosEvaluacion .time {
            font-size: 0.9rem;
        }
    }

    @media screen and (max-width: 600px) {
        #comentariosEvaluacion .time {
            margin-bottom: 0.3rem;
            font-size: 0.85rem;
        }
    }

    #comentariosEvaluacion p {
        color: #4f4f4f;
        font-family: sans-serif;
        line-height: 1.5;
        margin-top: 0.4rem;
    }

    @media screen and (max-width: 600px) {
        #comentariosEvaluacion p {
            font-size: 0.9rem;
        }
    }

</style>
