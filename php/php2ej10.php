<?php

$tweets = [
    "¡Hoy es un gran día para aprender algo nuevo! 🌟",
    "El éxito está en la constancia, no en la velocidad. 💪",
    "Recuerda tomar un descanso. Tu salud mental importa. 🧘‍♂️",
    "¡Comparte tus ideas, pueden inspirar a otros! 💡",
    "Sé tú mismo, todos los demás ya están ocupados. 😎"
];


function mostrarTweet($contenido) {
    return "<div style='
        border: 1px solid #ddd;
        padding: 15px;
        margin: 10px auto;
        max-width: 500px;
        border-radius: 10px;
        font-family: Arial, sans-serif;
        font-size: 16px;
        background-color: #f5f8fa;
        color: #14171a;
    '>
        <p style='margin: 0;'>$contenido</p>
    </div>";
}


echo "<h1 style='font-family: Arial, sans-serif; text-align: center;'>Tweets</h1>";
foreach ($tweets as $tweet) {
    echo mostrarTweet($tweet);
}
?>
