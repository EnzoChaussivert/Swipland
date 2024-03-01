function fetchRandomMovie(language) {
  const apiKey = 'b0c3c3050e542b32c081cbb6cbcd1c2b';
  const randomMovieUrl = `https://api.themoviedb.org/3/discover/movie?api_key=${apiKey}&language=${language}-US&sort_by=popularity.desc&include_adult=false&page=1`;

  return fetch(randomMovieUrl)
    .then(response => response.json())
    .then(data => {
      const randomIndex = Math.floor(Math.random() * data.results.length);
      const randomMovie = data.results[randomIndex];
      const posterPath = randomMovie.poster_path;
      const posterUrl = `https://image.tmdb.org/t/p/w500/${posterPath}`;

      return {
        title: randomMovie.title,
        overview: randomMovie.overview,
        posterUrl: posterUrl
      };
    })
    .catch(error => {
      console.error('Error fetching data:', error);
    });
}