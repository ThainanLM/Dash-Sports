<?php

include 'connection.php';

// Verificar se a sessão está iniciada e se o usuário está logado
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    // Consultar o banco de dados para obter o nome do usuário
    $query = "SELECT name, login, user_type FROM users WHERE id = ?";
    $stmt = $db->prepare($query);
    $stmt->execute([$user_id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verificar se encontrou o usuário
    if ($user) {
        $userStatus = [
            'isLoggedIn' => true,
            'login' => $user['login']
        ];

        // Verificação se o usuário é admin
        $user_type = $user['user_type'];
        $showManageLink = ($user_type === 'admin');
    } else {
        $userStatus = ['isLoggedIn' => false];
        $showManageLink = false;
    }
} else {
    $userStatus = ['isLoggedIn' => false];
    $showManageLink = false;
}
?>

<!-- Header Navbar -->
<nav class="fixed top-0 left-0 z-20 w-full dark:bg-primary bg-white py-2 px-6 sm:px-4 shadow-md">
    <div class="container mx-auto flex max-w-6xl flex-wrap items-center justify-between">
        <a href="#" class="flex items-center">
            <img src="assets/homeimg/dash logo preto.png" class="max-w-24">
        </a>
        <!-- Hamburger Menu Icon -->
        <div class="p-4 md:hidden sm:block rounded-lg hover:bg-primary">
            <button id="hamburgerMenu" class="text-3xl">
                <i class="fas fa-bars"></i>
            </button>
        </div>

        <!-- Side Menu -->
        <div id="sideMenu" class="bg-white dark:bg-gray-900 fixed inset-y-0 left-0 w-64 shadow-lg transform -translate-x-full transition-transform duration-300">
            <div class="p-4 border-b">
                <button id="closeMenu" class="text-2xl">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <nav class="p-4 font-roboto">
                <a href="index.php" class="block py-2 text-gray-800 hover:bg-primary">Home</a>
                <a href="shop.php" class="block py-2 text-gray-800 hover:bg-primary">Catálogo</a>
                <a href="login.php" class="block py-2 text-gray-800 hover:bg-primary">Login</a>
                <a href="cadastro.php" class="block py-2 text-gray-800 hover:bg-primary">Criar Conta</a>
                <div class="flex items-center py-2">
                    <i class="fas fa-moon mr-2" name="darkMode"></i>
                    <span class="text-gray-800">Modo Escuro</span>
                </div>
                <button class="mt-4 px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">Sair</button>
            </nav>
        </div>

        <div class="mt-2 sm:mt-0 sm:flex hidden md:block md:order-2 justify-center items-center text-start">
            <!-- Login Button -->
            <div class="flex item-center justify-center space-x-8">
                <div class="relative">
                    <a href="#" id="userIcon" class="text-center text-black hover:text-primary dark:hover:text-white transition relative">
                        <div class="text-lg space-x-1">
                            <i class="far fa-user text-2xl"></i>
                            <?php if ($userStatus['isLoggedIn']) : ?>
                                olá, <?= htmlspecialchars($userStatus['login']); ?>
                            <?php endif; ?>
                        </div>
                    </a>
                    
                    <!-- Dropdown Menu -->
                    <div id="dropdownMenu" class="hidden absolute justify-center items-center right-0 mt-2 w-48 bg-white border rounded shadow-lg">
                        <a href="error.php" class="block px-4 py-2 text-gray-800 hover:bg-primary transition font-semibold font-bebas">Perfil</a>
                        <a href="logout.php" class="block px-4 py-2 text-gray-800 hover:text-white hover:bg-gray-800 transition font-semibold font-bebas">Sair</a>
                    </div>
                </div>

                <a class="text-center text-black hover:text-primary dark:hover:text-white transition relative">
                    <div id="darkModeToggle"  class="text-2xl">
                        <i class="fa-solid fa-circle-half-stroke" name="darkMode"></i>
                    </div>
                </a>
            </div>
        </div>
        <script>
        document.addEventListener('DOMContentLoaded', () => {
            const toggle = document.getElementById('darkModeToggle');

            // Verificar se o modo escuro está ativado
            const currentTheme = localStorage.getItem('theme');
            if (currentTheme === 'dark') {
                document.documentElement.classList.add('dark');
            }

            toggle.addEventListener('click', () => {
                // Alternar o modo escuro
                document.documentElement.classList.toggle('dark');
                
                // Atualizar a preferência do usuário no localStorage
                if (document.documentElement.classList.contains('dark')) {
                    localStorage.setItem('theme', 'dark');
                } else {
                    localStorage.setItem('theme', 'light');
                }
            });
            
        });
    </script>

        <div class="hidden w-full items-center justify-between  md:flex md:w-auto" id="navbar-sticky">
            <ul class="mt-4 flex flex-col rounded-lg  p-4 md:mt-0 md:flex-row md:space-x-8 md:text-xl md:font-medium font-bebas">
                <li>
                    <a href="index.php" class="block rounded py-2 pl-3 pr-4 text-gray-700 dark:text-gray-950 md:bg-transparent md:p-0 focus:font-semibold hover:text-primary dark:hover:text-white" aria-current="page">Home</a>
                </li>
                <li>
                    <a href="shop.php" class="block rounded py-2 pl-3 pr-4 text-gray-700 dark:text-gray-950 md:p-0 md:hover:bg-transparent hover:text-primary dark:hover:text-white">Catálogo</a>
                </li>
                <?php if ($showManageLink) : ?>
                <li>
                    <a href="dashboard.php" class="block rounded py-2 pl-3 pr-4 text-gray-700 dark:text-gray-950 md:p-0 md:hover:bg-transparent hover:text-primary dark:hover:text-white">Gerenciar</a>
                </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

