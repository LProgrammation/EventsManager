<section class="error-container">
    <div class="error-icon">⚠️</div>
    
    <div class="error-code"><?= htmlspecialchars($renderData['data']['errorCode']) ?></div>
    
    <h1 class="error-message"><?= htmlspecialchars($renderData['data']['errorMessage']) ?></h1>
    
    <p class="error-description">
        La page que vous recherchez n'existe pas ou une erreur s'est produite.
    </p>
    
    <div class="error-actions">
        <a href="/" class="error-btn">Retour à l'accueil</a>
        <a href="/events" class="error-btn">Voir les événements</a>
    </div>
</section>

