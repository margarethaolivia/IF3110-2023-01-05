const signup = async (e) => {
    e.preventDefault();

    // Create a FormData object from the form
    const formData = new FormData(e.target);

    // Get values using FormData.get
    const username = formData.get('username');
    const password = formData.get('password');
    const confirmPassword = formData.get('confirm_password');
    const first_name = formData.get('first_name');
    const last_name = formData.get('last_name') ?? "";

    if (password !== confirmPassword)
    {
        console.log("man");
        return;
    }

    // Create headers for the request
    const headers = new Headers();
    headers.append('Content-Type', 'application/json');
    headers.append('Authorization', 'Basic ' + btoa(username + ':' + password));

    // Create the request body
    const requestBody = JSON.stringify({ first_name, last_name });

    // Make the POST request
    fetch('/api/users', {
        method: 'POST',
        headers: headers,
        body: requestBody
    })

    .then(async response => {
        if (!response.ok) {
            const body = await response.json()
           
            throw new Error(body.message);
        }
        return response.json();
    })
    .then(data => {
        // Handle the response data
        console.log('Response:', data);
    })
    .catch(error => {
        // Handle errors
        console.error('Error:', error);
    });
}





