<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="output.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <title>Dash-Catálogo</title>
</head>
      <!-- component -->
<!-- Create By Joker Banny -->
<body class="bg-gray-100 dark:bg-gray-800">
    <!-- Header Navbar -->
    <?php include 'header.php'; ?>
    
  <style>
    .juice {
        background-image: url('https://i.pinimg.com/564x/c9/27/50/c92750f2f2d3e07681394265f9374ef2.jpg');
    }

    .juice2 {
      background-image: url('https://i.pinimg.com/564x/19/d2/52/19d252c17f15abf7e9ad96476526003d.jpg');
    }
 
    .juice3 {
      z-index: 10;
      position: relative;
      opacity: 1;
    }
 
    .juice3::after {
      content: '';
      position: absolute;
      z-index: -999;
      background-size: cover;
      top: 0;
      right: 0;
      bottom: 0;
      left: 0;
      background-image: url('https://media.istockphoto.com/id/1663505164/pt/foto/athletic-man-running-training-on-stadium-running-growing-speed-and-endurance-contemporary-art.jpg?s=612x612&w=0&k=20&c=Vn0itkzOql4cZX8NXr5lX6T9CXwwm68E8PwJ4FtvHlw=');
    }
  </style>

  <section class="juice3  bg-opacity-90 py-14 max-w-auto">
    <div class="container  px-4 flex flex-col lg:flex-row">
      <!-- left -->
      <div class="juice relative lg:w-2/3 rounded-xl mt-16 bg-secondary-lite bg-cover p-8 md:p-16 hover:shadow-xl hover:transform hover:scale-105 duration-300">
        <p class="max-w-md  text-white text-3xl md:text-5xl font-semibold font-bebas "><em>EM BREVE</em></p>
        <p class="max-w-md md:text-3xl  pr-10 text-white font-semibold mt-20">The North Face<em><br>Nova Coleção</em></p>
        <a>
        <button class="mt-5 items-center border border-y-2 border-x-2 border-primary font-bold px-8 py-2 rounded hover:bg-transparent text-primary">Em Breve em Julho</button>
        </a>
      </div>
      <!-- right -->
      <div class="juice2 mt-16  lg:ml-6  rounded-xl bg-primary-lite bg-cover p-8 md:p-16 hover:shadow-xl hover:transform hover:scale-105 duration-300">
        <div class="max-w-sm">
          <p class="text-3xl text-amber-300 md:text-5xl text-justify  font-bold font-bebas uppercase"><em>Em Agosto</em></p>
          <p class="mt-8 text-xl md:text-3xl text-primary font-semibold font-roboto"> Mafate Speed 4</p>
          <button class="mt-14 items-center border border-y-2 border-white font-bold px-8 py-2 rounded bg-transparent text-white uppercase">15% OFF</button>
        </div>
      </div>
    </div>
  </section>
  
  <!-- Product List -->
  <section class="backlist py-10 bg-gray-100 dark:bg-gray-800">
    <div class="mx-auto grid max-w-5xl  grid-cols-1 gap-6 p-6  sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
      <article class="rounded-xl bg-white dark:bg-gray-950 p-3 shadow-lg hover:shadow-xl hover:transform hover:scale-105 duration-300 ">
        <a href="#">
          <div class="relative flex items-end overflow-hidden rounded-xl">
            <img src="assets/produtos/Kimono jiu-jitsu.jpg" >
          </div>
  
          <div class="mt-1 p-2">
            <h2 class="text-slate-700 dark:text-white">Kimono-Black</h2>
            <p class="mt-1 text-sm line-through text-slate-400">
              R$129,90
            </p>
  
            <div class="mt-3 flex items-end justify-between">
                <p class="text-lg font-bold text-second">R$105,90</p>
     
  
              <div class="flex items-center space-x-1.5 rounded-lg bg-second px-3 py-1.5 text-white duration-100 hover:bg-green-700">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-4 w-4">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                </svg>
  
                <button class="text-sm">Comprar</button>
              </div>
            </div>
          </div>
        </a>
      </article>
      <article class="rounded-xl bg-white dark:bg-gray-950 p-3 shadow-lg hover:shadow-xl hover:transform hover:scale-105 duration-300 ">
        <a href="#">
          <div class="relative flex items-end overflow-hidden rounded-xl">
            <img src="assets/produtos/oculos de sol esportivo.jpg" >
          </div>
  
          <div class="mt-1 p-2">
            <h2 class="text-slate-700 dark:text-white">Óculos OAKLEY</h2>
            <p class="mt-1 text-sm line-through text-slate-400">
              R$89,90
            </p>
  
            <div class="mt-3 flex items-end justify-between">
                <p class="text-lg font-bold text-second">R$75,90</p>
     
  
              <div class="flex items-center space-x-1.5 rounded-lg bg-second px-4 py-1.5 text-white duration-100 hover:bg-green-700">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-4 w-4">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                </svg>
  
                <button class="text-sm">Comprar</button>
              </div>
            </div>
          </div>
        </a>
      </article>
      <article class="rounded-xl bg-white dark:bg-gray-950 p-3 shadow-lg hover:shadow-xl hover:transform hover:scale-105 duration-300 ">
        <a href="#">
          <div class="relative flex items-end overflow-hidden rounded-xl">
            <img src="assets/produtos/tenis basquete.jpg" >
          </div>
  
          <div class="mt-1 p-2">
            <h2 class="text-slate-700 dark:text-white">Nike Giannis Immortality</h2>
            <p class="mt-1 text-sm line-through text-slate-400">
              R$579,90
            </p>
  
            <div class="mt-3 flex items-end justify-between">
                <p class="text-lg font-bold text-second">R$485,90</p>
     
  
              <div class="flex items-center space-x-1.5 rounded-lg bg-second px-3 py-1.5 text-white duration-100 hover:bg-green-700">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-4 w-4">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                </svg>
  
                <button class="text-sm">Comprar</button>
              </div>
            </div>
          </div>
        </a>
      </article>
      <article class="rounded-xl bg-white dark:bg-gray-950 p-3 shadow-lg hover:shadow-xl hover:transform hover:scale-105 duration-300 ">
        <a href="#">
          <div class="relative flex items-end overflow-hidden rounded-xl">
            <img src="assets/produtos/nike chuteira.jpg" >
          </div>
  
          <div class="mt-1 p-2">
            <h2 class="text-slate-700 dark:text-white">Nike Hypervenom 3</h2>
            <p class="mt-1 text-sm line-through text-slate-400">
              R$409,90
            </p>
  
            <div class="mt-3 flex items-end justify-between">
                <p class="text-lg font-bold text-second">R$379,90</p>
     
  
              <div class="flex items-center space-x-1.5 rounded-lg bg-second px-3 py-1.5 text-white duration-100 hover:bg-green-700">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-4 w-4">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                </svg>
  
                <button class="text-sm">Comprar</button>
              </div>
            </div>
          </div>
        </a>
      </article>
      <article class="rounded-xl bg-white dark:bg-gray-950 p-3 shadow-lg hover:shadow-xl hover:transform hover:scale-105 duration-300 ">
        <a href="#">
          <div class="relative flex items-end overflow-hidden rounded-xl">
            <img src="assets/produtos/luva boxe.jpg" >
          </div>
  
          <div class="mt-1 p-2">
            <h2 class="text-slate-700 dark:text-white">Luva Everlast</h2>
            <p class="mt-1 text-sm line-through text-slate-400">
              R$99,90
            </p>
  
            <div class="mt-3 flex items-end justify-between">
                <p class="text-lg font-bold text-second">R$85,90</p>
     
  
              <div class="flex items-center space-x-1.5 rounded-lg bg-second px-3 py-1.5 text-white duration-100 hover:bg-green-700">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-4 w-4">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                </svg>
  
                <button class="text-sm">Comprar</button>
              </div>
            </div>
          </div>
        </a>
      </article>
      <article class="rounded-xl bg-white dark:bg-gray-950 p-3 shadow-lg hover:shadow-xl hover:transform hover:scale-105 duration-300 ">
        <a href="#">
          <div class="relative flex items-end overflow-hidden rounded-xl">
            <img src="assets/produtos/Bola adidas.jpg" >
          </div>
  
          <div class="mt-1 p-2">
            <h2 class="text-slate-700 dark:text-white">Bola Adidas Academy</h2>
            <p class="mt-1 text-sm line-through text-slate-400">
              R$269,90
            </p>
  
            <div class="mt-3 flex items-end justify-between">
                <p class="text-lg font-bold text-second">R$239,90</p>
     
  
              <div class="flex items-center space-x-1.5 rounded-lg bg-second px-3 py-1.5 text-white duration-100 hover:bg-green-700">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-4 w-4">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                </svg>
  
                <button class="text-sm">Comprar</button>
              </div>
            </div>
          </div>
        </a>
      </article>
      <article class="rounded-xl bg-white dark:bg-gray-950 p-3 shadow-lg hover:shadow-xl hover:transform hover:scale-105 duration-300 ">
        <a href="#">
          <div class="relative flex items-end overflow-hidden rounded-xl">
            <img src="assets/produtos/Tênis de corrida.jpg" >
          </div>
  
          <div class="mt-1 p-2">
            <h2 class="text-slate-700 dark:text-white">Puma Electrify Nitro</h2>
            <p class="mt-1 text-sm line-through text-slate-400">
              R$559,90
            </p>
  
            <div class="mt-3 flex items-end justify-between">
                <p class="text-lg font-bold text-second">R$519,90</p>
     
  
              <div class="flex items-center space-x-1.5 rounded-lg bg-second px-3 py-1.5 text-white duration-100 hover:bg-green-700">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-4 w-4">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                </svg>
  
                <button class="text-sm">Comprar</button>
              </div>
            </div>
          </div>
        </a>
      </article>
      <article class="rounded-xl bg-white dark:bg-gray-950 p-3 shadow-lg hover:shadow-xl hover:transform hover:scale-105 duration-300 ">
        <a href="#">
          <div class="relative flex items-end overflow-hidden rounded-xl">
            <img src="assets/produtos/camisa.jpg" >
          </div>
  
          <div class="mt-1 p-2">
            <h2 class="text-slate-700 dark:text-white">Camisa Adidas</h2>
            <p class="mt-1 text-sm line-through text-slate-400">
              R$75,90
            </p>
  
            <div class="mt-3 flex items-end justify-between">
                <p class="text-lg font-bold text-second">R$63,90</p>
     
  
              <div class="flex items-center space-x-1.5 rounded-lg bg-second px-3 py-1.5 text-white duration-100 hover:bg-green-700">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-4 w-4">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                </svg>
  
                <button class="text-sm">Comprar</button>
              </div>
            </div>
          </div>
        </a>
      </article>
  
      
  </section>
  
  <!-- Footer -->
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
    <script src="script.js"></script>
</body>
</html>       