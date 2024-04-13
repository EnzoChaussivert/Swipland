document.addEventListener("DOMContentLoaded", () => {
    const apiKey = 'b0c3c3050e542b32c081cbb6cbcd1c2b'; // Remplacez 'YOUR_TMDB_API_KEY' par votre clé API TMDb
    const posterElement = document.getElementById('moviePoster');

    // Fonction pour mettre à jour la table visionnages
    function updateDatabase(titreFilm, vu) {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "update_vu.php", true); // Envoi à update_vu.php
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.send(`titre_film=${encodeURIComponent(titreFilm)}&vu=${vu}`);
    }

    function fetchRandomMovie() {
        const randomMovieUrl = `https://api.themoviedb.org/3/discover/movie?api_key=${apiKey}&language=en-US&sort_by=popularity.desc&include_adult=false&page=1`;

        fetch(randomMovieUrl)
            .then(response => response.json())
            .then(data => {
                const randomIndex = Math.floor(Math.random() * data.results.length);
                const randomMovie = data.results[randomIndex];
                const posterPath = randomMovie.poster_path;
                const posterUrl = `https://image.tmdb.org/t/p/w500/${posterPath}`;

                posterElement.src = posterUrl;
                posterElement.alt = randomMovie.title;

                // Envoie des données du film via AJAX
                const xhr = new XMLHttpRequest();
                xhr.open('POST', 'index.php', true);
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                        console.log('Film ajouté avec succès !');
                    }
                };
                xhr.send(`title=${encodeURIComponent(randomMovie.title)}`);
            })
            .catch(error => {
                console.error('Error fetching data:', error);
            });
    }

    // Appeler fetchRandomMovie une fois que la page est chargée
    fetchRandomMovie();

    // Ajouter des écouteurs d'événements aux boutons gauche et droit
    const leftButton = document.querySelectorAll('.left-button-button');
    const rightButton = document.querySelectorAll('.right-button-button');

    leftButton.forEach(button => {
        button.addEventListener('click', () => {
            updateDatabase(posterElement.alt, false);
            fetchRandomMovie();
        });
    });

    rightButton.forEach(button => {
        button.addEventListener('click', () => {
            updateDatabase(posterElement.alt, true);
            fetchRandomMovie();
        });
    });
});
