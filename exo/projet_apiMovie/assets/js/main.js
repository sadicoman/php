"use strict";

// Sélectionne la liste de films
const movieList = document.querySelector(".movie");

// Ajout d'un écouteur d'événement click sur la liste de films
movieList.addEventListener("click", (event) => {
	// Vérifie si l'élément cliqué est une image
	if (event.target.tagName === "IMG") {
		// Récupère les détails du film suivant l'image cliquée
		const movieDetails = event.target.nextElementSibling;
		// Affiche les détails du film en utilisant le style "display: flex"
		movieDetails.style.display = "flex";
	}
});
