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

// --- REFRESH DESTINATIONS ALÉATOIRES (AJAX) ---
const btnPopularLinks = document.querySelectorAll(".nav-popular");
const cardsGrid = document.querySelector(".cards-grid");

if (btnPopularLinks.length > 0 && cardsGrid) {
    btnPopularLinks.forEach(link => {
        link.addEventListener("click", (e) => {
            // Vérifie si on est déjà sur la page d'accueil (index.php ou racine)
            const isHomePage = window.location.pathname.endsWith("index.php") || window.location.pathname.endsWith("/");
            
            if (isHomePage) {
                e.preventDefault(); // Empêche le rechargement de la page
                
                // Ajout d'une petite animation de fondu
                cardsGrid.style.opacity = "0.5";
                
                fetch("ajax_random_destinations.php")
                    .then(response => {
                        if (!response.ok) throw new Error('Network response was not ok');
                        return response.text();
                    })
                    .then(html => {
                        cardsGrid.innerHTML = html;
                        cardsGrid.style.opacity = "1";
                        // Scroll doux vers la section
                        document.getElementById("btn-popular-destinations").scrollIntoView({ behavior: "smooth" });
                    })
                    .catch(error => {
                        console.error('Erreur AJAX:', error);
                        cardsGrid.style.opacity = "1";
                        // Rollback silencieux : si AJAX échoue, on laisse le lien fonctionner normalement (refresh classique)
                        window.location.reload();
                    });
            }
        });
    });
}

// --- WIDGET MÉTÉO (AJAX) ---
const weatherWidget = document.getElementById("weather-widget");

if (weatherWidget) {
    const city = weatherWidget.getAttribute("data-city");
    
    if (city) {
        const apiKey = '66547f2fe3624ef949d841b39be0ec5d';
        const url = `https://api.openweathermap.org/data/2.5/weather?q=${encodeURIComponent(city)}&appid=${apiKey}&units=metric&lang=fr`;

        fetch(url)
            .then(response => {
                if (!response.ok) throw new Error('Ville non trouvée ou erreur API');
                return response.json();
            })
            .then(data => {
                const temp = Math.round(data.main.temp);
                const description = data.weather[0].description;
                const icon = data.weather[0].icon;
                const humidity = data.main.humidity;

                weatherWidget.innerHTML = `
                    <div class="weather-container">
                        <div class="weather-info-left">
                            <h3>Météo à ${data.name}</h3>
                            <p class="weather-description">${description}</p>
                        </div>
                        <div class="weather-main">
                            <img src="https://openweathermap.org/img/wn/${icon}@2x.png" alt="${description}" class="weather-icon">
                            <span class="weather-temp">${temp}°C</span>
                        </div>
                        <div class="weather-humidity-box">
                            <p>Humidité</p>
                            <p class="weather-humidity-value">${humidity}%</p>
                        </div>
                    </div>
                `;
            })
            .catch(error => {
                console.error('Erreur Météo:', error);
                weatherWidget.innerHTML = `<p class="weather-error">Météo indisponible</p>`;
            });
    }
}