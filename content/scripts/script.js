document.addEventListener("DOMContentLoaded", () => {
  const apiKey = 'b0c3c3050e542b32c081cbb6cbcd1c2b'; // Remplacez 'YOUR_TMDB_API_KEY' par votre clé API TMDb
  const randomMovieUrl = `https://api.themoviedb.org/3/discover/movie?api_key=${apiKey}&language=en-US&sort_by=popularity.desc&include_adult=false&page=1`;

  moviePoster.onload = function() {
    const imageWidth = this.width;
    const rightSection = document.querySelector('.right-section');
    const screenWidth = window.innerWidth;
    const rightSectionWidth = screenWidth - imageWidth;
    
    rightSection.style.width = rightSectionWidth + 'px';
  };

  fetch(randomMovieUrl)
    .then(response => response.json())
    .then(data => {
      const randomIndex = Math.floor(Math.random() * data.results.length);
      const randomMovie = data.results[randomIndex];
      const posterPath = randomMovie.poster_path;
      const posterUrl = `https://image.tmdb.org/t/p/w500/${posterPath}`;

      const posterElement = document.getElementById('moviePoster');
      posterElement.src = posterUrl;
      posterElement.alt = randomMovie.title;

      // Récupération des détails du film
      const movieDetailsUrl = `https://api.themoviedb.org/3/movie/${randomMovie.id}?api_key=${apiKey}&language=en-US`;
      return fetch(movieDetailsUrl);
    })
    .then(response => response.json())
    .then(movieDetails => {
      const title = movieDetails.title;
      const overview = movieDetails.overview;

      // Afficher le titre et le résumé du film dans le HTML
      const titleElement = document.getElementById('movieTitle');
      titleElement.textContent = title;

      const overviewElement = document.getElementById('movieOverview');
      overviewElement.textContent = overview;
    })
    .catch(error => {
      console.error('Error fetching data:', error);
    });
});
