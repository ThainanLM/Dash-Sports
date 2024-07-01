<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('connection.php'); // Incluir arquivo de conexão com o banco de dados

// Verificação da conexão com o banco de dados
if (!$db) {
    die("Erro ao conectar ao banco de dados.");
}

$message = ''; // Inicializa a variável $message

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Coleta os dados do formulário
    $filter_login = filter_var($_POST['login'], FILTER_SANITIZE_STRING);
    $login = htmlspecialchars($filter_login);

    $filter_password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
    $password = htmlspecialchars($filter_password);

    $filter_new_password = filter_var($_POST['new_password'], FILTER_SANITIZE_STRING);
    $new_password = htmlspecialchars($filter_new_password);

    // Verifica se os campos foram preenchidos
    if (empty($login) || empty($password) || empty($new_password)) {
        $message = "Por favor, preencha todos os campos.";
    } else {
        // Preparando e executando a consulta para verificar o usuário
        $query = $db->prepare("SELECT * FROM `users` WHERE login = :login");
        $query->bindParam(':login', $login, PDO::PARAM_STR);
        $query->execute();

        // Verificando se o usuário existe
        if ($query->rowCount() > 0) {
            $row = $query->fetch(PDO::FETCH_ASSOC);

            // Verificando a senha com password_verify()
            if (password_verify($password, $row['password'])) {
                // Hashing a nova senha
                $hashed_new_password = password_hash($new_password, PASSWORD_DEFAULT);

                // Atualizando a senha no banco de dados
                $update_query = $db->prepare("UPDATE users SET password = :new_password WHERE login = :login");
                $update_query->bindParam(':new_password', $hashed_new_password, PDO::PARAM_STR);
                $update_query->bindParam(':login', $login, PDO::PARAM_STR);
                $update_query->execute();

                if ($update_query->rowCount() > 0) {
                    // Redirecionar para login.php após a alteração de senha
                    header("Location: login.php");
                    exit();
                } else {
                    $message = "Erro ao atualizar a senha.";
                }
            } else {
                $message = 'Senha atual incorreta';
            }
        } else {
            $message = 'Login ou senha incorretos';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./output.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Dash-Login</title>
    
</head>
<body class="bg-gradient-to-r from-primary to-second dark:from-gray-950 dark:to-gray-800 font-roboto">
    <!-- Inclui o cabeçalho da página -->
    <?php include 'header.php'; ?>

    <main class="bg-white dark:bg-gray-800 max-w-lg mx-auto my-32 p-8 md:p-16 rounded-lg shadow-2xl">
        <section>
            <h3 class="font-semibold text-2xl font-roboto dark:text-white">Alteração de <em class="font-bold text-primary">Senha</em></h3>
            <?php if ($message != ''): ?>
            <p class="text-lg text-red-600 font-semibold justify-center items-center text-center border-2 rounded-lg border-red-600 my-6 py-1 px-2 animate-shake"><?php echo $message; ?></p>
            <?php endif; ?>
            <p class="text-gray-600 dark:text-gray-100 text-lg pt-2 font-roboto font-medium">Preencha os campos para mudar a senha.</p>
        </section>

        <section class="mt-10">
            <form method="post" class="flex flex-col">
                <div class="mb-6 rounded bg-gray-200">
                    <label for="login" class="block text-gray-700 text-sm font-bold mb-2 ml-3">Login</label>
                    <input type="text" id="login" name="login" class="bg-gray-200 rounded w-full text-gray-700 focus:outline-none border-b-4 border-gray-300 focus:border-black transition duration-500 px-3 pb-3" required>
                </div>
                <div class="mb-6 rounded bg-gray-200">
                    <label for="password" class="block text-gray-700 text-sm font-bold mb-2 ml-3">Senha Atual</label>
                    <input type="password" id="password" name="password" class="bg-gray-200 rounded w-full text-gray-700 focus:outline-none border-b-4 border-gray-300 focus:border-black transition duration-500 px-3 pb-3" required>
                </div>
                <div class="mb-3 rounded bg-gray-200">
                    <label for="new_password" class="block text-gray-700 text-sm font-bold mb-2 ml-3">Nova Senha</label>
                    <input type="password" id="new_password" name="new_password" class="bg-gray-200 rounded w-full text-gray-700 focus:outline-none border-b-4 border-gray-300 focus:border-black transition duration-500 px-3 pb-3" required>
                </div>
                <section class="flex flex-col space-y-2">
                    <button type="submit" class="bg-primary w-full hover:bg-black hover:scale-105 hover:transform hover:text-white font-bold font-bebas py-2 rounded-md shadow-lg hover:shadow-xl transition duration-200">Mudar senha</button>
                    <button type="reset" class="bg-green-700 w-full hover:bg-black hover:scale-105 hover:transform text-white font-bold font-bebas py-2 rounded-md shadow-lg hover:shadow-xl transition duration-200">Limpar</button>
                </section>
                <div class="flex justify-center">
                    <a href="login.php" class="text-lg dark:text-white font-medium font-bebas dark:hover:text-primary hover:text-primary  hover:underline my-6">Voltar para o login...</a>
                </div>
            </form>
        </section>
    </main>

  <footer class="inset-x-0 bottom-0 py-6 mt-3 bg-gray-300 dark:bg-black  text-black">
      <div class="container px-6 mx-auto space-y-6 divide-y divide-gray-400 md:space-y-12 divide-opacity-50">
          <div class="grid justify-center  lg:justify-between">

              <div class="flex flex-col self-center text-sm text-center md:block lg:col-start-1 md:space-x-5 dark:text-white">
                  <span>Copy right © 2024 por <em>Dash Sports</em></span>
                  <a rel="noopener noreferrer">
                    <span>Política de Privacidade</span>
                  </a>
                  <a rel="noopener noreferrer">
                    <span>Termos de serviço</span>
                  </a>
                  <a rel="noopener noreferrer" href="shop.php" class="text-blue-950 dark:text-white  font-semibold font-roboto hover:text-primary dark:hover:text-primary">
                  <span>Catálogo</span>
                  </a>
                  <a rel="noopener noreferrer" href="login.php" class="text-blue-950 dark:text-white  font-semibold font-roboto hover:text-primary dark:hover:text-primary">
                    <span>Login</span>
                  </a>
                  <a rel="noopener noreferrer" href="cadastro.php" class="text-blue-950 dark:text-white  font-semibold font-roboto hover:text-primary dark:hover:text-primary">
                    <span>Cadastrar-se</span>
                  </a>
              </div>
              <div class="flex justify-center pt-4 space-x-4 lg:pt-0 lg:col-end-13">
                  <a rel="noopener noreferrer" href="#" title="Email" class="flex items-center justify-center w-10 h-10 rounded-full bg-second  hover:bg-black dark:hover:bg-primary dark:bg-green-600  duration-150 text-gray-50">
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                          <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                          <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                      </svg>
                  </a>
                  <a rel="noopener noreferrer" href="#" title="Instagram" class="flex items-center justify-center w-10 h-10 rounded-full bg-second hover:bg-black dark:hover:bg-primary   dark:bg-green-600  duration-150 text-gray-50">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none">
                      <path fill-rule="evenodd" clip-rule="evenodd" d="M12 18C15.3137 18 18 15.3137 18 12C18 8.68629 15.3137 6 12 6C8.68629 6 6 8.68629 6 12C6 15.3137 8.68629 18 12 18ZM12 16C14.2091 16 16 14.2091 16 12C16 9.79086 14.2091 8 12 8C9.79086 8 8 9.79086 8 12C8 14.2091 9.79086 16 12 16Z" fill="#fff"/>
                      <path d="M18 5C17.4477 5 17 5.44772 17 6C17 6.55228 17.4477 7 18 7C18.5523 7 19 6.55228 19 6C19 5.44772 18.5523 5 18 5Z" fill="#fff"/>
                      <path fill-rule="evenodd" clip-rule="evenodd" d="M1.65396 4.27606C1 5.55953 1 7.23969 1 10.6V13.4C1 16.7603 1 18.4405 1.65396 19.7239C2.2292 20.8529 3.14708 21.7708 4.27606 22.346C5.55953 23 7.23969 23 10.6 23H13.4C16.7603 23 18.4405 23 19.7239 22.346C20.8529 21.7708 21.7708 20.8529 22.346 19.7239C23 18.4405 23 16.7603 23 13.4V10.6C23 7.23969 23 5.55953 22.346 4.27606C21.7708 3.14708 20.8529 2.2292 19.7239 1.65396C18.4405 1 16.7603 1 13.4 1H10.6C7.23969 1 5.55953 1 4.27606 1.65396C3.14708 2.2292 2.2292 3.14708 1.65396 4.27606ZM13.4 3H10.6C8.88684 3 7.72225 3.00156 6.82208 3.0751C5.94524 3.14674 5.49684 3.27659 5.18404 3.43597C4.43139 3.81947 3.81947 4.43139 3.43597 5.18404C3.27659 5.49684 3.14674 5.94524 3.0751 6.82208C3.00156 7.72225 3 8.88684 3 10.6V13.4C3 15.1132 3.00156 16.2777 3.0751 17.1779C3.14674 18.0548 3.27659 18.5032 3.43597 18.816C3.81947 19.5686 4.43139 20.1805 5.18404 20.564C5.49684 20.7234 5.94524 20.8533 6.82208 20.9249C7.72225 20.9984 8.88684 21 10.6 21H13.4C15.1132 21 16.2777 20.9984 17.1779 20.9249C18.0548 20.8533 18.5032 20.7234 18.816 20.564C19.5686 20.1805 20.1805 19.5686 20.564 18.816C20.7234 18.5032 20.8533 18.0548 20.9249 17.1779C20.9984 16.2777 21 15.1132 21 13.4V10.6C21 8.88684 20.9984 7.72225 20.9249 6.82208C20.8533 5.94524 20.7234 5.49684 20.564 5.18404C20.1805 4.43139 19.5686 3.81947 18.816 3.43597C18.5032 3.27659 18.0548 3.14674 17.1779 3.0751C16.2777 3.00156 15.1132 3 13.4 3Z" fill="#fff"/>
                      </svg>
                  </a>
                  <a rel="noopener noreferrer" href="#" title="Facebook" class="flex items-center justify-center w-10 h-10 rounded-full bg-second hover:bg-black dark:hover:bg-primary dark:bg-green-600   duration-150 text-gray-50">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#fff" class="w-5 h-6" version="1.1" id="Layer_1" viewBox="0 0 310 310" xml:space="preserve">
                      <g id="XMLID_834_">
                        <path id="XMLID_835_" d="M81.703,165.106h33.981V305c0,2.762,2.238,5,5,5h57.616c2.762,0,5-2.238,5-5V165.765h39.064   c2.54,0,4.677-1.906,4.967-4.429l5.933-51.502c0.163-1.417-0.286-2.836-1.234-3.899c-0.949-1.064-2.307-1.673-3.732-1.673h-44.996   V71.978c0-9.732,5.24-14.667,15.576-14.667c1.473,0,29.42,0,29.42,0c2.762,0,5-2.239,5-5V5.037c0-2.762-2.238-5-5-5h-40.545   C187.467,0.023,186.832,0,185.896,0c-7.035,0-31.488,1.381-50.804,19.151c-21.402,19.692-18.427,43.27-17.716,47.358v37.752H81.703   c-2.762,0-5,2.238-5,5v50.844C76.703,162.867,78.941,165.106,81.703,165.106z"/>
                      </g>
                      </svg>
                  </a>
              </div>
          </div>
      </div>
    </footer>
</body>
</html>
