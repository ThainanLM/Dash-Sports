<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include 'connection.php';

date_default_timezone_set('America/Sao_Paulo');


$user_id = $_SESSION['user_id'];

// Obter nome do usuário
$query = "SELECT name, datanasc, CEP, nameM FROM users WHERE id = ?";
$stmt = $db->prepare($query);
$stmt->execute([$user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
$nome_usuario = $user['name'];

// Formatar a data de nascimento para o formato dd/mm/aaaa
$user['datanasc'] = date('d/m/Y', strtotime($user['datanasc']));

$questions = [
    "Qual a data de seu Nascimento?" => $user['datanasc'],
    "Qual o CEP do seu endereço?" => $user['CEP'],
    "Qual o seu nome Materno?" => $user['nameM']
];

$question_keys = array_keys($questions);

if (!isset($_SESSION['question'])) {
    $question = $question_keys[rand(0, count($question_keys) - 1)];
    $_SESSION['question'] = $question;
    $_SESSION['answer'] = $questions[$question];
    $_SESSION['attempts'] = 0;

    // Inserir a pergunta 2FA na tabela
    $insert_query = "INSERT INTO pergunta_2fa (user_id, pergunta, data_hora, nome_usuario) VALUES (?, ?, ?, ?)";
    $stmt = $db->prepare($insert_query);
    $stmt->execute([$user_id, $question, date('Y-m-d H:i:s'), $nome_usuario]);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_answer = $_POST['answer'];
    $_SESSION['attempts']++;

    // Formatar as respostas conforme necessário
    $correct_answer = $_SESSION['answer'];
    if ($_SESSION['question'] === "Qual o seu nome Materno?") {
        $correct_answer = strtolower($correct_answer);
        $user_answer = strtolower($user_answer);
    } else if ($_SESSION['question'] === "Qual a data de seu Nascimento?") {
        // Formatar data de nascimento
        $user_answer = date('d/m/Y', strtotime(str_replace('/', '-', $user_answer)));
    } else if ($_SESSION['question'] === "Qual o CEP do seu endereço?") {
        // Formatar CEP
        $user_answer = preg_replace('/[^0-9]/', '', $user_answer);
        $user_answer = substr($user_answer, 0, 5) . '-' . substr($user_answer, 5, 3);
    }

    if ($user_answer == $correct_answer) {
        // Atualizar a data e hora de conclusão da verificação na tabela pergunta_2fa
        $update_query = "UPDATE pergunta_2fa SET data_hora = ? WHERE user_id = ? AND pergunta = ? ORDER BY id DESC LIMIT 1";
        $stmt = $db->prepare($update_query);
        $stmt->execute([date('Y-m-d H:i:s'), $user_id, $_SESSION['question']]);
        
        header("Location: index.php");
        exit();
    } else if ($_SESSION['attempts'] >= 3) {
        session_destroy();
        header("Location: login.php");
        exit();
    } else {
        // Remove a pergunta atual dos possíveis próximos question_keys
        $next_question_keys = array_diff($question_keys, [$_SESSION['question']]);
        
        // Seleciona uma pergunta aleatória dentre as restantes
        $next_question = $next_question_keys[array_rand($next_question_keys)];
        
        $_SESSION['question'] = $next_question;
        $_SESSION['answer'] = $questions[$next_question];

        // Inserir a nova pergunta 2FA na tabela
        $insert_query = "INSERT INTO pergunta_2fa (user_id, pergunta, data_hora, nome_usuario) VALUES (?, ?, ?, ?)";
        $stmt = $db->prepare($insert_query);
        $stmt->execute([$user_id, $next_question, date('Y-m-d H:i:s'), $nome_usuario]);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./output.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://unpkg.com/vanilla-masker/build/vanilla-masker.min.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Máscara para Data de Nascimento
        VMasker(document.querySelector('#datanasc')).maskPattern('99/99/9999');

        // Máscara para Nome Materno
        VMasker(document.querySelector('#nameM')).maskPattern('');

        // Máscara para CEP
        VMasker(document.querySelector('#cep')).maskPattern('99999-999');
    });
    </script>
    
    <title>Dash-Login</title>
</head>
<body class="h-auto bg-gradient-to-r from-primary to-second dark:from-gray-950 dark:to-gray-800 font-roboto">
     
 

    <!-- Login -->
  <main class="bg-white dark:bg-gray-800 max-w-lg mx-auto items-center justify-center my-32 p-8 md:p-20  rounded-lg shadow-2xl">
      <section>
          <h3 class="font-bold text-2xl font-roboto dark:text-white">Verificação de <b class="font-bold text-second dark:text-primary">Autentificação</b></h3>
          <p class="font-medium my-4 dark:text-white">Confirme seu Login ao responder
          </p>
      </section>

      <section class="mt-10">
        <form action="#" method="post" class="flex flex-col">
          <div class="mb-6 rounded bg-gray-200">
          <p><?php echo $_SESSION['question']; ?></p>
          <input type="text" id="answer" name="answer" 
       <?php if ($_SESSION['question'] === "Qual o CEP do seu endereço?") echo 'pattern="[0-9]{5}-[0-9]{3}" title="Formato esperado: 12345-678"'; ?>
       <?php if ($_SESSION['question'] === "Qual a data de seu Nascimento?") echo 'pattern="\d{2}/\d{2}/\d{4}" title="Formato esperado: dd/mm/aaaa"'; ?>
       class="bg-gray-200 rounded w-full text-gray-700 focus:outline-none border-b-4 border-gray-300  focus:border-black transition duration-500 px-3 pb-3" required>
          </div>
          
          <section class="flex flex-col space-y-2">
            <button class="bg-primary w-full hover:bg-black hover:scale-105 hover:transform hover:text-white font-bold font-bebas py-2 rounded-md shadow-lg hover:shadow-xl transition duration-200" type="submit">Enviar</button>
      
            <div class="flex justify-center">
              <a href="login.php" class="text-lg font-semibold font-bebas hover:text-primary dark:hover:text-primary hover:underline my-6 dark:text-white">Retornar ao Login</a>
            </div>
          </section>
        </form>
      </section>
      
  </main>
 
<script src="script.js"></script>
</body>
</html>