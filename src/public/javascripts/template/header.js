let timer;
const searchBar = document.getElementById('searchBar');

searchBar.addEventListener('input', function() {
    clearTimeout(timer);
    
    // Start a new timer
    timer = setTimeout(function() {
        // Get the search value
        const searchValue = searchBar.value;

        // Check if the search value has changed
        if (searchValue.trim() !== '') {
            // Check if the current page is not the home page
            if (window.location.pathname !== '/') {
                // Set the search value in sessionStorage
                sessionStorage.setItem('searchValue', searchValue);

                // Redirect to the home page
                window.location.href = '/';
            }

            else {
                getVideoList({searchValue});
            }
        }
    }, 1000);
});

const container = document.getElementById('horizontal-scroll-container');

const openSidebar = (e) => {
    const sidebar = document.getElementById('sidebar');

    if (sidebar) {
        sidebar.style.visibility = 'visible';
    }
}




