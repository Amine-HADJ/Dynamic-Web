// Ouvrir le modal pour modifier l'email
document.getElementById('edit-email-btn').addEventListener('click', function() {
    document.getElementById('edit-email-modal').style.display = 'block';
});

// Fermer le modal pour modifier l'email
document.querySelector('#edit-email-modal .close').addEventListener('click', function() {
    document.getElementById('edit-email-modal').style.display = 'none';
});

// Ouvrir le modal pour modifier le mot de passe
document.getElementById('edit-password-btn').addEventListener('click', function() {
    document.getElementById('edit-password-modal').style.display = 'block';
});


// Ouvrir le modal pour modifier le mot de passe
document.getElementById('edit-password-btn').addEventListener('click', function() {
    document.getElementById('edit-password-modal').style.display = 'block';
});

// Ouvrir le modal pour confirmer le changement de mot de passe le bouton d'id submit-password
document.getElementById('submit-password').addEventListener('click', async function(e) {
    e.preventDefault();
    // Récupération du message de succès ou non
    const result = await fetch('../php/UpdatePassword.php', {
        method: 'POST',
        credentials: 'include',
        body: new FormData(document.getElementById('edit-password-form'))
    }).then(response => response.text());
    
    // On affiche le message de succès ou non
    document.querySelector('#password-changed-modal p').innerHTML = result;


    document.getElementById('password-changed-modal').style.display = 'block';
    document.getElementById('edit-password-modal').style.display = 'none';
    
    // on le ferme au bout de 3 secondes
    setTimeout(function() {
        document.getElementById('password-changed-modal').style.display = 'none';
    }, 3000);

});


// Ouvrir le modal pour confirmer le changement d'email le bouton d'id submit-password
document.getElementById('submit-email').addEventListener('click', async function(e) {
    e.preventDefault();
    // Récupération du message de succès ou non
    const result = await fetch('../php/UpdateEmail.php', {
        method: 'POST',
        credentials: 'include',
        body: new FormData(document.getElementById('edit-email-form'))
    }).then(response => response.text());
    
    // On affiche le message de succès ou non
    document.querySelector('#email-changed-modal p').innerHTML = result;


    document.getElementById('email-changed-modal').style.display = 'block';
    document.getElementById('edit-email-modal').style.display = 'none';
    
    // on le ferme au bout de 3 secondes
    setTimeout(function() {
        document.getElementById('email-changed-modal').style.display = 'none';
    }, 3000);

});





