"use strict";

let lastDisplayedDetails = null;

const movieImages = document.querySelectorAll(".movie__img");
const footer = document.querySelector(".footer");

movieImages.forEach((img) => {
	img.addEventListener("click", (event) => {
		const currentDetails = event.target.nextElementSibling;

		// Si une div est déjà affichée, la masquer avant d'afficher la nouvelle
		if (lastDisplayedDetails !== null) {
			lastDisplayedDetails.style.display = "none";
		}

		currentDetails.style.display = "flex";
		footer.style.display = "none";
		lastDisplayedDetails = currentDetails;
	});
});

const movieDetails = document.querySelectorAll(".movie-details");

movieDetails.forEach((details) => {
	details.addEventListener("click", (event) => {
		if (
			details.style.display === "flex" &&
			details.contains(event.target)
		) {
			details.style.display = "none";
			footer.style.display = "inherit";
			lastDisplayedDetails = null;
		}
	});
});

/*----------------------------------------------------------*/
var slider = document.querySelector(".slider-container");

document.querySelector("#prev-btn").addEventListener("click", function () {
	slider.scrollBy({ left: -285, behavior: "smooth" });
});

document.querySelector("#next-btn").addEventListener("click", function () {
	slider.scrollBy({ left: 285, behavior: "smooth" });
});
