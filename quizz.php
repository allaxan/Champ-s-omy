<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NERD</title>
    <link rel="stylesheet" href="style.css">
</head>

<style>
    body {
    margin: 0;
    padding: 0;
    font-family: "Inter", Arial, sans-serif;
    background: linear-gradient(135deg, #E8DCC4 0%, #9B9372 100%);
    min-height: 100vh;
}

header {
    background: #3D3D3D;
    border: 3px solid #E8DCC4;
    padding: 0;
}

nav {
    display: flex;
    justify-content: space-between;
    align-items: center;
    max-width: 1200px;
    margin: 0 auto;
    padding: 0;
}

.nav-link {
    flex: 1;
    text-align: center;
    padding: 15px 20px;
    color: #E8DCC4;
    text-decoration: none;
    font-size: 14px;
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    border-right: 2px solid #E8DCC4;
}

.nav-link:first-child {
    border-left: none;
}

.nav-link:hover {
    background: rgba(232, 220, 196, 0.1);
}

.logo {
    flex: 1.5;
    text-align: center;
    padding: 15px 30px;
    color: #E8DCC4;
    font-size: 18px;
    font-weight: bold;
    border: 3px solid #E8DCC4;
    border-top: none;
    border-bottom: none;
    letter-spacing: 1px;
}

#quiz-container {
    background: #F5F1EB;
    width: 90%;
    max-width: 480px;
    padding: 25px;
    border-radius: 12px;
    box-shadow: 0 8px 24px rgba(61, 61, 61, 0.15);
    border-top: 4px solid #A68B54;
    margin: 40px auto;
}

#counter {
    font-size: 14px;
    color: #030303;
    margin-bottom: 10px;
    font-weight: 500;
}

#question {
    font-size: 20px;
    font-weight: bold;
    margin-bottom: 20px;
    color: #3D3D3D;
}

/* Boutons réponses */
.answer-btn {
    width: 100%;
    padding: 12px 15px;
    margin-bottom: 12px;
    border: 2px solid #A68B54;
    background: #F9F7F3;
    border-radius: 8px;
    font-size: 15px;
    color: #3D3D3D;
    cursor: pointer;
    transition: 0.2s ease;
    font-weight: 500;
}

.answer-btn:hover:not(:disabled) {
    background: #E8DCC4;
    border-color: #9B9372;
}

.answer-btn:focus {
    outline: 3px solid #A68B54;
    outline-offset: 2px;
}

/* Bonne réponse */
.correct {
    background: #E8F5E9 !important;
    border-color: #558B2F !important;
    color: #33691E !important;
}

/* Mauvaise réponse */
.incorrect {
    background: #FFEBEE !important;
    border-color: #C62828 !important;
    color: #B71C1C !important;
}

/* Bouton "Voir l'explication" */
#see-explanation {
    width: 100%;
    padding: 12px;
    margin-top: 10px;
    margin-bottom: 10px;
    border: 2px solid #A68B54;
    background: #A68B54;
    color: #FFFFFF;
    border-radius: 8px;
    font-size: 15px;
    cursor: pointer;
    transition: 0.25s;
    font-weight: 600;
}

#see-explanation:hover:not(:disabled) {
    background: #9B9372;
    border-color: #7A6A42;
}

#see-explanation:focus {
    outline: 3px solid #7A6A42;
    outline-offset: 2px;
}

#see-explanation:disabled {
    opacity: 0.6;
    cursor: not-allowed;
}

/* Explication */
#explanation {
    background: #F9F7F3;
    border-left: 4px solid #A68B54;
    padding: 12px;
    margin-top: 10px;
    border-radius: 6px;
    color: #3D3D3D;
}

/* Bouton suivant */
#next-btn {
    width: 100%;
    padding: 12px;
    background: #A68B54;
    color: white;
    border: 2px solid #A68B54;
    border-radius: 8px;
    margin-top: 18px;
    font-size: 16px;
    cursor: pointer;
    transition: 0.25s;
    font-weight: 500;
}

#next-btn:hover {
    background: #9B9372;
    border-color: #7A6A42;
}

#next-btn:focus {
    outline: 3px solid #9B9372;
    outline-offset: 2px;
}

</style>

<body>
    <header>
        <nav>
            <a href="index.html" class="nav-link">ACCUEIL</a>
            <a href="#" class="nav-link">COLLECTION</a>
            <div class="logo">LOGO</div>
            <a href="#" class="nav-link">Nird</a>
            <a href="#" class="nav-link">SE DÉCONNECTER</a>
        </nav>
    </header>

    <div id="quiz-container">
        <div id="question">Question ici</div>
        <div id="reponse"></div>
        <!-- Bouton pour afficher l'explication (caché par défaut) -->
        <button id="see-explanation" aria-controls="explanation" aria-expanded="false" hidden>Voir l'explication</button>

        <div id="explanation" class="explanation" aria-live="polite" aria-atomic="true" hidden>Explication ici</div>

        <button id="next-btn" hidden>Suivant</button>
    </div>



    <script>

const quizData = [
    {
        question: "Qui sont les GAFAM ?",
        reponse: [
            { text: "Google, Apple, Facebook, Amazon et Microsoft", correct: true },
            { text: "GitHub, Adobe, Figma, Autodesk, Minecraft ", correct: false },
            { text: "GIMP, Acer, Firefox, Arte, Messenger ", correct: false },
           
        ], 
        explanation: "Les GAFAM sont les cinq grandes entreprises technologiques américaines : Google, Apple, Facebook (Meta), Amazon et Microsoft, qui dominent le marché du numérique dans le monde."
    },
    {
        question: "Quelle pratique réduit votre impact écologique numérique ?",
        reponse: [
            { text: "Garder toutes ses vidéos en 4K", correct: false },
            { text: "Laisser 100 onglets ouverts", correct: false },
            { text: "Vider régulièrement ses mails", correct: true },
            { text: "Recharger son téléphone toute la nuit", correct: false }
        ], 
        explanation: "Vider régulièrement ses mails permet de réduire l'espace de stockage nécessaire et donc l'énergie consommée par les serveurs qui consomme énormément."
    },
    {
        question: "Qu’est-ce qui caractérise vraiment un logiciel open-source ?",
        reponse: [
            { text: "Un logiciel obligatoirement compatible avec Linux", correct: false },
            { text: "Le fait qu’il soit gratuit pour la plupart des utilisateurs", correct: false },
            { text: "L’obligation d’être développé par des bénévoles", correct: false },
            { text: "Son code source accessible et réutilisable sous une licence spécifique", correct: true }
        ],
        explanation: "Un logiciel open-source est caractérisé par la disponibilité de son code source, qui peut être consulté, modifié et redistribué sous une licence spécifique, on peut prendre comme exemple GitHub."
    },
    {
        question: "Que pourrait-il se passer si on était sur un réseau Wi-Fi public ?",
        reponse: [
            { text: "Le réseau peut limiter la vitesse de téléchargement", correct: false },
            { text: "Le réseau peut empêcher l’accès à certains sites", correct: false },
            { text: "Votre compte bancaire pourrait se faire attaquer", correct: true },
            { text: "Le réseau peut provoquer une surconsommation de batterie", correct: false }
        ],
        explanation: "Les réseaux Wi-Fi publics sont souvent moins sécurisés que les réseaux privés, ce qui peut exposer vos données à des attaques potentielles."
    },
    {
        question: "Quelle vérification est essentielle avant l’installation d’une application ?",
        reponse: [
            { text: "Vérifier les avis récents des utilisateurs", correct: true },
            { text: "Vérifier si l’application est dans le top du store", correct: false },
            { text: "Regarder la taille de l’application", correct: false },
            { text: "Vérifier le nombre de téléchargements", correct: false }
        ], 
        explanation: "Les avis récents des utilisateurs peuvent fournir des informations sur la fiabilité et la sécurité de l’application, notamment en identifiant des problèmes récents ou des comportements suspects."
    },
    {
        question: "Quel est un comportement responsable sur les réseaux sociaux ?",
        reponse: [
            { text: "Partager une rumeur", correct: false },
            { text: "Respecter les autres et vérifier ce qu’on poste", correct: true },
            { text: "Envoyer un message anonyme méchant", correct: false },
            { text: "Ignorer les commentaires constructifs", correct: false }
        ],
        explanation: "Il est important de maintenir un environnement respectueux et de vérifier les informations avant de les partager."
    },
    {
        question: "En France, quel est le pourcentage de sites web conformes aux normes d’accessibilité en vigueur ?",
        reponse: [
            { text: "Moins de 1%", correct: true },
            { text: "Moins de 25%", correct: false },
            { text: "Moins de 50%", correct: false },
            { text: "Moins de 35%", correct: false }
        ],
        explanation: "En janvier 2025, sur les 4 250 sites examinés (publics et privés), moins de 1 % se déclarent totalement conformes à la norme légale."
    }
];

const questionEl = document.getElementById('question');
const reponseEl = document.getElementById('answers') || document.getElementById('reponse');
const nextBtn = document.getElementById('next-btn');
const seeExplanationEl = document.getElementById('see-explanation');
const explanationEl = document.getElementById('explanation');

// 🔥 nouveau : compteur
let statusCounter = document.getElementById('counter');
if (!statusCounter) {
    statusCounter = document.createElement('div');
    statusCounter.id = "counter";
    statusCounter.style.marginBottom = "10px";
    statusCounter.style.fontWeight = "bold";
    document.getElementById("quiz-container").prepend(statusCounter);
}

let currentQuestion = 0;
let score = 0;

function showQuestion() {
    const q = quizData[currentQuestion];
    questionEl.textContent = q.question;

    // compteur Question X / Y
    statusCounter.textContent = `Question ${currentQuestion + 1} / ${quizData.length}`;

    reponseEl.innerHTML = '';
    explanationEl.hidden = true;
    seeExplanationEl.hidden = true;
    nextBtn.hidden = true;

    q.reponse.forEach(reponse => {
        const button = document.createElement('button');
        button.textContent = reponse.text;
        button.className = 'answer-btn';
        button.addEventListener('click', () => selectAnswer(button, reponse));
        reponseEl.appendChild(button);
    });
}

function selectAnswer(button, reponse) {
    const buttons = reponseEl.querySelectorAll('button');
    buttons.forEach(b => b.disabled = true);

    if (reponse.correct) {
        score++;
        button.classList.add('correct');
    } else {
        button.classList.add('incorrect');
        buttons.forEach((b, i) => {
            if (quizData[currentQuestion].reponse[i].correct) {
                b.classList.add('correct');
            }
        });
    }

    const q = quizData[currentQuestion];

    // ✔️ Si explication → bouton explication
    if (q.explanation) {
        seeExplanationEl.hidden = false;
        seeExplanationEl.onclick = () => showExplanation(q.explanation);
    } else {
        // ✔️ Pas d’explication → délai de 1 s avant d’afficher "Suivant"
        setTimeout(() => {
            nextBtn.hidden = false;
        }, 1000);
    }
}

function showExplanation(text) {
    seeExplanationEl.hidden = true;
    explanationEl.textContent = text;
    explanationEl.hidden = false;

    // ✔️ après l’explication → délai 1 s avant "Suivant"
    setTimeout(() => {
        nextBtn.hidden = false;
    }, 1000);
}

nextBtn.addEventListener('click', () => {
    currentQuestion++;
    if (currentQuestion < quizData.length) {
        showQuestion();
    } else {
        showScore();
    }
});

function showScore() {
    questionEl.textContent = `Bon t'as eu un score de ${score} tu pourrai faire mieux non ? Alors viens apprendre en t'amusant / ${quizData.length}`;
    reponseEl.innerHTML = '';
    seeExplanationEl.hidden = true;
    explanationEl.hidden = true;
    nextBtn.hidden = true;
}

showQuestion();


    </script>
</body>

</html>
