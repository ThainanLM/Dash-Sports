<?php
include('connection.php');
session_start();

$user_id = $_SESSION['user_id'];

date_default_timezone_set('America/Sao_Paulo');

// Definir filtro padrão e opções
$filter_options = ['todos', 'name', 'cpf'];
$current_filter = isset($_GET['filter']) && in_array($_GET['filter'], $filter_options) ? $_GET['filter'] : 'todos';
$search_query = isset($_GET['search']) ? $_GET['search'] : '';

// Construir a consulta SQL baseada no filtro e na pesquisa
$query = "
SELECT 
    u.id,
    u.login,
    u.name,
    u.cpf,
    p.pergunta AS ultimo_2fa,
    p.data_hora AS data_ultimo_2fa,
    u.last_login
FROM 
    users u
LEFT JOIN 
    pergunta_2fa p ON u.id = p.user_id
";

// Aplicar filtro e busca
if ($current_filter === 'name') {
    $query .= " WHERE u.name LIKE :search ";
    $search_param = "%{$search_query}%";
} elseif ($current_filter === 'cpf') {
    $query .= " WHERE u.cpf LIKE :search ";
    $search_param = "%{$search_query}%";
} else {
    $search_param = "%{$search_query}%";
}

$query .= " GROUP BY u.id";

$stmt = $db->prepare($query);
if ($current_filter !== 'todos') {
    $stmt->bindParam(':search', $search_param, PDO::PARAM_STR);
}
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Obtendo os parâmetros de pesquisa e filtro
$search_query = isset($_GET['search']) ? $_GET['search'] : '';
$current_filter = isset($_GET['filter']) ? $_GET['filter'] : 'todos';

// Construção da query base
$query = "SELECT * FROM users WHERE 1=1";

// Adicionando condições à query com base no filtro
if ($current_filter === 'name') {
    $query .= " AND name LIKE :search";
    $params = [':search' => '%' . $search_query . '%'];
} elseif ($current_filter === 'cpf') {
    $query .= " AND cpf LIKE :search";
    $params = [':search' => '%' . $search_query . '%'];
} else {
    $query .= " AND (name LIKE :search OR cpf LIKE :search)";
    $params = [':search' => '%' . $search_query . '%'];
}

// Construção da query base para obter todos os usuários
$query = "SELECT * FROM users";
$stmt = $db->prepare($query);
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Consulta para obter os usuários e a última pergunta de 2FA respondida
$query = "
SELECT 
    u.id,
    u.login,
    u.name,
    u.cpf,
    p.pergunta AS ultimo_2fa,
    p.data_hora AS data_ultimo_2fa,
    MAX(p.data_hora) AS ultima_verificacao,
    u.last_login
FROM 
    users u
LEFT JOIN 
    pergunta_2fa p ON u.id = p.user_id
GROUP BY 
    u.id
";

$stmt = $db->prepare($query);
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Percorrer os resultados e atualizar last_login na tabela users
foreach ($users as $user) {
    $user_id = $user['id'];
    $ultima_verificacao = $user['ultima_verificacao'];

    // Atualizar last_login na tabela users
    $update_query = "UPDATE users SET last_login = ? WHERE id = ?";
    $stmt = $db->prepare($update_query);
    $stmt->execute([$ultima_verificacao, $user_id]);
}

// Função para registrar o login do usuário e atualizar last_login
function logUserLogin($db, $userId) {
    // Atualizar last_login na tabela users
    $update_query = "UPDATE users SET last_login = NOW() WHERE id = ?";
    $stmt = $db->prepare($update_query);
    $stmt->execute([$userId]);

    // Registrar o login na tabela logins (se necessário)
    $insert_query = "INSERT INTO logins (user_id) VALUES (:user_id)";
    $stmt = $db->prepare($insert_query);
    $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
    $stmt->execute();
}
// Consulta principal para obter os usuários e a última pergunta de 2FA respondida
$query = "
SELECT 
    u.id,
    u.login,
    u.name,
    u.cpf,
    p.pergunta AS ultimo_2fa,
    p.data_hora AS data_ultimo_2fa,
    u.last_login
FROM 
    users u
LEFT JOIN 
    (SELECT 
        user_id, 
        pergunta, 
        MAX(data_hora) as data_hora
     FROM 
        pergunta_2fa
     GROUP BY 
        user_id
     ORDER BY 
        data_hora DESC) p
ON 
    u.id = p.user_id;
";

$stmt = $db->prepare($query);
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Processar exclusão de usuário
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_user_id'])) {
    $delete_user_id = $_POST['delete_user_id'];

    // Verificar se o formulário de confirmação foi enviado
    if (isset($_POST['confirm_delete']) && $_POST['confirm_delete'] === 'yes') {
        // Preparar a consulta SQL para excluir o usuário
        $sql_delete_user = "DELETE FROM users WHERE id = ?";
        $stmt = $db->prepare($sql_delete_user);
        $stmt->execute([$delete_user_id]);

        // Verificar se o usuário foi excluído com sucesso
        $count = $stmt->rowCount();
        if ($count > 0) {
            // Redirecionar com uma mensagem de sucesso
            $_SESSION['message'] = 'Usuário excluído com sucesso!';
            $_SESSION['message_type'] = 'success';
        } else {
            // Se não foi possível excluir, definir uma mensagem de erro
            $_SESSION['message'] = 'Erro ao excluir usuário.';
            $_SESSION['message_type'] = 'error';
        }

        // Redirecionar de volta para a página atual
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit;
    } else {
        // Redirecionar de volta para a página atual sem excluir
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit;
    }
}

// Processar adição de usuário
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_POST['delete_user_id'])) {
    $nome = $_POST['name'];
    $datanasc = $_POST['datanasc'];
    $sexo = $_POST['sexo'];
    $nameM = $_POST['nameM'];
    $cpf = $_POST['cpf'];
    $email = $_POST['email'];
    $telefoneC = $_POST['telefoneC'];
    $telefoneF = $_POST['telefoneF'];
    $cep = $_POST['cep'];
    $endereco = $_POST['endereco'];
    $login = $_POST['login'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm-password'];

    if ($password !== $confirm_password) {
        $_SESSION['message'] = 'Erro: As senhas não coincidem.';
        $_SESSION['message_type'] = 'error';
        header('Location: cadastro.php');
        exit;
    }
    // Criptografar a senha
    $senha_criptografada = password_hash($password, PASSWORD_DEFAULT);

    // Preparar a consulta SQL para inserir o novo usuário
    $sql = "INSERT INTO users (name, datanasc, sexo, nameM, cpf, email, telefoneC, telefoneF, CEP, endereco, login, password) 
            VALUES (:name, :datanasc, :sexo, :nameM, :cpf, :email, :telefoneC, :telefoneF, :cep, :endereco, :login, :password)";

    $query = $db->prepare($sql);

    // Bind dos parâmetros
    $query->bindParam(':name', $nome, PDO::PARAM_STR);
    $query->bindParam(':datanasc', $datanasc, PDO::PARAM_STR);
    $query->bindParam(':sexo', $sexo, PDO::PARAM_STR);
    $query->bindParam(':nameM', $nameM, PDO::PARAM_STR);
    $query->bindParam(':cpf', $cpf, PDO::PARAM_STR);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->bindParam(':telefoneC', $telefoneC, PDO::PARAM_STR);
    $query->bindParam(':telefoneF', $telefoneF, PDO::PARAM_STR);
    $query->bindParam(':cep', $cep, PDO::PARAM_STR);
    $query->bindParam(':endereco', $endereco, PDO::PARAM_STR);
    $query->bindParam(':login', $login, PDO::PARAM_STR);
    $query->bindParam(':password', $senha_criptografada, PDO::PARAM_STR);

    // Executar a consulta e verificar erros
    try {
        $query->execute();
        $_SESSION['message'] = 'Usuário cadastrado com sucesso!';
        $_SESSION['message_type'] = 'success';
        header('Location: cadastro.php');
        exit;
    } catch (PDOException $e) {
        $_SESSION['message'] = 'Erro ao cadastrar usuário: ' . $e->getMessage();
        $_SESSION['message_type'] = 'error';
        header('Location: cadastro.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="output.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://unpkg.com/vanilla-masker/build/vanilla-masker.min.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Máscara para CPF
        VMasker(document.querySelector('#cpf')).maskPattern('999.999.999-99');

        // Máscara para Telefone Celular
        VMasker(document.querySelector('#telefoneC')).maskPattern('(99) 99999-9999');

        // Máscara para Telefone Fixo
        VMasker(document.querySelector('#telefoneF')).maskPattern('(99) 9999-9999');

        // Máscara para CEP
        VMasker(document.querySelector('#cep')).maskPattern('99999-999');
    });
    </script>

    <title>Dash-Admin</title>
</head>
<body class="relative bg-gray-100 dark:bg-gray-800 font-inter antialiased">
    
<?php include 'header.php'; ?>

    <!-- Consulta de Usuários -->
    <div class="container md:flex-col md:px-34 mt-24 items-center justify-center py-8 w-full">
        <section class="flex text-center justify-around my-2">
            <h1 class="font-bebas text-2xl text-start dark:text-gray-100">Consulta de Usuários</h1>
            <button class="bg-primary justify-between border-2 m-1 border-primary font-semibold shadow-md text-center text-white hover:text-primary dark:hover:text-primary dark:text-black hover:bg-transparent hover:transition hover:transform duration-200 text-xl px-2 rounded hover:scale-105 " onclick="showForm()">
                <i class="fa-solid fa-plus"></i>Novo usuário
            </button>
        </section>

        <!-- Formulário de filtro e busca -->
        <div class="container mx-auto p-4">
        <form method="GET" class="mx-auto my-10 max-w-2xl">
            <div class="relative bg-white dark:bg-gray-700 flex flex-col md:flex-row items-center justify-center border dark:border-gray-950 py-2 px-2 rounded-2xl gap-2 shadow-2xl focus-within:scale-105 transform transition ">
                <input id="search-bar" name="search" placeholder="Pesquisar por..." class="px-6 py-2 w-full rounded-md flex-1 outline-none bg-white dark:text-white dark:bg-gray-700" value="<?= htmlspecialchars($search_query) ?>">
                <select id="filter" name="filter" class="bg-black dark:bg-white md:w-auto w-full rounded-xl border-2 border-black dark:border-white hover:transform transition text-white dark:text-black py-1 px-3 font-roboto text-lg font-medium">
                    <option value="todos" <?= $current_filter === 'todos' ? 'selected' : '' ?>>Todos</option>
                    <option value="name" <?= $current_filter === 'name' ? 'selected' : '' ?>>Nome</option>
                    <option value="cpf" <?= $current_filter === 'cpf' ? 'selected' : '' ?>>CPF</option>
                </select>
            </div>
        </form>

        <!-- Tabela de usuários -->
        <div class="shadow overflow-hidden mt-1 rounded border-b border-gray-200">
            <table id="user-table" class="min-w-full flex-wrap bg-white">
                <thead class="bg-gray-800 dark:bg-gray-950 text-white">
                    <tr>
                        <th class="w-1/6 text-left py-3 px-4 uppercase font-semibold text-sm">ID</th>
                        <th class="w-1/6 text-left py-3 px-4 uppercase font-semibold text-sm">Login</th>
                        <th class="w-1/6 text-left py-3 px-4 uppercase font-semibold text-sm">Nome</th>
                        <th class="w-1/6 text-left py-3 px-4 uppercase font-semibold text-sm">CPF</th>
                        <th class="w-1/6 text-left py-3 px-4 uppercase font-semibold text-sm">Último 2FA</th>
                        <th class="w-1/6 text-left py-3 px-4 uppercase font-semibold text-sm">Último Login</th>
                        <th class="text-end py-3 px-4 uppercase font-semibold text-sm">Ação</th>
                    </tr>
                </thead>
                <tbody id="user-table-body" class="text-gray-700">
                    <?php if (!empty($users)): ?>
                        <?php foreach ($users as $user): ?>
                            <tr>
                                <td class="w-1/6 text-left py-3 px-4"><?= htmlspecialchars($user['id']) ?></td>
                                <td class="w-1/6 text-left py-3 px-4"><?= htmlspecialchars($user['login']) ?></td>
                                <td class="w-1/6 text-left py-3 px-4"><?= htmlspecialchars($user['name']) ?></td>
                                <td class="w-1/6 text-left py-3 px-4"><?= htmlspecialchars($user['cpf']) ?></td>
                                <td class="w-1/6 text-left py-3 px-4"><?= htmlspecialchars($user['ultimo_2fa']) ?></td>
                                <td class="w-1/6 text-left py-3 px-4"><?= htmlspecialchars($user['last_login']) ?></td>
                                <td class="w-1/6 text-left py-3 px-4 flex justify-between">
                                    <form method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este usuário?');">
                                        <input type="hidden" name="delete_user_id" value="<?= $user['id'] ?>">
                                        <input type="hidden" name="confirm_delete" value="yes">
                                        <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-700">Excluir</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center py-4">Usuário ou dados não encontrados.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const searchBar = document.getElementById('search-bar');
            const filter = document.getElementById('filter');
            const tableBody = document.getElementById('user-table-body');
            const rows = Array.from(tableBody.getElementsByTagName('tr'));

            // Função para aplicar máscara de CPF
            const applyCPFMask = (value) => {
                value = value.replace(/\D/g, ''); // Remove tudo que não é dígito
                if (value.length > 11) value = value.substring(0, 11); // Limita a 11 dígitos
                return value
                    .replace(/(\d{3})(\d)/, '$1.$2') // Coloca um ponto entre o terceiro e o quarto dígitos
                    .replace(/(\d{3})(\d)/, '$1.$2') // Coloca um ponto entre o sexto e o sétimo dígitos
                    .replace(/(\d{3})(\d{1,2})$/, '$1-$2'); // Coloca um traço entre o nono e o décimo dígitos
            };

            // Função para filtrar a tabela
            const filterTable = () => {
                const query = searchBar.value.toLowerCase();
                const selectedFilter = filter.value;
                let found = false;

                rows.forEach(row => {
                    const cells = row.getElementsByTagName('td');
                    const name = cells[2].textContent.toLowerCase();
                    const cpf = cells[3].textContent.toLowerCase();
                    
                    let match = false;
                    if (selectedFilter === 'todos') {
                        match = true; // Exibe todos os usuários
                    } else if (selectedFilter === 'name') {
                        match = name.includes(query);
                    } else if (selectedFilter === 'cpf') {
                        match = cpf.includes(query);
                    }

                    if (match) {
                        row.style.display = '';
                        found = true;
                    } else {
                        row.style.display = 'none';
                    }
                });

                if (!found) {
                    const noResultsRow = document.createElement('tr');
                    noResultsRow.innerHTML = '<td colspan="7" class="text-center py-4">Usuário ou dados não encontrados.</td>';
                    tableBody.appendChild(noResultsRow);
                } else {
                    const noResultsRow = tableBody.querySelector('tr td[colspan="7"]');
                    if (noResultsRow) {
                        noResultsRow.parentElement.remove();
                    }
                }
            };

            // Event listener para aplicar máscara de CPF
            searchBar.addEventListener('input', () => {
                if (filter.value === 'cpf') {
                    searchBar.value = applyCPFMask(searchBar.value);
                }
                filterTable();
            });

            filter.addEventListener('change', () => {
                if (filter.value !== 'todos') {
                    searchBar.value = ''; // Limpa o campo de busca ao mudar o filtro
                }
                filterTable();
            });

            // Chama a função de filtro ao carregar a página
            filterTable();
        });
    </script>

     <!--Adicionar usuario -->
    <div id="userForm" style="display:none;" class="fixed inset-0 flex items-center justify-center bg-gray-500 bg-opacity-75 overflow-auto">
        <main class="bg-white max-w-lg mx-auto my-32 p-8 md:p-12 rounded-lg shadow-2xl relative">
            <button class="absolute top-0 right-0 m-4 p-2 rounded-full bg-gray-300  border-2 border-black hover:text-black hover:bg-transparent transition duration-300" onclick="hideForm()">
                <svg class="w-6 h-6 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
            <section>
                <h3 class="font-semibold text-2xl font-roboto">Adicione Usuário</h3>
                <p class="text-gray-600 text-lg pt-2 font-roboto font-medium">Preencha o formulário abaixo:</p>
            </section>
            <section class="mt-10">
                <form method="post" class="flex flex-col" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <div class="mb-6 rounded bg-gray-200">
                        <label for="name" class="block text-gray-700 text-sm font-bold mb-2 ml-3">Nome:</label>
                        <input type="text" id="name" name="name" class="bg-gray-200 rounded w-full text-gray-700 focus:outline-none border-b-4 border-gray-300 focus:border-black transition duration-500 px-3 pb-3" required>
                    </div>
                    <div class="mb-6 rounded bg-gray-200">
                        <label for="datanasc" class="block text-gray-700 text-sm font-bold mb-2 ml-3">Data de Nascimento:</label>
                        <input type="date" id="datanasc" name="datanasc" class="bg-gray-200 rounded w-full text-gray-700 focus:outline-none border-b-4 border-gray-300 focus:border-black transition duration-500 px-3 pb-3" required>
                    </div>
                    <div class="mb-6 rounded bg-gray-200">
                        <label for="sexo" class="block text-gray-700 text-sm font-bold mb-2 ml-3">Sexo:</label>
                        <select id="sexo" name="sexo" class="bg-gray-200 rounded w-full text-gray-700 focus:outline-none border-b-4 border-gray-300 focus:border-black transition duration-500 px-3 pb-3" required>
                            <option value="Masculino">Masculino</option>
                            <option value="Feminino">Feminino</option>
                            <option value="Outro">Outro</option>
                        </select>
                    </div>
                    <div class="mb-6 rounded bg-gray-200">
                        <label for="nameM" class="block text-gray-700 text-sm font-bold mb-2 ml-3">Nome Materno:</label>
                        <input type="text" id="nameM" name="nameM" class="bg-gray-200 rounded w-full text-gray-700 focus:outline-none border-b-4 border-gray-300 focus:border-black transition duration-500 px-3 pb-3" required>
                    </div>
                    <div class="mb-6 rounded bg-gray-200">
                        <label for="cpf" class="block text-gray-700 text-sm font-bold mb-2 ml-3">CPF:</label>
                        <input type="text" id="cpf" name="cpf" class="bg-gray-200 rounded w-full text-gray-700 focus:outline-none border-b-4 border-gray-300 focus:border-black transition duration-500 px-3 pb-3" maxlength="14" required>
                    </div>
                    <div class="mb-6 rounded bg-gray-200">
                        <label for="email" class="block text-gray-700 text-sm font-bold mb-2 ml-3">E-mail:</label>
                        <input type="email" id="email" name="email" class="bg-gray-200 rounded w-full text-gray-700 focus:outline-none border-b-4 border-gray-300 focus:border-black transition duration-500 px-3 pb-3" required>
                    </div>
                    <div class="mb-6 rounded bg-gray-200">
                        <label for="telefoneC" class="block text-gray-700 text-sm font-bold mb-2 ml-3">Telefone Celular:</label>
                        <input type="text" id="telefoneC" name="telefoneC" class="bg-gray-200 rounded w-full text-gray-700 focus:outline-none border-b-4 border-gray-300 focus:border-black transition duration-500 px-3 pb-3" maxlength="16" required>
                    </div>
                    <div class="mb-6 rounded bg-gray-200">
                        <label for="telefoneF" class="block text-gray-700 text-sm font-bold mb-2 ml-3">Telefone Fixo:</label>
                        <input type="text" id="telefoneF" name="telefoneF" class="bg-gray-200 rounded w-full text-gray-700 focus:outline-none border-b-4 border-gray-300 focus:border-black transition duration-500 px-3 pb-3" maxlength="16" required>
                    </div>
                    <div class="mb-6 rounded bg-gray-200">
                        <label for="cep" class="block text-gray-700 text-sm font-bold mb-2 ml-3">CEP:</label>
                        <input type="text" id="cep" name="cep" class="bg-gray-200 rounded w-full text-gray-700 focus:outline-none border-b-4 border-gray-300 focus:border-black transition duration-500 px-3 pb-3" maxlength="10" required>
                    </div>
                    <div class="mb-6 rounded bg-gray-200">
                        <label for="endereco" class="block text-gray-700 text-sm font-bold mb-2 ml-3">Endereço:</label>
                        <input type="text" id="endereco" name="endereco" class="bg-gray-200 rounded w-full text-gray-700 focus:outline-none border-b-4 border-gray-300 focus:border-black transition duration-500 px-3 pb-3" required>
                    </div>
                    <div class="mb-6 rounded bg-gray-200">
                        <label for="login" class="block text-gray-700 text-sm font-bold mb-2 ml-3">Login:</label>
                        <input type="text" id="login" name="login" class="bg-gray-200 rounded w-full text-gray-700 focus:outline-none border-b-4 border-gray-300 focus:border-black transition duration-500 px-3 pb-3" maxlength="6" required>
                    </div>
                    <div class="mb-6 rounded bg-gray-200">
                        <label for="password" class="block text-gray-700 text-sm font-bold mb-2 ml-3">Senha:</label>
                        <input type="password" id="password" name="password" class="bg-gray-200 rounded w-full text-gray-700 focus:outline-none border-b-4 border-gray-300 focus:border-black transition duration-500 px-3 pb-3" maxlength="8" required>
                    </div>
                    <div class="mb-6 rounded bg-gray-200">
                        <label for="confirm-password" class="block text-gray-700 text-sm font-bold mb-2 ml-3">Confirme sua senha:</label>
                        <input type="password" id="confirm-password" name="confirm-password" class="bg-gray-200 rounded w-full text-gray-700 focus:outline-none border-b-4 border-gray-300 focus:border-black transition duration-500 px-3 pb-3" maxlength="8" required>
                    </div>
                    <div class="flex flex-col justify-center gap-2">
                        <button type="submit" class="bg-primary w-full hover:bg-black hover:scale-105 hover:transform hover:text-white font-bold font-bebas py-2 rounded shadow-lg hover:shadow-xl transition duration-200">Adicionar Usuário</button>
                        <button type="button" class="bg-green-700 w-full text-white hover:bg-black hover:scale-105 hover:transform hover:text-white font-bold font-bebas py-2 rounded shadow-lg hover:shadow-xl transition duration-200" onclick="hideForm()">Cancelar</button>
                    </div>
                </form>
            </section>
        </main>
    </div>

    <script>
        function showForm() {
            document.getElementById('userForm').style.display = 'flex';
        }

        function hideForm() {
            document.getElementById('userForm').style.display = 'none';
        }
    </script>
    <script>
        function showForm() {
            document.getElementById('userForm').style.display = 'block';
        }
    </script>

    <script src="script.js"></script>
    <!-- footer -->
    <footer class="w-full hidden bottom-0 py-6 mt-2 bg-gray-300 text-black">
        <div class="container px-6 mx-auto space-y-6 divide-y divide-gray-400 md:space-y-12 divide-opacity-50">
            <div class="grid justify-center lg:justify-between">
                <div class="flex flex-col self-center text-sm text-center md:block lg:col-start-1 md:space-x-5">
                    <span>Copy right © 2024 por <em>Dash Sports</em></span>
                    <a rel="noopener noreferrer">
                        <span>Política de Privacidade</span>
                    </a>
                    <a rel="noopener noreferrer">
                        <span>Termos de serviço</span>
                    </a>
                    <a rel="noopener noreferrer" href="shop.php" class="text-blue-950 font-semibold font-roboto hover:text-primary">
                        <span>Catálogo</span>
                    </a>
                    <a rel="noopener noreferrer" href="login.php" class="text-blue-950 font-semibold font-roboto hover:text-primary">
                        <span>Login</span>
                    </a>
                    <a rel="noopener noreferrer" href="cadastro.php" class="text-blue-950 font-semibold font-roboto hover:text-primary">
                        <span>Cadastrar-se</span>
                    </a>
                </div>
                <div class="flex justify-center pt-4 space-x-4 lg:pt-0 lg:col-end-13">
                    <a rel="noopener noreferrer" href="#" title="Email" class="flex items-center justify-center w-10 h-10 rounded-full bg-second hover:bg-black duration-150 text-gray-50">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                        </svg>
                    </a>
                    <a rel="noopener noreferrer" href="#" title="Instagram" class="flex items-center justify-center w-10 h-10 rounded-full bg-second hover:bg-black duration-150 text-gray-50">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M12 18C15.3137 18 18 15.3137 18 12C18 8.68629 15.3137 6 12 6C8.68629 6 6 8.68629 6 12C6 15.3137 8.68629 18 12 18ZM12 16C14.2091 16 16 14.2091 16 12C16 9.79086 14.2091 8 12 8C9.79086 8 8 9.79086 8 12C8 14.2091 9.79086 16 12 16Z" fill="#fff"/>
                            <path d="M18 5C17.4477 5 17 5.44772 17 6C17 6.55228 17.4477 7 18 7C18.5523 7 19 6.55228 19 6C19 5.44772 18.5523 5 18 5Z" fill="#fff"/>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M1.65396 4.27606C1 5.55953 1 7.23969 1 10.6V13.4C1 16.7603 1 18.4405 1.65396 19.7239C2.2292 20.8529 3.14708 21.7708 4.27606 22.346C5.55953 23 7.23969 23 10.6 23H13.4C16.7603 23 18.4405 23 19.7239 22.346C20.8529 21.7708 21.7708 20.8529 22.346 19.7239C23 18.4405 23 16.7603 23 13.4V10.6C23 7.23969 23 5.55953 22.346 4.27606C21.7708 3.14708 20.8529 2.2292 19.7239 1.65396C18.4405 1 16.7603 1 13.4 1H10.6C7.23969 1 5.55953 1 4.27606 1.65396C3.14708 2.2292 2.2292 3.14708 1.65396 4.27606ZM13.4 3H10.6C8.88684 3 7.72225 3.00156 6.82208 3.0751C5.94524 3.14674 5.49684 3.27659 5.18404 3.43597C4.43139 3.81947 3.81947 4.43139 3.43597 5.18404C3.27659 5.49684 3.14674 5.94524 3.0751 6.82208C3.00156 7.72225 3 8.88684 3 10.6V13.4C3 15.1132 3.00156 16.2777 3.0751 17.1779C3.14674 18.0548 3.27659 18.5032 3.43597 18.816C3.81947 19.5686 4.43139 20.1805 5.18404 20.564C5.49684 20.7234 5.94524 20.8533 6.82208 20.9249C7.72225 20.9984 8.88684 21 10.6 21H13.4C15.1132 21 16.2777 20.9984 17.1779 20.9249C18.0548 20.8533 18.5032 20.7234 18.816 20.564C19.5686 20.1805 20.1805 19.5686 20.564 18.816C20.7234 18.5032 20.8533 18.0548 20.9249 17.1779C20.9984 16.2777 21 15.1132 21 13.4V10.6C21 8.88684 20.9984 7.72225 20.9249 6.82208C20.8533 5.94524 20.7234 5.49684 20.564 5.18404C20.1805 4.43139 19.5686 3.81947 18.816 3.43597C18.5032 3.27659 18.0548 3.14674 17.1779 3.0751C16.2777 3.00156 15.1132 3 13.4 3Z" fill="#fff"/>
                            </svg>
                    </a>
                    <a rel="noopener noreferrer" href="#" title="Facebook" class="flex items-center justify-center w-10 h-10 rounded-full bg-second hover:bg-black duration-150 text-gray-50">
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
