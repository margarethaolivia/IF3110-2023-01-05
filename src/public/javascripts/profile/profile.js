const changeProfilePicture = (e) => {
    const selectedFile = e.target.files[0];

    if (selectedFile) {
        const formData = new FormData();
        formData.append('file', selectedFile);

        const xhr = new XMLHttpRequest();
        xhr.open('POST', '/api/profile/picture', true);

        xhr.addEventListener('load', () => {
            // Handle the successful upload response
            if (xhr.status === 200) {
                const data = JSON.parse(xhr.responseText);
                console.log('Upload successful:', data);

                const reader = new FileReader();

                reader.onload = function () {
                    // Update the 'src' attribute of the image element with ID 'profile_pic'
                    const profilePics = document.querySelectorAll('.profile_pic');
                    profilePics.forEach((profilePic) => {
                        profilePic.src = reader.result;
                    });
                };

                reader.readAsDataURL(selectedFile);

            } else {
                console.error('Error uploading file. Server returned:', xhr.status);
            }
        });

        xhr.addEventListener('error', () => {
            // Handle errors during the upload
            console.error('Error uploading file. Request failed.');
        });

        // Send the FormData with the file
        xhr.send(formData);
    }
}


const updateProfile = (e) => {
    e.preventDefault();

    // Create a FormData object from the form
    const formData = new FormData(e.target);

    // Get values using FormData.get
    const first_name = formData.get('first_name');
    const last_name = formData.get('last_name') ?? "";
    const old_password = formData.get('old_password');
    const new_password = formData.get('new_password');

    if (!(first_name || last_name || old_password || new_password))
    {
        console.log("No data changed");
        return;
    }

    if (first_name === "")
    {
        console.log("First name can not be empty");
        console.log(old_password);
        return;
    }

    if (old_password === "")
    {
        console.log("Old password required");
        return;
    }

    if (new_password === "")
    {
        console.log("New password required");
    }

    

    // Create headers for the request
    const headers = new Headers();
    headers.append('Content-Type', 'application/json');

    const postUrl = `/api/profile`;

    // Create a new XMLHttpRequest object
    const xhr = new XMLHttpRequest();
    // Set up the request
    xhr.open('POST', postUrl, true);
    xhr.setRequestHeader('Content-Type', 'application/json');

    // Set up the event handler for when the request completes
    xhr.onload = function () {
        if (xhr.status == 200) {
            const fullNameElement = document.getElementById('full_name');
            if (fullNameElement) {
                fullNameElement.textContent = first_name + ' ' + last_name;
            }

            if (first_name)
            {
                const firstNameInputElement = document.getElementById('first_name_input');

                if (firstNameInputElement)
                {
                    firstNameInputElement.value = null;
                }

                const lastNameInputElement = document.getElementById('last_name_input');
                if (lastNameInputElement)
                {
                    lastNameInputElement.value = null;
                }
            }

            if (old_password && new_password)
            {
                const oldPasswordInputElement = document.getElementById('old_password_input');

                if (oldPasswordInputElement)
                {
                    oldPasswordInputElement.value = null;
                }

                const newPasswordInputElement = document.getElementById('new_password_input');
                if (newPasswordInputElement)
                {
                    newPasswordInputElement.value = null;
                }
            }

            // If not a redirect, proceed with handling the response
            const data = JSON.parse(xhr.responseText);
            // Handle the response data
            console.log('Response:', data);

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

     // Create the request body
     const requestBody = JSON.stringify({ first_name, last_name, old_password, new_password });
    console.log(requestBody);
     // Send the request with the body
     xhr.send(requestBody);
}





