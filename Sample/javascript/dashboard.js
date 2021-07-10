// NAVIGATION LINK BUTTON // 
const dashboardLink = document.querySelector(".dashboard");
const movieLink = document.querySelector(".movie");
const customerLink = document.querySelector(".customer");
const bookingLink = document.querySelector(".booking");
const addMovieBtn = document.querySelector("#add-movie-btn");

// CLOSE BUTTON/S
const closeButton = document.querySelector(".close");

// FORM CONTAINER
const movieContainer = document.querySelector(".movie-container");
const dashboardContainer = document.querySelector(".admin-content")
const customerContainer = document.querySelector(".customer-container");
const bookingContainer = document.querySelector(".booking-container");

const addMovieContainer = document.querySelector(".adding-movie-container");



// FUNCTIONS //
dashboardLink.addEventListener('click', function(){
    dashboardContainer.style.display = 'block';
    bookingContainer.style.display = 'none';
    movieContainer.style.display = 'none';
    customerContainer.style.display = 'none';

    dashboardLink.style.color = 'crimson';
    movieLink.style.color = 'white';
    customerLink.style.color = 'white';
    bookingLink.style.color = 'white';
});

movieLink.addEventListener('click', function(){
    movieContainer.style.display = 'block';
    bookingContainer.style.display = 'none';
    dashboardContainer.style.display = 'none';
    customerContainer.style.display = 'none';

    movieLink.style.color = 'crimson';
    dashboardLink.style.color = 'white';
    customerLink.style.color = 'white';
    bookingLink.style.color = 'white';
});

customerLink.addEventListener('click', function(){
    customerContainer.style.display = 'block';
    bookingContainer.style.display = 'none';
    dashboardContainer.style.display = 'none';
    movieContainer.style.display = 'none';

    customerLink.style.color = 'crimson';
    dashboardLink.style.color = 'white';
    movieLink.style.color = 'white';
    bookingLink.style.color = 'white';
});

// BOOKING
bookingLink.addEventListener('click', function(){
    bookingContainer.style.display = 'block';
    customerContainer.style.display = 'none';
    dashboardContainer.style.display = 'none';
    movieContainer.style.display = 'none';

    bookingLink.style.color = 'crimson';
    customerLink.style.color = 'white';
    dashboardLink.style.color = 'white';
    movieLink.style.color = 'white';
});


// DISPLAYING ADD MOVIE CONTAINER

addMovieBtn.addEventListener('click', () => {
    addMovieContainer.style.display = 'flex';
}, 5000);
// FUNCTION FOR CLOSING ADD MOVIE CONTAINER
closeButton.addEventListener('click', (e) => {
    addMovieContainer.style.display = 'none';
});