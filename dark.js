// On page load or when changing themes, best to add inline in `head` to avoid FOUC
if (darkMode === 'dark' || (!('theme' in darkMode) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
    document.documentElement.classList.add('dark')
  } else {
    document.documentElement.classList.remove('dark')
  }
  
  // Whenever the user explicitly chooses light mode
  darkMode = 'light'
  
  // Whenever the user explicitly chooses dark mode
  darkMode = 'dark'
  
  // Whenever the user explicitly chooses to respect the OS preference
  darkMode.removeItem('theme')