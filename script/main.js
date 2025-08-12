// Liste des offres 
const offres = [
  { titre: "Développeur Web Junior", description: "Stage en développement front-end et back-end, utilisation de React et Node.js.", lieu: "Lausanne" },
  { titre: "Assistant Cybersécurité", description: "Stage en analyse de vulnérabilités et gestion des incidents de sécurité.", lieu: "Genève" },
  { titre: "Data Analyst", description: "Stage en analyse de données, visualisation et reporting avec Python et Tableau.", lieu: "Yverdon" },
  { titre: "Support Technique", description: "Stage en assistance aux utilisateurs, diagnostic matériel et logiciel.", lieu: "Yverdon" },
  { titre: "Développeur Mobile", description: "Stage en développement d'applications iOS et Android.", lieu: "Lausanne" },
  { titre: "Administrateur Réseau", description: "Stage en gestion d'infrastructures réseaux et maintenance.", lieu: "Lausanne" },
  { titre: "Développeur Backend", description: "Stage en développement d'API REST et bases de données.", lieu: "Genève" },
  { titre: "Testeur QA", description: "Stage en tests fonctionnels et automatisés.", lieu: "Lausanne" },
  { titre: "Community Manager", description: "Stage en gestion des réseaux sociaux et communication digitale.", lieu: "Lausanne" },
  { titre: "UX/UI Designer", description: "Stage en design d’interfaces utilisateur et expérience utilisateur.", lieu: "Yverdon" }
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
    o.lieu.toLowerCase().includes(query)
  );
  afficherOffres(filtered);
});

// Gestion bouton retour
btnBack.addEventListener('click', () => {
  window.location.href = '../services.html';
});
