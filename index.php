<?php 

    include 'connection.php';
    session_start();

     // adding product in cart
     if (isset($_POST['add_to_cart'])) {
        $product_id = $_POST['product_id'];
        $product_name = $_POST['product_name'];
        $product_price = $_POST['product_price'];
        $product_image = $_POST['product_image'];
        $product_quantity = $_POST['product_quantity'];
        
        $cart_number = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');
        if (mysqli_num_rows($cart_number)>0) {
            $message[] = 'product already exist in cart';
        }else {
            mysqli_query($conn, "INSERT INTO `cart`(`user_id`,`pid`,`name`,`price`,`quantity`,`image`) VALUES('$user_id','$product_id','$product_name','$product_price','$product_quantity','$product_image')");
            $message[] = 'product successfuly added in your cart';
        }
    }
?>
<!DOCTYPE html>
<html  <meta charset="UTF-8">
<head> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="output.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="home.css">
    <script>
    if (typeof window.history.pushState == 'function') {
      window.history.pushState({}, "Hide", '<?php echo $_SERVER['PHP_SELF']; ?>');
    }
  </script>
   <style>
        .modal-enter {
            opacity: 0;
            transform: translateY(-10%);
        }

        .modal-enter-active {
            opacity: 1;
            transform: translateY(0);
            transition: opacity 0.3s ease, transform 0.3s ease;
        }

        .modal-leave {
            opacity: 1;
            transform: translateY(0);
        }

        .modal-leave-active {
            opacity: 0;
            transform: translateY(-10%);
            transition: opacity 0.3s ease, transform 0.3s ease;
        }

        .modal-backdrop {
            background: rgba(0, 0, 0, 0.5);
        }
    </style>
    <title>Dash-Home</title>
</head>
<body class="relative bg-gray-100 dark:bg-gray-800  font-inter antialiased">

     <?php include 'header.php'?>

        <!-- Banner Home -->
        <style>
          .juice {
              background-image: url('https://images.pexels.com/photos/7005491/pexels-photo-7005491.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1');
          }
      
          .juice2 {
            background-image: url('https://i.pinimg.com/564x/f1/da/2e/f1da2e8c01b79c81aa61421bd9999e68.jpg');
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
            background-image: url('https://i.pinimg.com/236x/a0/fa/59/a0fa59adfcae3328019c3c45c05794c4.jpg');
          }
        </style>
      
        <section class="juice3 h-auto bg-gray-100 bg-opacity-90 py-14 max-w-auto">
          <div class="container  px-4 flex flex-col lg:flex-row">
            <!-- left -->
            <div class="juice relative lg:w-2/3 rounded-xl mt-16 bg-secondary-lite bg-cover p-8 md:p-16 hover:shadow-xl hover:transform hover:scale-105 duration-300">
              <p class="max-w-md  text-primary text-3xl md:text-5xl font-semibold font-bebas "><em>Vem pra Dash</em></p>
              <p class="max-w-md text-xl md:text-3xl  pr-10 text-white font-semibold mt-20">Registre-se e entre<br> para <em>Dash Sports</em></p>
              <a href="cadastro.php">
              <button class="mt-5 items-center bg-primary border border-y-2 border-x-2 border-primary font-bold px-8 py-2 rounded hover:scale-105 hover:bg-transparent hover:text-primary">Entrar</button>
              </a>
            </div>
            <!-- right -->
            <div class="juice2 mt-16 items-center justify-center  lg:ml-6  rounded-xl bg-primary-lite bg-cover p-8 md:p-16 hover:shadow-xl hover:transform hover:scale-105 duration-300">
              <div class="max-w-sm items-center justify-center ">
                <p class="text-3xl md:text-5xl text-orange-400 font-bold font-bebas uppercase"><em>20% off</em></p>
                <p class="mt-8 text-xl md:text-3xl text-white font-semibold font-roboto">Nike Hypervenom 3</p>
                <button class="mt-14 items-center bg-white border border-y-2 border-white font-bold px-8 py-2 rounded hover:scale-105 hover:bg-transparent hover:text-white">Comprar Agora</button>
              </div>
            </div>
          </div>
        </section>
        <!-- fim banner -->

    <!-- Produtos recentes -->
    <section class="py-10 bg-gray-100 dark:bg-gray-800 sm:mx-1">
        
      <div class="flex justify-between sm:items-center  font-bold font-bebas">
        <h2 class="leading-7  md:ml-36 dark:text-white uppercase">Mais Recentes</h2>
        <a href="shop.php" class="ml-10 flex font-bebas text-primary ">
          <span class="text-lg md:mr-36 hover:underline-offset-1 border-2 border-primary px-2 py-1 rounded-lg hover:scale-105">Ver Mais ></span>
        </a>
      </div>  
      
        <div class="mx-auto grid max-w-5xl  grid-cols-1 gap-6 p-6  sm:grid-cols-2 md:grid-cols-4 ">

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
                    <p class="text-lg font-bold font-roboto  text-second">R$135,90</p>
         
      
                  <div class="flex items-center space-x-1.5 rounded-lg bg-second px-3 py-1.5 text-white duration-100 hover:bg-green-700">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-4 w-4">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                    </svg>
      
                    <button class="font-roboto text-sm">Comprar</button>
                  </div>
                </div>
              </div>
            </a>
          </article>
          <article class="rounded-xl bg-white dark:bg-gray-950  p-3 shadow-lg hover:shadow-xl hover:transform hover:scale-105 duration-300 ">
            <a href="#">
              <div class="relative flex items-end overflow-hidden rounded-xl">
                <img src="assets/produtos/oculos de sol esportivo.jpg" >
              </div>
      
              <div class="mt-1 p-2">
                <h2 class="text-slate-700 dark:text-white">Óculos OAKLEY</h2>
                <p class="mt-1 text-sm line-through text-slate-400">
                  $89,90
                </p>
      
                <div class="mt-3 flex items-end justify-between">
                    <p class="text-lg font-bold text-second">R$75,90</p>
         
      
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
          <article class="rounded-xl bg-white dark:bg-gray-950  p-3 shadow-lg hover:shadow-xl hover:transform hover:scale-105 duration-300 ">
            <a href="#">
              <div class="relative flex items-end overflow-hidden rounded-xl">
                <img src="assets/produtos/tenis basquete.jpg" >
              </div>
      
              <div class="mt-1 p-2">
                <h2 class="text-slate-700 dark:text-white">Nike Giannis Immortality</h2>
                <p class="mt-1 text-sm line-through text-slate-400">
                  $579,90
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
          <article class="rounded-xl bg-white dark:bg-gray-950  p-3 shadow-lg hover:shadow-xl hover:transform hover:scale-105 duration-300 ">
            <a href="#">
              <div class="relative flex items-end overflow-hidden rounded-xl">
                <img src="assets/produtos/luva boxe.jpg" >
              </div>
      
              <div class="mt-1 p-2">
                <h2 class="text-slate-700 dark:text-white">Luva Everlast</h2>
                <p class="mt-1 text-sm line-through text-slate-400">
                  $99,90
                </p>
      
                <div class="mt-3 flex items-end justify-between">
                    <p class="text-lg font-bold text-second">R$85,90</p>
         
      
                  <div class="flex items-center space-x-1.5 rounded-lg bg-second px-3 py-1.5 text-white duration-100 hover:bg-green-700">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-4 w-4">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                    </svg>
      
                    <button class="text-sm" onclick="openModal()">Comprar</button>
                  </div>
                </div>
              </div>
            </a>
          </article>
        </div>
    </section>
  <!-- Modal -->
    <div  class="modal fixed z-10 inset-0 overflow-y-auto hidden">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity modal-backdrop"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>
            <div class="modal-enter modal-leave inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6">
                <div class="sm:flex sm:items-start">
                    <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-green-100 sm:mx-0 sm:h-10 sm:w-10">
                        <svg class="h-6 w-6 text-green-600" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">
                            Deseja Efetuar a compra?
                        </h3>
                        <div class="mt-2">
                            <p class="text-sm leading-5 text-gray-500">
                                Ao clicar em Aceitar você entende que está de acordo com o pagamento de tal produto
                            </p>
                        </div>
                    </div>
                </div>
                <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                    <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                        <button id="confirm-btn" type="button"
                            class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                            Aceitar
                        </button>
                    </span>
                    <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
                        <button id="cancel-btn" type="button"
                            class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                            Cancelar
                        </button>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openModal() {
            const modal = document.getElementById('modal');
            modal.classList.remove('hidden');
            modal.querySelector('.modal-enter').classList.add('modal-enter-active');
            document.body.classList.add('overflow-hidden');
        }

        function closeModal() {
            const modal = document.getElementById('modal');
            modal.querySelector('.modal-enter').classList.remove('modal-enter-active');
            modal.querySelector('.modal-leave').classList.add('modal-leave-active');
            setTimeout(() => {
                modal.classList.add('hidden');
                modal.querySelector('.modal-leave').classList.remove('modal-leave-active');
                document.body.classList.remove('overflow-hidden');
            }, 300);
        }

        document.getElementById('confirm-btn').addEventListener('click', function() {
            alert('Compra Efetuada com sucesso!');
            closeModal();
        });

        document.getElementById('cancel-btn').addEventListener('click', closeModal);

        // Fecha o modal ao clicar fora dele
        window.onclick = function(event) {
            if (event.target == document.getElementById('modal')) {
                closeModal();
            }
        }

        // Fecha o modal ao pressionar a tecla Esc
        window.onkeydown = function(event) {
            if (event.key === 'Escape') {
                closeModal();
            }
        }
    </script>
    <!-- Em breve  -->
    <style>
      .banner {
        background-image: url('https://i.pinimg.com/564x/7d/2c/70/7d2c70d836a8e0ca3710a21ed3d8dcb2.jpg');
      opacity: 2;  
      }
  
      .banner2 {
        background-image: url('https://media.istockphoto.com/id/1446438866/photo/happy-couple-snowboarders-having-fun.jpg?b=1&s=612x612&w=0&k=20&c=g8gTI2kUdXgNyBjvEkGUlVBvwaxOd_ycnRmdgkDEojc=');
      }

      .banner3 {
        background-image: url('https://assets.goal.com/v3/assets/bltcc7a7ffd2fbf71f5/blt24b90016bd8cdecd/63ff205b4517392d30fabe25/adidas-90s-icons-collection.png?auto=webp&format=pjpg&width=3840&quality=60');
      }

      .banner4 {
        background-image: url('https://i.pinimg.com/564x/c1/28/b3/c128b3f802edbb9fec752a3f263c8d47.jpg');
      }
    </style>

    <p class="font-semibold font-bebas leading-7 text-center uppercase text-dark-grey-600 dark:text-gray-100">Proximas Novidades</p>
    <div class="container  px-4 md:mb-2 flex flex-col lg:flex-row">
      <!-- right -->
      <div class="banner mt-16  rounded-xl bg-primary-lite bg-cover p-8 md:p-16 shadow-lg hover:shadow-xl hover:transform text-center hover:scale-105 duration-300">
        <div class="max-w-sm">
          <p class="text-3xl md:text-5xl text-black font-bold font-bebas uppercase"><em> X Crazyfast Elite+ FG</em></p>
          <p class="mt-8 text-xl md:text-3xl  text-white font-semibold font-roboto">EM BREVE</p>
        </div>
      </div>
      <!-- left -->
      <div class="banner2 relative lg:ml-6 lg:w-2/3 rounded-xl mt-2 md:mt-16 bg-cover p-8 md:p-16 shadow-lg  hover:shadow-xl hover:transform hover:scale-105 duration-300">
        <p class="max-w-sm  text-white text-3xl md:text-5xl font-semibold font-bebas "><em>Coleção Winter Sports</em></p>
        <p class="max-w-md md:text-2xl pr-10 text-white font-semibold mt-20">A</p>
      </div>
    </div>
    <div class="container px-4 mb-2 flex flex-col lg:flex-row">
      <!-- left -->
      <div class="banner3 relative lg:mr-6 lg:w-2/3 rounded-xl mt-2 bg-cover p-8 md:p-16 shadow-lg  hover:shadow-xl hover:transform hover:scale-105 duration-300">
        <p class="text-white items-center gap-5 text-xl text-center md:text-5xl font-semibold font-bebas "><em>Adidas Icon Collection</em></p>
        <p class="max-w-md md:text-2xl  pr-10 text-white font-semibold mt-20"></p>
      </div>
      <!-- right -->
      <div class="banner4 mt-2  rounded-xl bg-primary-lite bg-cover p-8 md:p-16 hover:shadow-xl shadow-lg  hover:transform hover:scale-105 duration-300">
        <div class="max-w-sm">
          <p class="text-3xl md:text-5xl mt-16 text-transparent font-bold font-bebas uppercase"><em>Em Breve</em></p>
          <p class="mt-4 text-2xl md:text-5xl text-center text-black font-semibold font-roboto">SPORTS OAKLEY</p>
        </div>
      </div>
    </div>
    
    <!-- Marcas -->
    <div class="flex flex-col  bg-gray-100 dark:bg-gray-800 transform  rounded-lg">
<div class="container flex flex-col items-center gap-8 mx-auto my-32">
<p class="font-semibold font-bebas leading-7 text-center uppercase text-dark-grey-600 dark:text-gray-100">Empresas Parceiras</p>
<div class="flex flex-wrap items-center justify-center w-full gap-6 lg:gap-0 lg:flex-nowrap lg:justify-between">
  <span>
    <svg xmlns="http://www.w3.org/2000/svg" width="155" height="65" viewBox="0 0 184 65" fill="none">
      <path d="M20.2765 64.8827C14.7995 64.6671 10.3185 63.1822 6.81467 60.4243C6.14599 59.8975 4.55259 58.3178 4.01802 57.6515C2.59718 55.8814 1.6312 54.1586 0.986896 52.2472C-0.995712 46.3634 0.0246651 38.6425 3.90547 30.1689C7.22826 22.9145 12.3555 15.7196 21.3007 5.75465C22.6183 4.28833 26.5423 0 26.5676 0C26.577 0 26.3631 0.367039 26.094 0.813998C23.7681 4.67396 21.778 9.22062 20.6939 13.1568C18.9523 19.4727 19.1624 24.8928 21.3091 29.0957C22.79 31.9911 25.3287 34.4991 28.1835 35.8855C33.1813 38.3117 40.4984 38.5124 49.4342 36.4728C50.0494 36.3315 80.535 28.3133 117.18 18.6541C153.826 8.99389 183.814 1.09648 183.818 1.10298C183.828 1.11136 98.6805 37.2115 54.4788 55.9399C47.4788 58.905 45.6068 59.654 42.3159 60.7988C33.9034 63.7258 26.3678 65.1224 20.2765 64.8827Z" fill="#000000"/>
    </svg>
  </span>
  <span>
    <svg xmlns="http://www.w3.org/2000/svg" width="150" height="150" viewBox="0 0 24 24" fill="none">
      <path d="M1.32952 19L0.731445 17.9641L5.06157 15.4641L7.10302 19H1.32952Z" fill="#000000"/>
      <path d="M15.1859 19H9.41243L5.79362 12.7321L10.1237 10.2321L15.1859 19Z" fill="#000000"/>
      <path d="M23.2688 19H17.4953L10.8558 7.5L15.1859 5L23.2688 19Z" fill="#000000"/>
    </svg>
  </span>
  <span>
    <svg xmlns="http://www.w3.org/2000/svg" width="200" height="250" viewBox="0 0 192.744 192.744"><g fill-rule="evenodd" clip-rule="evenodd"><path fill="#fff" fill-opacity="0" d="M0 0h192.744v192.744H0V0z"/><path d="M119.305 64.872v-3.816h-15.266v20.952h15.266v-3.456h-11.018v-5.688h9.649V69.12h-9.649v-4.248h11.018zM115.057 84.168v8.064h-8.354v-8.064h-4.318v20.881h4.318v-9.361h8.354v9.361h4.248V84.168h-4.248zM119.305 110.951v-3.742h-15.266v21.238h15.266v-3.814h-11.018v-5.617h9.649v-3.455h-9.649v-4.61h11.018zM101.592 61.056h-4.248v8.064h-8.352v-8.064h-4.248v20.952h4.248v-9.36h8.352v9.36h4.248V61.056zM66.456 61.056v3.816h6.48v17.136h4.248V64.872h6.48v-3.816H66.456zM53.064 83.592c-6.696 0-10.224 3.816-10.224 11.016 0 7.56 3.528 11.304 10.224 11.304s10.152-3.744 10.152-11.304c0-7.2-3.456-11.016-10.152-11.016zm-5.616 11.016c0-4.824 1.872-7.2 5.616-7.2 4.032 0 5.904 2.376 5.904 7.2 0 5.113-1.872 7.56-5.904 7.56-3.744 0-5.616-2.447-5.616-7.56zM36.72 84.168v14.76l-8.352-14.76h-4.536v20.881h4.032V90.36l8.568 14.689h4.536V84.168H36.72zM56.52 115.848v-4.897h10.728v-3.742H52.272v21.238h4.248v-8.855h9.432v-3.744H56.52zM100.801 87.912v-3.744H83.664v3.744h6.408v17.137h4.32V87.912h6.409zM74.232 97.057c1.368 0 2.448.215 2.952.791l.792 7.201H82.8v-.504c-.504-.289-.792-1.584-.792-4.033 0-2.951-1.08-4.536-2.664-5.328 2.16-.864 3.24-2.448 3.24-5.112 0-3.744-2.16-5.904-6.696-5.904H65.376v20.881h4.32v-7.992h4.536zm-4.536-3.529v-5.616h5.328c2.16 0 3.24.792 3.24 2.664s-1.08 2.952-3.456 2.952h-5.112zM77.184 107.209h-5.112l-7.488 21.238h4.536l1.656-4.607h7.776l1.296 4.607h4.608l-7.272-21.238zm-2.664 4.822l2.664 8.354h-5.328l2.664-8.354zM98.137 114.191h4.248c-.217-1.871-.793-3.455-2.09-4.824-1.871-1.584-4.031-2.664-6.983-2.664s-5.112 1.08-6.984 2.953c-1.584 1.871-2.664 4.535-2.664 8.064 0 7.488 3.168 11.23 9.36 11.23 5.4 0 8.351-2.664 9.361-7.775h-4.248c-.576 2.447-2.449 3.744-4.825 3.744-3.528 0-5.112-2.375-5.112-6.984 0-5.039 1.584-7.488 5.112-7.488 2.376 0 3.745 1.369 4.825 3.744zM44.712 128.16h.072-.072zm.072 0c.72 0 1.296-.289 1.729-.648.36-.432.647-1.008.647-1.799 0-.865-.288-1.441-.647-1.801-.432-.359-1.008-.576-1.729-.576h-.072c-.864 0-1.44.217-1.8.576-.359.359-.576.936-.576 1.801v.07c0 .721.216 1.297.576 1.729.36.359.937.648 1.8.648h.072zm-.072.576c-1.008 0-1.728-.359-2.232-.865-.504-.504-.72-1.223-.72-2.088v-.07c0-1.01.216-1.729.72-2.232.504-.504 1.224-.721 2.232-.721h.072c.864 0 1.584.217 2.088.721s.864 1.223.864 2.232c0 .936-.36 1.654-.864 2.158a2.921 2.921 0 0 1-2.088.865h-.072zm.288-3.312h.072c.288 0 .432-.145.432-.504v-.072s-.072 0-.072-.072c-.072-.072-.216-.072-.432-.072h-.792v.721H45v-.001zm.504.504l.576.721c.072.143 0 .287-.072.359-.144.145-.36.072-.432 0l-.72-1.008h-.648v.791c0 .145-.144.289-.288.289s-.288-.145-.288-.289v-2.375c0-.145.144-.287.288-.287H45.072c.288 0 .576.07.72.215.072.072.144.072.144.145.144.145.144.287.144.432 0 .575-.144.862-.576 1.007zM122.256 61.056c13.393 0 24.984 4.896 34.344 14.256 9.648 9.648 14.473 21.168 14.473 34.631v18.504h-19.584v-19.08c0-7.486-2.664-13.967-8.064-19.295-1.297-1.368-2.664-2.448-4.248-3.528-4.32-2.952-9.432-4.248-14.76-4.248h-2.16v-21.24h-.001zm27.359 67.391h-15.264v-14.76c0-2.447-.791-4.32-2.447-5.904-1.584-1.654-3.744-2.447-5.904-2.447h-3.744V84.168h2.16c5.615 0 10.439 1.584 14.76 4.824 1.08.504 2.16 1.584 2.951 2.376 5.113 5.113 7.488 11.017 7.488 18v19.079zm-17.135 0h-10.225v-21.238H126c1.656 0 3.24.574 4.607 1.871 1.08 1.08 1.873 2.736 1.873 4.607v14.76z"/></g>
    </svg>
  
  </span>
  <span>
    <svg xmlns="http://www.w3.org/2000/svg" fill="#000000" width="150" height="140" viewBox="0 -29.98 240 240"><path d="M238.553 22.362s-6.882-5.327-29.168-13.512C189.83 1.653 174.893 0 174.893 0l.074 42.679c0 18.039-20.385 37.194-55.199 37.194h-.996c-34.81 0-55.188-19.155-55.188-37.194L63.652 0S48.729 1.652 29.166 8.85C6.881 17.035 0 22.362 0 22.362c1.652 34.229 54.826 62.43 119.263 62.445h.015c64.441-.015 117.628-28.216 119.275-62.445"/><path d="M238.582 118.203s-6.881 5.312-29.167 13.504c-19.569 7.198-34.493 8.843-34.493 8.843l.075-42.672c0-18.035-20.386-37.183-55.199-37.183l-.49-.015h-.015l-.483.015c-34.817 0-55.195 19.148-55.195 37.183l.076 42.672s-14.931-1.645-34.493-8.843C6.919 123.515.024 118.203.024 118.203c1.652-34.226 54.84-62.427 119.285-62.449 64.44.022 117.629 28.223 119.273 62.449M11.611 179.946c-5.432 0-5.53-4.135-5.53-5.733v-7.528c0-.469-.03-1.072.936-1.072h2.799c.92 0 .868.635.868 1.072v7.528c0 .543.091 1.978 2.067 1.978h4.708c1.939 0 2.052-1.435 2.052-1.978v-7.528c0-.438-.062-1.072.853-1.072H23.2c1.02 0 .928.635.928 1.072v7.528c0 1.601-.106 5.733-5.545 5.733M37.632 179.026c-1.916-2.58-4.655-5.824-7.446-9.266v9.174c0 .407.098 1.012-.86 1.012h-2.618c-.943 0-.837-.604-.837-1.012v-12.268c0-.422-.038-1.057.837-1.057h5.107c1.441 0 3.501 2.897 4.844 4.828 1.049 1.449 2.965 3.651 4.255 5.312v-9.084c0-.422-.053-1.057.898-1.057h2.844c.905 0 .854.635.854 1.057v13.277h-5.243c-1.126.004-1.609.08-2.635-.916M47.244 179.946v-14.319h12.652c.77 0 5.968-.104 5.968 5.356 0 5.568.596 8.963-5.862 8.963h-6.82l-1.471-2.987v2.987m7.513-3.772c2.301 0 2.127-2.202 2.127-3.214 0-3.38-.951-3.518-2.467-3.518h-7.22v6.73l7.56.002zM70.813 165.718h11.664c.981 0 .853.646.853 1.84 0 1.116.151 1.75-.853 1.75h-9.219c-.242 0-1.086-.119-1.086.74 0 .875-.159 1.223.762 1.223h8.148l1.313 2.609c.188.362.166.68-.551.68h-8.436l-1.305-2.551v3.758c0 .875.777.709 1.003.709h9.574c.951 0 .868.664.868 1.75 0 1.162.083 1.812-.868 1.812H70.563c-1.011 0-2.98-.315-2.98-3.472v-7.891c0-.83.43-2.957 3.23-2.957M86.475 165.626h12.758c1.712 0 4.202-.016 4.202 4.604 0 3.018-.641 3.168-2.015 4.104 2.301.393 1.992 3.334 1.992 4.857 0 .771-.279.754-.506.754h-3.742c-.785 0-.596-1.236-.596-1.885 0-1.75-.981-1.676-1.366-1.676h-5.507c-.528-.921-1.554-2.973-1.554-2.973v5.945l-.702.588h-3.765l-.377-.469v-12.613c.001-.888.627-1.236 1.178-1.236m10.162 3.788h-5.681c-.951 0-.905.315-.905.604v2.563h5.847c2.837 0 2.837-.709 2.837-1.448-.001-1.478-.121-1.719-2.098-1.719M125.404 165.718c.936 0 1.848.422 2.832 2.338.664 1.373 5.297 9.748 6.277 11.498v.482h-4.828l-1.39-2.52h-5.872l-1.27-2.883c-.361.588-2.3 4.27-2.964 5.401h-4.843v-.315c.988-1.857 7.733-14.004 7.733-14.004m2.817 3.972l-2.369 4.299.219.213h4.391l.219-.213-2.24-4.314-.22.015M137.576 165.626h12.766c1.705 0 4.195-.016 4.195 4.604 0 3.018-.635 3.168-2.008 4.104 2.311.393 1.992 3.334 1.992 4.857 0 .771-.287.754-.514.754h-3.742c-.783 0-.588-1.236-.588-1.885 0-1.75-.98-1.676-1.357-1.676h-5.521c-.529-.921-1.557-2.973-1.557-2.973v5.945l-.691.588h-3.773l-.377-.469v-12.613c-.001-.888.632-1.236 1.175-1.236m10.171 3.788h-5.688c-.951 0-.904.315-.904.604v2.563h5.854c2.821 0 2.821-.709 2.821-1.448-.001-1.478-.105-1.719-2.083-1.719M165.688 179.946c-.949-1.78-3.59-6.699-5.371-9.928v8.933c0 .377.061.995-.859.995h-2.58c-.966 0-.891-.618-.891-.995v-12.269c0-.438-.061-1.057.891-1.057h4.467c.664 0 1.613-.15 2.67 1.977.801 1.705 2.489 5.252 3.668 7.123 1.176-1.871 2.912-5.418 3.711-7.123 1.041-2.127 1.961-1.977 2.717-1.977h4.451c.904 0 .799.619.799 1.057v12.269c0 .377.137.995-.799.995h-2.611c-.95 0-.875-.618-.875-.995v-8.933c-1.811 3.229-4.422 8.146-5.416 9.928M185.092 179.976c-4.225 0-4.043-4.525-4.043-7.482 0-2.688-.303-6.896 4.993-6.941h9.416c5.312 0 4.964 4.271 4.964 6.941 0 2.957.213 7.482-4.089 7.482m-2.731-3.682c2.144 0 2.067-2.218 2.067-3.695 0-1.344.317-3.427-2.476-3.427h-4.736c-2.775 0-2.445 2.083-2.445 3.427 0 1.479-.136 3.695 2.008 3.695h5.582zM207.499 179.946c-5.417 0-5.522-4.135-5.522-5.733v-7.528c0-.469-.029-1.072.937-1.072h2.808c.92 0 .858.635.858 1.072v7.528c0 .543.091 1.978 2.067 1.978h4.707c1.947 0 2.053-1.435 2.053-1.978v-7.528c0-.438-.045-1.072.859-1.072h2.821c1.026 0 .937.635.937 1.072v7.528c0 1.601-.092 5.733-5.553 5.733M223.04 165.626h12.767c1.705 0 4.193-.016 4.193 4.604 0 3.018-.648 3.168-2.021 4.104 2.31.393 2.008 3.334 2.008 4.857 0 .771-.287.754-.514.754h-3.742c-.77 0-.588-1.236-.588-1.885 0-1.75-.996-1.676-1.373-1.676h-5.508c-.527-.921-1.555-2.973-1.555-2.973v5.945l-.709.588h-3.758l-.377-.469v-12.613c0-.888.634-1.236 1.177-1.236m10.155 3.788h-5.674c-.951 0-.906.315-.906.604v2.563h5.855c2.821 0 2.821-.709 2.821-1.448.002-1.478-.119-1.719-2.096-1.719"/></svg>
  </span>
  <span>
    <svg xmlns="http://www.w3.org/2000/svg" fill="#000000" width="170" height="180" viewBox="35.433 -191.049 889.299 889.299"><path d="m512.857 36.99c-2.898.447-5.684 11.118-11.285 16.677-4.096 4.012-9.209 3.761-11.925 8.721-1.031 1.853-.697 5.016-1.867 8.053-2.285 6.074-10.337 6.617-10.337 13.235-.028 7.147 6.715 8.512 12.552 13.583 4.556 4.082 5.002 6.896 10.518 8.874 4.71 1.603 11.717-3.636 18.028-1.755 5.183 1.547 10.142 2.661 11.313 7.983 1.03 4.904-.07 12.51-6.353 11.633-2.118-.237-11.299-3.33-22.583-2.132-13.612 1.547-29.146 5.99-30.664 21.163-.836 8.484 9.654 18.487 19.783 16.453 7.007-1.38 3.692-9.64 7.509-13.653 5.001-5.14 33.338 17.944 59.683 17.944 11.09 0 19.337-2.8 27.53-11.382.765-.655 1.699-2.062 2.883-2.146 1.115.084 3.065 1.184 3.706 1.658 21.218 17.052 37.253 51.255 115.229 51.659 10.964.055 23.46 5.294 33.658 14.6 9.098 8.415 14.42 21.496 19.588 34.773 7.802 19.923 21.79 39.302 42.993 60.868 1.157 1.156 18.613 14.726 20.006 15.743.223.139 1.505 3.204 1.06 4.917-.516 12.929-2.397 50.53 25.633 52.23 6.855.348 5.057-4.472 5.057-7.788-.013-6.548-1.212-13.054 2.244-19.755 4.722-9.222-10.017-13.472-9.585-33.408.306-14.865-12.177-12.33-18.516-23.656-3.65-6.562-6.896-10.044-6.659-18.07 1.421-45.165-9.613-74.84-15.116-82.126-4.29-5.503-7.843-7.69-3.915-10.24 23.392-15.45 28.7-29.828 28.7-29.828 12.44-29.242 23.628-55.95 39.05-67.707 3.107-2.425 11.076-8.373 15.966-10.714 14.391-6.785 21.97-10.894 26.15-14.963 6.617-6.45 11.841-19.894 5.502-28.044-7.885-10.059-21.524-2.076-27.542 1.49-43.007 25.524-49.346 70.55-64.24 96.408-11.883 20.66-31.206 35.832-48.481 37.072-12.957.961-26.916-1.658-40.82-7.76-33.812-14.823-52.314-33.965-56.674-37.35-9.084-7.008-79.606-76.235-136.74-79.063 0 0-7.09-14.196-8.874-14.433-4.18-.53-8.456 8.484-11.521 9.53-2.884.96-7.732-9.767-10.644-9.293m-251.522 413.171c-5.378-.126-9.947-4.542-9.947-10.003l.014-178.214h-58.736v196.45c0 9.627 7.801 17.485 17.372 17.485h102.663c9.64 0 17.345-7.858 17.345-17.485v-196.45h-58.68l-.056 178.214c0 5.461-4.57 9.877-9.975 10.003m196.659-188.217h-88.898c-10.518 0-19.086 8.554-19.086 19.184v194.75h58.79v-178.644c.042-5.475 4.472-9.808 9.934-9.808 5.489 0 9.891 4.235 10.016 9.655v178.798h58.555v-178.8c.07-5.419 4.472-9.654 9.947-9.654 5.434 0 9.92 4.333 9.962 9.808v178.646h58.791v-194.751c0-10.63-8.582-19.184-19.1-19.184zm-343.931 35.665c.042-5.949-4.806-10.184-9.947-10.184h-9.975v108.207h9.975c5.183 0 9.99-4.124 9.947-10.044zm39.413 124.507h-59.335v53.763h-58.708v-213.935h118.42c10.601 0 18.876 8.61 18.876 19.268v121.637c0 10.672-8.595 19.267-19.253 19.267m613.996 5.921c-11.8 0-21.706 10.198-21.706 22.556 0 12.399 9.906 22.513 22.082 22.513 12.079 0 21.859-10.114 21.859-22.513 0-12.386-9.78-22.556-21.86-22.556zm26.442 22.486c0 14.53-11.647 26.345-26.066 26.345-14.573 0-26.275-11.73-26.275-26.345 0-14.336 11.702-26.317 25.843-26.317 14.851 0 26.498 11.62 26.498 26.317"/><path d="m765.131 448.852c4.082 0 6.228-1.449 6.228-4.346 0-2.578-2.076-3.901-6.047-3.901h-1.17v8.247zm15.033 16.913h-7.008l-9.014-11.995v11.995h-5.726v-30.329h6.019c8.178 0 12.524 3.093 12.524 9 0 3.942-2.563 7.44-6.144 8.484l-.418.154zm-115.591-70.09v-98.51c-.14-5.448-4.528-9.627-10.003-9.627-5.42 0-9.906 4.346-9.947 9.78v98.357zm0 80.205v-53.707h-19.95v53.707h-58.68v-194.751c0-10.63 8.567-19.184 19.086-19.184h99.137c10.547 0 19.115 8.554 19.115 19.184v194.75z"/></svg>
  </span>
</div>
</div>
    </div>

    <!-- footer -->
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
    
    <script src="../path/to/flowbite/dist/flowbite.min.js"></script>  
    <script src="script.js"></script>
</body>
</html>
   