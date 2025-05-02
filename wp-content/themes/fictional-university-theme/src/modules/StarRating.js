// Ensure universityData is available
if (typeof universityData === 'undefined') {
  console.error('universityData is not defined');
}

// Star Rating Functions
function submitRating(professorId, rating) {
  return fetch(`${universityData.root_url}/wp-json/university/v1/manageRating`, {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
      "X-WP-Nonce": universityData.nonce,
    },
    body: JSON.stringify({
      professorId,
      rating,
    }),
  })
  .then(response => {
    if (!response.ok) throw new Error('Network response was not ok');
    return response.json();
  });
}

// Initialize when DOM is ready
function initStarRatings() {
  document.querySelectorAll(".star-rating-box").forEach((box) => {
    const stars = box.querySelectorAll("i");
    const professorId = box.dataset.professor;
    let ratingId = box.dataset.ratingId || '';
    let currentRating = parseInt(box.dataset.currentRating) || 0;

    function updateStars() {
      stars.forEach((star) => {
        const starValue = parseInt(star.dataset.star);
        star.classList.toggle("fa-star", starValue <= currentRating);
        star.classList.toggle("fa-star-o", starValue > currentRating);
      });
    }

    stars.forEach((star) => {
      star.addEventListener("click", function() {
        if (!universityData.loggedIn) {
          console.log("Please log in to rate professors.");
          return;
        }

        const selectedRating = parseInt(this.dataset.star);
        
        submitRating(professorId, selectedRating)
          .then((res) => {
            if (res) {
              ratingId = res;
              currentRating = selectedRating;
              updateStars();
              box.dataset.currentRating = currentRating;
              box.dataset.ratingId = ratingId;
            }
          })
          .catch(error => {
            console.error('Rating submission failed:', error);
            alert('Failed to submit rating. Please try again.');
          });
      });
    });

    // Initialize on load
    updateStars();
  });
}

// Initialize when DOM is ready
if (document.readyState === 'loading') {
  document.addEventListener('DOMContentLoaded', initStarRatings);
} else {
  initStarRatings();
}

export default class StarRating {
  constructor() {
    console.log("StarRating initialized");
    initStarRatings();
  }
}