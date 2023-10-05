const updateVideoFileDesc = (selectedFile) => {
  const videoFileDesc = document.querySelector('.video-file-desc');

  if (selectedFile) {
    // If a file is selected, set the text to the file name and size
    const fileName = selectedFile.name;
    const fileSize = selectedFile.size;

    let sizeText;
    if (fileSize >= 1024 ** 2) {
      // Convert size to MB if greater than or equal to 1000 KB
      const fileSizeInMB = (fileSize / (1024 ** 2)).toFixed(2);
      sizeText = `${fileSizeInMB} MB`;
    } else {
      // Display size in KB
      sizeText = `${(fileSize / 1024).toFixed(2)} KB`;
    }

    videoFileDesc.textContent = `${fileName} - ${sizeText}`;
  } else {
    // If no file is selected, set the text to the default message
    videoFileDesc.textContent = 'Upload your video here';
  }
};

const onVideoChange = (e) => {
  const selectedFile = e.target.files[0];
  updateVideoFileDesc(selectedFile);
};

const onThumbnailChange = (e, keepValue=false) => {
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

      if (noThumbnailText)
      {
        noThumbnailText.style.display = 'none'; // Hide the text
      }
    };

    reader.readAsDataURL(selectedFile);

  } else if (!keepValue) {
    var thumbnailPreview = document.getElementById(imageId)

      if (thumbnailPreview) {
        
        thumbnailPreview.remove();
      }
    noThumbnailText.style.display = 'flex'; // Show the text
  }
};

const submitVideoUpdate = (videoId, formData) => {
  const xhr = new XMLHttpRequest();
  xhr.open("POST", `/api/myvideos/${videoId}`, true);

  xhr.onload = function () {
    const data = JSON.parse(xhr.responseText);
    if (xhr.status === 200) {
      sessionStorage.setItem('formSuccessMessage', data.message);
      window.location.href = "/myvideos";
    } else {
      // If not a redirect, proceed with handling the response
      // Handle the response data
      showToast(data.message);
    }
  };

  // Set up the callback for errors
  xhr.onerror = function (error) {
    // Handle errors
    showToast(error);
  };

  xhr.send(formData);
}

const updateVideo = (e, videoId, popUpId) => {
  e.preventDefault();

  // Create a FormData object from the form
  const formData = new FormData(e.target);

  // Get values using FormData.get
  const title = formData.get("title");
  if (!title) {
    showToast('Title is required');
    return;
  }
  
  showPopUp(popUpId, () => submitVideoUpdate(videoId, formData));
}

const submitVideoUpload = (formData) => {
  
  const xhr = new XMLHttpRequest();
  xhr.open("POST", "/api/videos", true);

  xhr.onload = function () {
    const data = JSON.parse(xhr.responseText);
    if (xhr.status === 201) {
      sessionStorage.setItem('formSuccessMessage', data.message);
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
}

const uploadVideo = (e, popUpId) => {
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
  
  showPopUp(popUpId, () => submitVideoUpload(formData));
};
