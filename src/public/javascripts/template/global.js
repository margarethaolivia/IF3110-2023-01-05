sessionStorage.setItem('page', 1);
sessionStorage.removeItem('tag');

/* DROPDOWN */

document.addEventListener('click', function (event) {
    const menus = document.querySelectorAll('.dropdown-menu-multiple, .dropdown-menu')
    menus.forEach(function (menu) {
        const dropdown = menu.closest('.dropdown, .dropdown-multiple');
        if (menu.style.display === 'block' && !dropdown.contains(event.target)) {      
            menu.style.display = 'none';
            toggleDropDown(dropdown);
        }
    })

});
/*Single Dropdown Menu*/

var dropdowns = document.querySelectorAll('.dropdown');

    dropdowns.forEach(function (dropdown) {
    dropdown.addEventListener('click', function () {
        this.setAttribute('tabindex', 1);
        this.classList.toggle('active');
        var menu = this.querySelector('.dropdown-menu');
        if (menu.style.display === 'block') {
            menu.style.display = 'none';
        } else {
            menu.style.display = 'block';
        }
    });

    dropdown.addEventListener('focusout', function () {
        this.classList.remove('active');
        this.querySelector('.dropdown-menu').style.display = 'none';
    });

    var menuItems = dropdown.querySelectorAll('.dropdown-menu li');
    menuItems.forEach(function (item) {
        item.addEventListener('click', function () {
            var dropdownSpan = this.closest('.dropdown').querySelector('span');
            dropdownSpan.textContent = this.textContent;

            var dropdownInput = this.closest('.dropdown').querySelector('input');
            dropdownInput.setAttribute('value', this.getAttribute('id'));
        });
    });
});

/*Multiple Dropdown Menu*/

var dropdowns = document.querySelectorAll('.dropdown-multiple');

const toggleDropDown = (dropdown) => {
    dropdown.setAttribute('tabindex', 1);
    dropdown.classList.toggle('active');
}

const toggleOption = (option) => {

    option.classList.toggle('active');
}

dropdowns.forEach(function (dropdown) {
  dropdown.addEventListener('click', function (event) {
    
    var menu = this.querySelector('.dropdown-menu-multiple');
    if (menu.style.display === 'block') {
        if (!menu.contains(event.target))
        {
            menu.style.display = 'none';
            toggleDropDown(this);
        }
    } else {
        toggleDropDown(this);
        menu.style.display = 'block';
    }
  });

  dropdown.addEventListener('focusout', function () {
    this.classList.remove('active');
    this.querySelector('.dropdown-menu-multiple').style.display = 'none';
  });

  var menuItems = dropdown.querySelectorAll('.dropdown-menu-multiple li');
  menuItems.forEach(function (item) {
    item.addEventListener('click', function () {
        toggleOption(this);
    //   var dropdownInput = this.closest('.dropdown').querySelector('input');
    //   dropdownInput.setAttribute('value', this.getAttribute('id'));
    });
  });
});

// VIDEOS
function watchVideo(event, videoId) {
    const target = event.target;

    // Check if the clicked element is one of the buttons
    const isButton = target.closest('.video-edit-button') || target.closest('.video-delete-button');

    if (!isButton) {
        // Redirect to /videos/videoid
        window.location.href = `/videos/${videoId}`;
    }
}

function closeToast(toastContainer, toastElement) {
    // Remove the provided toast element
    toastElement.classList.add('disappear');
    setTimeout(() => {
        toastContainer.removeChild(toastElement);
    }, 500); 
}

function showToast(message, duration = 5000) {
    const limit = 3;

    const toastContainer = document.querySelector('.toast-container');
    // Check if the maximum limit is reached
    
    var num = toastContainer.children.length;

    while (num >= limit) {
        // Check if the first child is an element node
        if (toastContainer.firstChild instanceof Element) {
            toastContainer.removeChild(toastContainer.firstChild);
        } else {
            // If it's not an element node, remove it in a different way
            toastContainer.removeChild(toastContainer.childNodes[0]);
        }
    
        // Update the count after removing a child
        num = toastContainer.children.length;
    }
    
    // Create a new toast element
    const newToast = document.createElement('div');
    newToast.classList.add('flex', 'flex-col', 'items-center', 'justify-between', 'toast');
    newToast.innerHTML = `
        <div class="toast-value-container no-scrollbar">
            <p>${message}</p>
        </div>
        <button class="close-button">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    `;

    const closeButton = newToast.querySelector('.close-button');
    closeButton.addEventListener('click', () => {
        closeToast(toastContainer, newToast);
    });

    // Add the new toast to the container
    toastContainer.appendChild(newToast);
    setTimeout(() => {
        newToast.classList.add('appear');
    }, 10); // Adjust the delay as needed

    setTimeout(() => {
        // Check if the toast still exists in the DOM before attempting to remove it
        if (newToast.parentNode === toastContainer) {
            newToast.classList.add('disappear');
        }
    }, duration);

    // Set a timer to remove the toast after the specified duration
    setTimeout(() => {
        // Check if the toast still exists in the DOM before attempting to remove it
        if (newToast.parentNode === toastContainer) {
            toastContainer.removeChild(newToast);
        }
    }, duration + 500);
}


const closePopUp = (e) => {

    const targetElement = e.target;
    const popupContainers = document.getElementsByClassName('popup-container');

    // Check if the clicked element is a child of any popup container
    Array.from(popupContainers).forEach((popupContainer) => {
        if (popupContainer.contains(targetElement)) {
            popupContainer.style.display = 'none';
        }
    });
    
}

const addPopUpAction = (popUpElement, action) => {
    const actionButton = popUpElement.querySelector('.action-button');
    const initialAction = actionButton.onclick;

    if (actionButton && initialAction) {
        const actions = () => {
            action();
            closePopUp({target: actionButton});
            actionButton.onclick = initialAction;
        }
        
        actionButton.onclick = actions;
    }
}

const showPopUp = (popUpId, action) => {
    const popUpElement = document.getElementById(popUpId);

    if (popUpElement) {
        // Find the button with class "action-button" inside the popUpElement
        addPopUpAction(popUpElement, action);

        // Set the display of popUpElement to block
        popUpElement.style.display = 'flex';
    }
};


const getVideoList = ({page= 1, searchValue= "", tag= "", baseUrl='/api/videos'}) =>
{
    const xhr = new XMLHttpRequest();
    const apiUrl = `${baseUrl}?page=${encodeURIComponent(page)}&search=${encodeURIComponent(searchValue)}&tag=${encodeURIComponent(tag)}`;
    xhr.open('GET', apiUrl, true);

    xhr.onload = function() {
        const jsonResponse = JSON.parse(xhr.responseText);
        if (xhr.status === 200) {   
            const body = jsonResponse.body;

            const emptyMessageElement = document.getElementById('empty-message');

            // Assuming that the response is a valid HTML string
            const parser = new DOMParser();
            const doc = parser.parseFromString(body.video_list_html, 'text/html');

            // Assuming the video-list is a div element where you want to append the HTML
            const videoListContainer = document.getElementById('video-list');

            // Clear existing content in the container
            videoListContainer.innerHTML = '';

            // Append the new content
            const bodyChildren = Array.from(doc.body.children);
            bodyChildren.forEach(child => {
                videoListContainer.appendChild(child.cloneNode(true));
            });

            if (emptyMessageElement)
            {
                if (body.video_list_html)
                {
                    emptyMessageElement.style.display = 'none';
                }

                else
                {
                    emptyMessageElement.style.display = 'block';
                }
            }

            sessionStorage.setItem('total_page', body.total_page);

            const paginationContainer = document.getElementById('pagination-container');
            if (paginationContainer)
            {

                const existingPagination = Array.from(paginationContainer.children);
                existingPagination.forEach(child => {
                    child.remove();
                });
                
                if (body.total_page > 1)
                {
                    const pagination = parser.parseFromString(body.pagination_html, 'text/html');
                    const children = Array.from(pagination.body.children);
                    children.forEach(child => {
                        paginationContainer.appendChild(child.cloneNode(true));
                    });   
                }
            }
            
            
            sessionStorage.setItem('page', page);
        }

        else
        {
            showToast(jsonResponse.message);
        }
    };

    xhr.onerror = function() {
        // Handle errors
        jsonResponse = JSON.parse(xhr.responseText);
        showToast(jsonResponse.message);
    };

    // Send the request
    xhr.send();
}

const movePage = (buttonString) => {
    var search = "";
    const tag = sessionStorage.getItem('tag') ?? "";
    var page = null;

    if (buttonString === "next")
    {
        page = Math.min(parseInt(sessionStorage.getItem('page')) + 1, sessionStorage.getItem('total_page') ?? 1);
    }

    else if (buttonString === "prev")
    {
        page = Math.max(parseInt(sessionStorage.getItem('page')) - 1, 1);
    }

    else
    {
        page = parseInt(buttonString);
    }

    const searchBar = document.getElementById('searchBar');

    if (searchBar)
    {
        search = searchBar.value;
    }

    getVideoList({page, searchValue: search, tag, baseUrl: sessionStorage.getItem('pagination_base_url') ?? undefined});
}