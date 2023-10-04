const onThumbnailChange = (e) => {
  const selectedFile = e.target.files[0];
  const container = document.querySelector('.thumbnail-image');
  const noThumbnailText = document.querySelector('.no-thumbnail-text');
  const imageId = 'thumbnail-preview';

  if (selectedFile) {
    // If a file is selected, set the source of the thumbnailPreview
    const reader = new FileReader();

    reader.onload = function () {
      var thumbnailPreview = document.getElementById(imageId)

      if (!thumbnailPreview) {
        // Create a new img element
        thumbnailPreview = document.createElement('img');
        thumbnailPreview.id = 'thumbnail-preview';
        container.appendChild(thumbnailPreview);
      }

      thumbnailPreview.src = reader.result;
      noThumbnailText.style.display = 'none'; // Hide the text
    };

    reader.readAsDataURL(selectedFile);

  } else {
    var thumbnailPreview = document.getElementById(imageId)

      if (thumbnailPreview) {
        
        thumbnailPreview.remove();
      }
    noThumbnailText.style.display = 'flex'; // Show the text
  }
};


const uploadVideo = (e) => {
  e.preventDefault();
  // Create a FormData object from the form
  const formData = new FormData(e.target);

  // Get values using FormData.get
  const title = formData.get("title");

  if (!title) {
    showToast('Title is required');
    return;
  }

  if (!formData.has('video_file') || formData.get('video_file').size === 0) {
    showToast("Please select video to be uploaded");
    return;
  }

  if (!formData.has('thumbnail') || formData.get('thumbnail').size === 0)
  {
    showToast('Thumbnail is required');
    return;
  }
  
  const xhr = new XMLHttpRequest();
  xhr.open("POST", "/api/videos", true);

  xhr.onload = function () {
    console.log(xhr.responseText);
    const data = JSON.parse(xhr.responseText);
    if (xhr.status === 200) {
      showToast(data.message);
      // console.log("Redirected to: /myvideos");
      // window.location.href = "/myvideos";
    } else {
      // If not a redirect, proceed with handling the response
      // Handle the response data
      showToast(data.message);
    }
  };

  xhr.onprogress = function () {

  }

  // Set up the callback for errors
  xhr.onerror = function (error) {
    // Handle errors
    showToast(error);
  };

  xhr.send(formData);
};
