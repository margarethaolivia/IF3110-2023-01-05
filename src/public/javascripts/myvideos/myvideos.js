document.addEventListener('DOMContentLoaded', function() {
    const successMessage = sessionStorage.getItem('formSuccessMessage');
    if (successMessage) {
        // Display the success message
        showToast(successMessage);

        // Clear the success message from session storage
        sessionStorage.removeItem('formSuccessMessage');
    }
});

const submitDeleteAction = (videoId) =>
{   
    // Create a new XMLHttpRequest object
    const xhr = new XMLHttpRequest();
    // Set up the request
    const requestUrl = `/api/myvideos/${videoId}`;
    xhr.open('DELETE', requestUrl, true);

    // Set up the event handler for when the request completes
    xhr.onload = function () {
        if (xhr.status == 200) {
            // Remove the DOM element with the ID "card-{videoId}"
            const videoCardElement = document.getElementById(`card-${videoId}`);
            if (videoCardElement) {
                videoCardElement.remove();
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
    xhr.send();
}

const deleteMyVideo = (e, videoId, popUpId) =>
{
    e.preventDefault();
    showPopUp(
        popUpId, 
        () => submitDeleteAction(videoId)
    );
}