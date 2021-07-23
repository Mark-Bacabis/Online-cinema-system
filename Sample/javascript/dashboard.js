// NAVIGATION LINK BUTTON // 
const dashboardLink = document.querySelector(".dashboard");
const movieLink = document.querySelector(".movie");
const customerLink = document.querySelector(".customer");
const bookingLink = document.querySelector(".booking");
//const cinemaLink = document.querySelector(".cinema");
const addMovieBtn = document.querySelector("#add-movie-btn");

// CLOSE BUTTON/S
const closeButton = document.querySelector(".close");

// FORM CONTAINER
const movieContainer = document.querySelector(".movie-container");
const dashboardContainer = document.querySelector(".admin-content")
const customerContainer = document.querySelector(".customer-container");
const bookingContainer = document.querySelector(".booking-container");
//const cinemaContainer = document.querySelector(".cinema-container");

const addMovieContainer = document.querySelector(".adding-movie-container");



// FUNCTIONS //
// DASHBOARD
dashboardLink.addEventListener('click', function(){
    dashboardContainer.style.display = 'block';
    bookingContainer.style.display = 'none';
    movieContainer.style.display = 'none';
    customerContainer.style.display = 'none';
    //cinemaContainer.style.display = 'none';

    dashboardLink.style.color = 'crimson';
    movieLink.style.color = 'white';
    customerLink.style.color = 'white';
    bookingLink.style.color = 'white';
    //cinemaLink.style.color = 'white';
});
// MOVIE
movieLink.addEventListener('click', function(){
    movieContainer.style.display = 'block';
    bookingContainer.style.display = 'none';
    dashboardContainer.style.display = 'none';
    customerContainer.style.display = 'none';
    //cinemaContainer.style.display = 'none';

    movieLink.style.color = 'crimson';
    dashboardLink.style.color = 'white';
    customerLink.style.color = 'white';
    bookingLink.style.color = 'white';
    //cinemaLink.style.color = 'white';
});
// CUSTOMER
customerLink.addEventListener('click', function(){
    customerContainer.style.display = 'block';
    bookingContainer.style.display = 'none';
    dashboardContainer.style.display = 'none';
    movieContainer.style.display = 'none';
    //cinemaContainer.style.display = 'none';

    customerLink.style.color = 'crimson';
    dashboardLink.style.color = 'white';
    movieLink.style.color = 'white';
    bookingLink.style.color = 'white';
    //cinemaLink.style.color = 'white';
});

// BOOKING
bookingLink.addEventListener('click', function(){
    bookingContainer.style.display = 'block';
    customerContainer.style.display = 'none';
    dashboardContainer.style.display = 'none';
    movieContainer.style.display = 'none';
    //cinemaContainer.style.display = 'none';

    bookingLink.style.color = 'crimson';
    customerLink.style.color = 'white';
    dashboardLink.style.color = 'white';
    movieLink.style.color = 'white';
    //cinemaLink.style.color = 'white';
});

/* CINEMA
cinemaLink.addEventListener('click', function(){

    cinemaContainer.style.display = 'block';
    bookingContainer.style.display = 'none';
    customerContainer.style.display = 'none';
    dashboardContainer.style.display = 'none';
    movieContainer.style.display = 'none';

    // LINK COLOR WHEN CLICKED
    cinemaLink.style.color = 'crimson';
    bookingLink.style.color = 'white';
    customerLink.style.color = 'white';
    dashboardLink.style.color = 'white';
    movieLink.style.color = 'white'; 
}); */

// DISPLAYING ADD MOVIE CONTAINER
addMovieBtn.addEventListener('click', () => {
    addMovieContainer.style.display = 'flex';
});

// FUNCTION FOR CLOSING ADD MOVIE CONTAINER
closeButton.addEventListener('click', (e) => {
    addMovieContainer.style.display = 'none';
});