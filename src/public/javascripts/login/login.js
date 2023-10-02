const login = (e) => {
    e.preventDefault();

    // Create a FormData object from the form
    const formData = new FormData(e.target);

    // Get values using FormData.get
    const username = formData.get('username');
    const password = formData.get('password');

    // Create headers for the request
    const headers = new Headers();
    headers.append('Content-Type', 'application/json');
    headers.append('Authorization', 'Basic ' + btoa(username + ':' + password));

    // Make the POST request
    fetch('/api/login', {
        method: 'POST',
        headers: headers,
    })
    .then(async response => {
        
        if (response.redirected) {
            // You can access the final redirected URL using response.url
            console.log('Redirected to:', response.url);
    
            // You might want to handle the redirect URL here
            // For example, redirect the browser to the new URL
            window.location.href = response.url;
        } else {
            // If not a redirect, proceed with handling the response
            const body = await response.json();
            throw new Error(body.message);
        }
    })
    .catch(error => {
        // Handle errors
        console.error('Error:', error);
    });
}





