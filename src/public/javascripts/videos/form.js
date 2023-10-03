const uploadVideo = (e) => {
  e.preventDefault();

  // Create a FormData object from the form
  const formData = new FormData(e.target);

  // Get values using FormData.get
  const title = formData.get("title");
  const thumbnail = formData.get("thumbnail").name;
  const video_file = formData.get("video_file").name;
  const video_desc = formData.get("description") ?? "";
  const tags = formData.get("tags") ?? "";

  // Create an XMLHttpRequest object
  const xhr = new XMLHttpRequest();
  xhr.open("POST", "/api/videos", true);

  // Set headers
  xhr.setRequestHeader("Content-Type", "application/json");

  // Set up the callback for when the request completes
  xhr.onload = function () {
    if (xhr.status === 200) {
      // // Redirect to /myvideos
      // console.log("Redirected to: /myvideos");
      // window.location.href = "/myvideos";
    } else {
      // If not a redirect, proceed with handling the response
      const data = JSON.parse(xhr.responseText);
      // Handle the response data
      console.log("Response:", data);
    }
  };

  // Set up the callback for errors
  xhr.onerror = function (error) {
    // Handle errors
    console.error("Error:", error);
  };

  // Create the request body
  const requestBody = JSON.stringify({
    title,
    thumbnail,
    video_file,
    video_desc,
  });
  console.log(requestBody);

  // Send the request with the body
  xhr.send(requestBody);
};
