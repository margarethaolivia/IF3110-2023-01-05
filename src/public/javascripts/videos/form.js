const uploadVideo = (e) => {
  e.preventDefault();
  console.log("huh")
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
    if (xhr.status === 200) {
      console.log("Redirected to: /myvideos");
      window.location.href = "/myvideos";
    } else {
      // If not a redirect, proceed with handling the response
      const data = JSON.parse(xhr.responseText);
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
