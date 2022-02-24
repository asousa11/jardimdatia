const start = document.getElementById("start");
const quiz = document.getElementById("quiz");
const qImg = document.getElementById("qImage");
const question = document.getElementById("question");
const choiceA = document.getElementById("A");
const choiceB = document.getElementById("B");
const choiceC = document.getElementById("C");
const choiceD = document.getElementById("D");
const result = document.getElementById("result");
const okButton = document.getElementById('okButton');
const form = document.getElementById('form');

let q = 'None';

let questions = [
    {
        question: "Qual é esta flor?",
        imgSrc: "/images/rosa.jpg",
        choiceA: "Rosa",
        choiceB: "Feto",
        choiceC: "Orquidea",
        choiceD: "Girassol",
        correct: "A",
        dataInicio: new Date(2020, 6, 22),
        dataFim: new Date(2020, 6, 28, 23, 59, 59)
    },
    {
        question: "Qual a época do ano da flor na imagem?",
        imgSrc: "/images/malmequer.jpeg",
        choiceA: "Primavera",
        choiceB: "Verão",
        choiceC: "Outono",
        choiceD: "Inverno",
        correct: "B",
        dataInicio: new Date(2020, 6, 22),
        dataFim: new Date(2020, 6, 28, 23, 59, 59)
    },
    {
        question: "Qual a flor na imagem?",
        imgSrc: "/images/orquidea.jpg",
        choiceA: "Malmequer",
        choiceB: "Rosa",
        choiceC: "Orquidea",
        choiceD: "Girassol",
        correct: "C",
        dataInicio: new Date(2020, 6, 22),
        dataFim: new Date(2020, 6, 28, 23, 59, 59)
    }
]

function renderQuestion() {
    q = questions[Math.floor(Math.random() * questions.length)];
    qImg.style.display = "block";
    qImg.style.backgroundImage = "url('"+q.imgSrc+"')";
    choiceA.innerHTML = q.choiceA;
    choiceB.innerHTML = q.choiceB;
    choiceC.innerHTML = q.choiceC;
    choiceD.innerHTML = q.choiceD;
    question.innerHTML = q.question;
}

function checkAnswer(answer, contribuinte) {
    if (q.correct === answer){
        // result.innerHTML = "<h4>Parabéns! Ganhou 10 pontos em cartão.</h4>";
        // result.style.visibility = 'visible';
        const resultado = "certo"
        scoreRender(1, "Parabéns! Ganhou 1 ponto em cartão.", resultado);
        setTimeout(function(){
            window.location.replace(`/jogo/${contribuinte}/${resultado}`);
        }, 2500);

    }else{
        // result.innerHTML = "<h4>Falhou. Tente novamente na próxima semana.</h4>";
        // result.style.visibility = 'visible';
        const resultado = "errado"
        scoreRender(0, "Falhou. Tente novamente na próxima semana.");
        setTimeout(function(){
            window.location.replace(`/jogo/${contribuinte}/${resultado}`);
        }, 2500);
    }
}

start.addEventListener("click", startQuiz)
function startQuiz() {
    start.style.display = "none";
    renderQuestion();
    quiz.style.display = "block";
}

// score render
function scoreRender(score, msg){
    let img = (score === 1) ? "/images/certo.png" : "/images/errado.png";

    document.body.innerHTML = "<div class=\"modal fade\" id=\"exampleModalCenter\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"exampleModalCenterTitle\" aria-hidden=\"true\">\n" +
        "        <div class=\"modal-dialog modal-dialog-centered\" role=\"document\">\n" +
        "            <div class=\"modal-content\">\n" +
        "                <div class=\"modal-header\">\n" +
        "                    <h5 class=\"modal-title\" id=\"exampleModalLongTitle\">Resultado</h5>\n" +
        "                    <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">\n" +
        "                        <span aria-hidden=\"true\">&times;</span>\n" +
        "                    </button>\n" +
        "                </div>\n" +
        "                <div class=\"modal-body text-center\">\n" +
        "                    <div class=\"d-flex justify-content-center\" style='margin-bottom: 2%'>\n"+
        "                    <img src='"+img+"'></div>\n" +
        "                    "+msg+"\n" +
        "                    <br>Aguarde enquanto é reencaminhado...\n" +
        "                </div>\n"+
        "            </div>\n" +
        "        </div>\n" +
        "    </div>"

    // choose the image based on the scorePerCent

    //result.innerHTML += "<img src="+ img +">";
    //result.innerHTML += "<p>"+ msg +"</p>";
    // let input = document.createElement("input");
    // input.type = "hidden";
    // input.name = "resultado";
    // input.id = "resultado";
    // input.value = resultado;
    // form.appendChild(input);
    // form.innerHTML += "<input id=\"resultado\" name=\"resultado\" type=\"hidden\" value="+resultado+">"
    // setTimeout(function(){
    //     document.getElementById('form').submit();
    // }, 30000);

}
