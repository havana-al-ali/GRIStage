function myFunction() {
    console.log("tesdt")
    document.getElementById("demo").innerHTML = "La recherche personnalisée de stages repose sur une méthodologie précise, combinant des conseils experts, des plateformes spécialisées et des outils d'orientation intelligents. En définissant clairement ton profil et tes objectifs, tu bénéficies d'un filtrage ciblé des offres disponibles et d'un accès privilégié à des réseaux professionnels. Les séances d'accompagnement te permettent également de renforcer tes candidatures avec des CV adaptés, des lettres de motivation percutantes, et une préparation aux entretiens sur mesure. L'objectif ? Te mettre dans les meilleures conditions pour décrocher un stage à forte valeur ajoutée, en phase avec ton projet professionnel et ton développement personnel.";
}
document.addEventListener('DOMContentLoaded', function () {
    const offresBtn = document.querySelector('.glow-on-hover');
  
    if (offresBtn) {
      offresBtn.addEventListener('click', function () {
        fetch('../php/get_offres.php') // adapte le chemin si ton HTML est ailleurs
          .then(response => {
            if (!response.ok) throw new Error("Erreur lors du chargement des offres");
            return response.json();
          })
          .then(offres => {
            const container = document.getElementById('offres-container');
            container.innerHTML = '';
  
            if (offres.length === 0) {
              container.innerHTML = "<p>Aucune offre disponible.</p>";
              return;
            }
  
            offres.forEach(offre => {
              const div = document.createElement('div');
              div.classList.add('offre');
              div.innerHTML = `
                <h3>${offre.titre}</h3>
                <p>${offre.description}</p>
                <hr>
              `;
              container.appendChild(div);
            });
          })
          .catch(error => {
            document.getElementById('offres-container').innerHTML =
              `<p style="color:red;">${error.message}</p>`;
          });
      });
    }
  });
  