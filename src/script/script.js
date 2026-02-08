// --- MENU EXPLORER ---
const btnExplorer = document.getElementById("btn-explorer");
const menuExplorer = document.getElementById("menuExplorer");

//lorsque l'événement click se produit sur mon button, fait {}
btnExplorer.addEventListener("click", () => {//ouvre mon menu explorer deroulant 
  menuExplorer.style.display = menuExplorer.style.display === "block" ? "none" : "block";
});

document.addEventListener("click", function (e) {//cache mon menu deroulant si click ailleurs
  if (e.target !== btnExplorer && !menuExplorer.contains(e.target)) {
    menuExplorer.style.display = "none"; 
  }
})

// --- CLICK SUR LOGO ET REDIGER VERS PAGE ACCUEIL ---
document.querySelector(".logo").addEventListener("click", function() {
  document.location.href = "index.php";
});