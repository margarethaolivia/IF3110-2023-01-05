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

const selectElements = document.getElementsByClassName('custom-select');

// Loop through each select element
for (var j = 0; j < selectElements.length; j++) {
    // Get the option elements within each select
    var optionElements = selectElements[j].getElementsByTagName('option');

    // Loop through the option elements and add the custom class
    for (var i = 0; i < optionElements.length; i++) {
        optionElements[i].classList.add('custom-option');
    }
}

const openSidebar = (e) => {
    const sidebar = document.getElementById('sidebar');

    if (sidebar) {
        sidebar.style.visibility = 'visible';
    }
}




