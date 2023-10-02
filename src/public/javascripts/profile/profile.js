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