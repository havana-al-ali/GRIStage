// Liste des offres 
const offres = [
  { titre: "Développeur Web Junior", description: "Stage en développement front-end et back-end, utilisation de React et Node.js.", lieu: "Lausanne", durée: "3 mois"},
  { titre: "Assistant Cybersécurité", description: "Stage en analyse de vulnérabilités et gestion des incidents de sécurité.", lieu: "Genève", durée: "6 mois"},
  { titre: "Data Analyst", description: "Stage en analyse de données, visualisation et reporting avec Python et Tableau.", lieu: "Yverdon", durée: "2 mois" },
  { titre: "Support Technique", description: "Stage en assistance aux utilisateurs, diagnostic matériel et logiciel.", lieu: "Yverdon", durée: "4 mois" },
  { titre: "Développeur Mobile", description: "Stage en développement d'applications iOS et Android.", lieu: "Lausanne", durée: "6 mois" },
  { titre: "Administrateur Réseau", description: "Stage en gestion d'infrastructures réseaux et maintenance.", lieu: "Lausanne", durée: "5 mois" },
  { titre: "Développeur Backend", description: "Stage en développement d'API REST et bases de données.", lieu: "Genève", durée: "6 mois" },
  { titre: "Testeur QA", description: "Stage en tests fonctionnels et automatisés.", lieu: "Lausanne", durée: "2 mois" },
  { titre: "Community Manager", description: "Stage en gestion des réseaux sociaux et communication digitale.", lieu: "Lausanne", durée: "4 mois" },
  { titre: "UX/UI Designer", description: "Stage en design d’interfaces utilisateur et expérience utilisateur.", lieu: "Yverdon", durée: "3 mois" }
];

const container = document.getElementById('offres-container');
const searchBar = document.getElementById('search-bar');
const noResults = document.getElementById('no-results');
const btnBack = document.getElementById('btn-back');

function afficherOffres(listOffres) {
  container.innerHTML = '';
  if (listOffres.length === 0) {
    noResults.style.display = 'block';
    return;
  }
  noResults.style.display = 'none';

  listOffres.forEach(offre => {
    const div = document.createElement('div');
    div.className = 'offre';
    div.innerHTML = `
      <h3>${offre.titre}</h3>
      <p>${offre.description}</p>
      <p class="lieu">Lieu : ${offre.lieu}</p>
      <p class="durée">Durée : ${offre.durée}</p>
    `;
    container.appendChild(div);
  });
}

// Affichage initial
afficherOffres(offres);

// Recherche 
searchBar.addEventListener('input', e => {
  const query = e.target.value.toLowerCase().trim();
  const filtered = offres.filter(o =>
    o.titre.toLowerCase().includes(query) ||
    o.description.toLowerCase().includes(query) ||
    o.lieu.toLowerCase().includes(query) ||
    o.durée.toLowerCase().includes(query)
  );
  afficherOffres(filtered);
});

// Gestion bouton retour
btnBack.addEventListener('click', () => {
  window.location.href = 'services.html';
});
