const signup = (e) => {
    e.preventDefault();

    // Create a FormData object from the form
    const formData = new FormData(e.target);

    // Get values using FormData.get
    const username = formData.get('username');
    const password = formData.get('password');
    const confirmPassword = formData.get('confirm_password');
    const first_name = formData.get('first_name');
    const last_name = formData.get('last_name') ?? "";

    if (password !== confirmPassword) {
        showToast("Passwords do not match");
        return;
    }

    const currentUrl = new URL(window.location.href);

    // Get the current redirect query parameter
    const redirectParam = currentUrl.searchParams.get('redirect');
    const postUrl = `/api/users?redirect=${redirectParam ?? "/"}`;

    // Create an XMLHttpRequest object
    const xhr = new XMLHttpRequest();

    // Configure it with method, URL, and async flag
    xhr.open('POST', postUrl, true);

    // Set headers
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.setRequestHeader('Authorization', 'Basic ' + btoa(username + ':' + password));

    // Set up the callback for when the request completes
    xhr.onload = function () {
        if (xhr.status === 200) {
            // You can access the final redirected URL using xhr.getResponseHeader('Location')
            // You might want to handle the redirect URL here
            window.location.href = xhr.responseURL;
        } else {
            // If not a redirect, proceed with handling the response
            const data = JSON.parse(xhr.responseText);
            // Handle the response data
            showToast(data.message);
        }
    };

    // Set up the callback for errors
    xhr.onerror = function (error) {
        // Handle errors
        console.error('Error:', error);
    };

    // Create the request body
    const requestBody = JSON.stringify({ first_name, last_name });

    // Send the request with the body
    xhr.send(requestBody);
};




