const closeSidebar = (e) => {
    const sidebar = document.getElementById('sidebar');

    if (sidebar) {
        sidebar.style.visibility = 'hidden';
    }
}

const logout = (e) => {

    // Create headers for the request
    const headers = new Headers();
    headers.append('Content-Type', 'application/json');

    const postUrl = `/api/logout`;

    // Create a new XMLHttpRequest object
    const xhr = new XMLHttpRequest();
    // Set up the request
    xhr.open('POST', postUrl, true);
    xhr.setRequestHeader('Content-Type', 'application/json');

    // Set up the event handler for when the request completes
    xhr.onload = function () {
        if (xhr.status == 200) {
            // You can access the final redirected URL using xhr.getResponseHeader('Location')
            console.log('Redirected to:', xhr.responseURL);

            // You might want to handle the redirect URL here
            window.location.href =  xhr.responseURL;
        } else {
            // If not a redirect, proceed with handling the response
            const data = JSON.parse(xhr.responseText);
            // Handle the response data
            console.log('Response:', data);
        }
    };

    // Set up the event handler for network errors
    xhr.onerror = function () {
        // Handle errors
        console.error('Error:', xhr.statusText);
    };

    // Send the request with the form data
    xhr.send();
}