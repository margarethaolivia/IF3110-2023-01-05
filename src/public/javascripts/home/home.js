sessionStorage.setItem('pagination_base_url', '/api/videos');

document.addEventListener('DOMContentLoaded', function() {
    const searchValue = sessionStorage.getItem('searchValue') ?? "";

    if (searchValue)
    {
        const searchBar = document.getElementById('searchBar');

        if (searchBar)
        {
            searchBar.value = searchValue;
        }
    
        sessionStorage.removeItem('searchValue');
    }
    getVideoList({searchValue})
});

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
                const xhr = new XMLHttpRequest();
                const apiUrl = `/api/videos?search=${encodeURIComponent(searchValue)}`;
                
                xhr.open('GET', apiUrl, true);

                xhr.onload = function() {
                    const htmlResponse = xhr.responseText;
                    if (xhr.status === 200) {
                        const htmlResponse = xhr.responseText;
                        // Assuming that the response is a valid HTML string
                        const parser = new DOMParser();
                        const doc = parser.parseFromString(htmlResponse, 'text/html');

                        // Assuming the video-list is a div element where you want to append the HTML
                        const videoListContainer = document.getElementById('video-list');

                        // Clear existing content in the container
                        videoListContainer.innerHTML = '';

                        // Append the new content
                        const bodyChildren = Array.from(doc.body.children);
                        bodyChildren.forEach(child => {
                            videoListContainer.appendChild(child.cloneNode(true));
                        });
                    }

                    else
                    {
                        jsonResponse = JSON.parse(xhr.responseText);
                        showToast(jsonResponse.message);
                    }
                };

                xhr.onerror = function() {
                    // Handle errors
                    jsonResponse = JSON.parse(xhr.responseText);
                    showToast(jsonResponse.message);
                };

                // Send the request
                xhr.send();
            }
        }
    }, 1000);
});