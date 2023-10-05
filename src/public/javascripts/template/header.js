let timer;
const searchBar = document.getElementById('searchBar');
sessionStorage.removeItem('lastSearch');

searchBar.addEventListener('input', function() {
    clearTimeout(timer);
    
    // Start a new timer
    timer = setTimeout(function() {
        // Get the search value
        const searchValue = searchBar.value.trim();

        // Check if the current page is not the home page
        if (window.location.pathname !== '/') {
            // Set the search value in sessionStorage
            sessionStorage.setItem('searchValue', searchValue);

            // Redirect to the home page
            window.location.href = '/';
        }

        else {
            if (!(sessionStorage.getItem('lastSearch') && sessionStorage.getItem('lastSearch') === searchValue))
            {
                getVideoList({searchValue});
                sessionStorage.setItem('lastSearch', searchValue);
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




