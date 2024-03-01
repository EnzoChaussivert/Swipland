document.addEventListener("DOMContentLoaded", () => {
  const apiKey = 'b0c3c3050e542b32c081cbb6cbcd1c2b'; 
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

  const posterElement = document.getElementById('moviePoster');
  let startSwipeX = null;
  let startSwipeY = null;

  // Fonction pour afficher le prochain film
  function showNextFilm() {
    fetch(randomMovieUrl)
      .then(response => response.json())
      .then(data => {
        const randomIndex = Math.floor(Math.random() * data.results.length);
        const randomMovie = data.results[randomIndex];
        const posterPath = randomMovie.poster_path;
        const posterUrl = `https://image.tmdb.org/t/p/w500/${posterPath}`;

        posterElement.src = posterUrl;
        posterElement.alt = randomMovie.title;
      })
      .catch(error => {
        console.error('Error fetching data:', error);
      });
  }

  // Événement pour le swipe ou le clic sur une flèche
  posterElement.addEventListener("click", showNextFilm);

  // Événement pour le toucher initial
  posterElement.addEventListener("touchstart", (event) => {
    startSwipeX = event.touches[0].clientX;
    startSwipeY = event.touches[0].clientY;
  });

  // Événement pour la fin du toucher
  posterElement.addEventListener("touchend", handleSwipeEnd);

  // Événement pour le swipe avec les touches de clavier
  document.addEventListener("keydown", (event) => {
    if (event.key === "ArrowRight") {
      showNextFilm();
      alert("Vu");
    } else if (event.key === "ArrowLeft") {
      showNextFilm();
      alert("À voir");
    } else if (event.key === "ArrowUp") {
      showNextFilm();
      alert("Bien");
    } else if (event.key === "ArrowDown") {
      showNextFilm();
      alert("Nul");
    }
  });

  // Fonction pour gérer le swipe
  function handleSwipeEnd(event) {
    const endSwipeX = event.changedTouches[0].clientX;
    const endSwipeY = event.changedTouches[0].clientY;
    const swipeDistanceX = endSwipeX - startSwipeX;
    const swipeDistanceY = endSwipeY - startSwipeY;

    if (Math.abs(swipeDistanceX) > Math.abs(swipeDistanceY)) {
      if (swipeDistanceX > 50) {
        // Swipe vers la droite (À voir)
        showNextFilm();
        alert("Vu");
      } else if (swipeDistanceX < -50) {
        // Swipe vers la gauche (Vu)
        showNextFilm();
        alert("À voir");
      }
    } else {
      if (swipeDistanceY > 50) {
        // Swipe vers le bas
        showNextFilm();
        alert("Swipe vers le bas");
      } else if (swipeDistanceY < -50) {
        // Swipe vers le haut
        showNextFilm();
        alert("Swipe vers le haut");
      }
    }
  }
});
