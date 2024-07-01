 // JavaScript to toggle the dropdown menu
 document.getElementById('userIcon').addEventListener('click', function(event) {
    event.preventDefault();
    var dropdown = document.getElementById('dropdownMenu');
    dropdown.classList.toggle('hidden');
  });

  // Close the dropdown menu if clicked outside
  window.addEventListener('click', function(event) {
    var dropdown = document.getElementById('dropdownMenu');
    if (!document.getElementById('userIcon').contains(event.target)) {
      dropdown.classList.add('hidden');
    }
  });


  // JavaScript to toggle the side menu
  document.getElementById('hamburgerMenu').addEventListener('click', function() {
    var sideMenu = document.getElementById('sideMenu');
    sideMenu.classList.toggle('-translate-x-full');
  });

  document.getElementById('closeMenu').addEventListener('click', function() {
    var sideMenu = document.getElementById('sideMenu');
    sideMenu.classList.toggle('-translate-x-full');
  });

  // Close the side menu if clicked outside
  window.addEventListener('click', function(event) {
    var sideMenu = document.getElementById('sideMenu');
    if (!document.getElementById('hamburgerMenu').contains(event.target) && !sideMenu.contains(event.target)) {
      sideMenu.classList.add('-translate-x-full');
    }
  });
