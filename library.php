<?php include 'includes/header.php'; ?>
<?php include 'includes/sidebar.php'; ?>

<main class="main-content">
    <header class="page-header">
        <div class="header-title">
            <h1>Bibliothèque <span class="highlight">Génomique</span></h1>
        </div>
        <p>Explorez les séquences pré-enregistrées et gérez vos favoris.</p>
    </header>

    <div class="search-container">
        <span class="search-icon"><i class="fa-solid fa-magnifying-glass"></i></span>
        <input type="text" id="library-search" placeholder="Rechercher par nom ou description (ex: GFP, Fluorescence...)">
    </div>

    <div class="library-list" id="library-list">
        
        <article class="genome-card" data-id="gfp">
            <div class="card-info">
                <h3>GFP - Protéine Fluorescente Verte</h3>
                <p>Gène codant pour la protéine fluorescente verte, extraite de la méduse Aequorea victoria.</p>
                <div class="card-meta">
                    <span>54 bases</span> • <span>GC: 65%</span> • <span>PoC 2026</span>
                </div>
            </div>
            <div class="card-actions">
                <button class="btn btn-secondary btn-sm favorite-btn" title="Ajouter aux favoris">
                    <i class="fa-solid fa-bookmark"></i>
                </button>
                <button class="btn btn-primary btn-sm load-btn" data-seq="ATGCGTAAATGCGGTAAATTT" title="Envoyer au séquenceur">
                    <i class="fa-solid fa-play"></i>charger
                </button>
            </div>
        </article>

        <article class="genome-card" data-id="ampicilline">
            <div class="card-info">
                <h3>Résistance à l'Ampicilline</h3>
                <p>Séquence permettant aux bactéries de survivre en présence d'ampicilline (Beta-lactamase).</p>
                <div class="card-meta">
                    <span>67 bases</span> • <span>GC: 42%</span> • <span>PoC 2026</span>
                </div>
            </div>
            <div class="card-actions">
                <button class="btn btn-secondary btn-sm favorite-btn">
                    <i class="fa-solid fa-bookmark"></i>
                </button>
                <button class="btn btn-primary btn-sm load-btn" data-seq="GCTAGCTAGCTAGCTAGCTAGCTAGCTAGCTAGCTAGC">
                    <i class="fa-solid fa-play"></i>charger
                </button>
            </div>
        </article>

        <article class="genome-card" data-id="insuline">
            <div class="card-info">
                <h3>Pré-proinsuline Humaine</h3>
                <p>Segment initial de la séquence codante pour l'insuline chez l'humain.</p>
                <div class="card-meta">
                    <span>45 bases</span> • <span>GC: 58%</span> • <span>PoC 2026</span>
                </div>
            </div>
            <div class="card-actions">
                <button class="btn btn-secondary btn-sm favorite-btn">
                    <i class="fa-solid fa-bookmark"></i>
                </button>
                <button class="btn btn-primary btn-sm load-btn" data-seq="ATGGCCCTGTGGATGCGCCTCCTGCCCCTGCTGGCCCTGCTGGCCCTC">
                    <i class="fa-solid fa-play"></i>charger
                </button>
            </div>
        </article>

    </div>
    
    <!-- Bouton de test pour créer une séquence sauvegardée -->
    <div style="margin: 20px 0; text-align: center;">
        <button onclick="creerSequenceTest()" style="background: var(--primary-neon); color: var(--bg-color); border: none; padding: 10px 20px; border-radius: 8px; cursor: pointer;">
            Créer une séquence de test
        </button>
    </div>
</main>

<?php include 'includes/block.php'; ?>
<?php include 'includes/footer.php'; ?>

<script>
// Debug: Vérifier les séquences sauvegardées au chargement
console.log('Library page loaded - checking saved sequences...');
const savedSequences = JSON.parse(localStorage.getItem('labgenius-sauvegardes')) || [];
console.log('Found saved sequences:', savedSequences.length, savedSequences);

// Forcer l'affichage des séquences sauvegardées si elles existent
if (savedSequences.length > 0) {
    console.log('Displaying saved sequences...');
    // Appeler la fonction d'affichage si elle existe
    if (typeof afficherSequencesSauvegardees === 'function') {
        afficherSequencesSauvegardees();
    } else {
        console.error('Function afficherSequencesSauvegardees not found');
    }
}

// Fonction de test pour créer une séquence sauvegardée
function creerSequenceTest() {
    console.log('Creating test sequence...');
    
    // Créer une séquence de test
    const testSequence = {
        id: Date.now().toString(),
        nom: 'Séquence Test - ADN Luciferase',
        sequence: 'ATGGCTAGCTAGCTAGCTAGCTAGCTAGCTAGCTAGCTAG',
        type: 'sequenceur',
        date: new Date().toLocaleDateString('fr-FR'),
        bases: 42,
        gc: 52,
        acidesAmines: 'Met-Ala-Arg-Stop-Arg-Stop-Arg-Stop-Arg-Stop-Arg',
        timestamp: Date.now()
    };
    
    // Récupérer les sauvegardes existantes
    let sauvegardes = JSON.parse(localStorage.getItem('labgenius-sauvegardes')) || [];
    sauvegardes.unshift(testSequence);
    
    // Limiter à 20 sauvegardes
    if (sauvegardes.length > 20) {
        sauvegardes.splice(20);
    }
    
    // Sauvegarder
    localStorage.setItem('labgenius-sauvegardes', JSON.stringify(sauvegardes));
    
    console.log('Test sequence created and saved');
    
    // Afficher un feedback
    const fb = document.createElement('div');
    fb.style.position = 'fixed';
    fb.style.bottom = '20px';
    fb.style.right = '20px';
    fb.style.padding = '12px 20px';
    fb.style.borderRadius = '8px';
    fb.style.background = '#00f2c3';
    fb.style.color = '#0a0e14';
    fb.style.zIndex = '1000';
    fb.style.fontWeight = 'bold';
    fb.innerText = 'Séquence de test créée avec succès !';
    document.body.appendChild(fb);
    setTimeout(() => fb.remove(), 2500);
    
    // Recharger la page pour voir les séquences
    setTimeout(() => {
        window.location.reload();
    }, 1000);
}
</script>
