document.addEventListener("DOMContentLoaded", () => {
    const apiKey = 'b0c3c3050e542b32c081cbb6cbcd1c2b'; // Remplacez 'YOUR_TMDB_API_KEY' par votre clé API TMDb
    const randomMovieUrl = `https://api.themoviedb.org/3/discover/movie?api_key=${apiKey}&language=en-US&sort_by=popularity.desc&include_adult=false&page=1`;
  
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
      })
      .catch(error => {
        console.error('Error fetching data:', error);
      });
  });
  