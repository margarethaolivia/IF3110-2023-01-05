
// Function to remove all additional event listeners of a specific type from an element
const changeProfilePicture = (e) => {
    const selectedFile = e.target.files[0];

    if (selectedFile) {
        const formData = new FormData();
        formData.append('profile_pic', selectedFile);

        const xhr = new XMLHttpRequest();
        xhr.open('POST', '/api/profile/picture', true);

        xhr.addEventListener('load', () => {
            // Handle the successful upload response
            if (xhr.status === 200) {
                const data = JSON.parse(xhr.responseText);
                showToast('Upload successful');

                const reader = new FileReader();

                reader.onload = function () {

                    // Update the 'src' attribute of the image element with ID 'profile_pic'
                    const profilePics = document.querySelectorAll('.profile_pic');
                    profilePics.forEach((profilePic) => {
                        profilePic.src = reader.result;
                    });

                    if (profilePics.length === 0)
                    {
                        // Remove child elements with class "profile_svg"
                        const profilePicture = document.querySelector('.profile-picture');
                        const profileLink = document.querySelector('.profile-link');

                        // Remove child elements with class "profile_svg"
                        const profileSvgElements = document.querySelectorAll('.profile_svg');
                        profileSvgElements.forEach((profileSvg) => {
                            profileSvg.remove();
                        });

                        // Add the new image element with class "profile_pic"
                        const newImage1 = document.createElement('img');
                        newImage1.classList.add('profile_pic');
                        newImage1.src = reader.result;

                        const newImage2 = document.createElement('img');
                        newImage2.classList.add('profile_pic');
                        newImage2.src = reader.result;

                        // Append the new image to the desired elements
                        profilePicture.appendChild(newImage1);
                        profileLink.appendChild(newImage2);
                    }
                };

                reader.readAsDataURL(selectedFile);

            } else {
                const data = JSON.parse(xhr.responseText);
                showToast(data.message);
            }
        });

        xhr.addEventListener('error', (err) => {
            // Handle errors during the upload
            showToast(err);
        });

        // Send the FormData with the file
        xhr.send(formData);
    }
}

const submitProfileUpdate = (body) =>
{   
    const requestBody = JSON.stringify(body);

    // Create headers for the request
    const headers = new Headers();
    headers.append('Content-Type', 'application/json');

    const requestUrl = `/api/profile`;

    // Create a new XMLHttpRequest object
    const xhr = new XMLHttpRequest();
    // Set up the request
    xhr.open('PATCH', requestUrl, true);
    xhr.setRequestHeader('Content-Type', 'application/json');

    // Set up the event handler for when the request completes
    xhr.onload = function () {
        if (xhr.status == 200) {

            const {first_name, last_name, old_password, new_password} = body;

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
            showToast(data.message);

        } else {
            // If not a redirect, proceed with handling the response
            const data = JSON.parse(xhr.responseText);
            // Handle the response data
            showToast(data.message);
        }
    };

    // Set up the event handler for network errors
    xhr.onerror = function () {
        // Handle errors
        console.error('Error:', xhr.statusText);
    };

     // Send the request with the body
    xhr.send(requestBody);
}

const updateProfile = (e, popUpId) => {
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
        showToast("No data changed");
        return;
    }

    if (first_name === "")
    {
        showToast("First name can not be empty");
        return;
    }

    if (old_password === "")
    {
        showToast("Old password required");
        return;
    }

    if (new_password === "")
    {
        showToast("New password required");
    }

    showPopUp(
        popUpId, 
        () => submitProfileUpdate({ first_name, last_name, old_password, new_password })
    )

    
}





