let timer;
const searchBar = document.getElementById('searchBar');
const timeLimit = 1000;
sessionStorage.removeItem('lastSearch');

const selectElements = document.getElementsByClassName('custom-select');

// Loop through each select element
for (var j = 0; j < selectElements.length; j++) {
    // Get the option elements within each select
    var optionElements = selectElements[j].getElementsByTagName('option');

    // Loop through the option elements and add the custom class
    for (var i = 0; i < optionElements.length; i++) {
        optionElements[i].classList.add('custom-option');
    }
}

const scrollContainers = document.getElementsByClassName('horizontal-scroll-container');

Array.from(scrollContainers).forEach((scrollContainer) => {
    scrollContainer.addEventListener('wheel', function(event) {
        // Adjust the scrollLeft property based on the wheel delta
        scrollContainer.scrollLeft += event.deltaY;
    
        // Prevent the default scroll behavior
        event.preventDefault();
    })
})

searchBar.addEventListener('input', function() {
    clearTimeout(timer);
    
    // Start a new timer
    timer = setTimeout(function() {
        // Get the search value
        const searchValue = searchBar.value.trim();

        // Check if the current page is not the home page
        if (window.location.pathname !== '/') {
            // Set the search value in sessionStorage
            sessionStorage.setItem('searchValue', searchValue);

            // Redirect to the home page
            window.location.href = '/';
        }

        else {
            if (!(sessionStorage.getItem('lastSearch') && sessionStorage.getItem('lastSearch') === searchValue))
            {
                getVideoList({searchValue});
                sessionStorage.setItem('lastSearch', searchValue);
            }
        }
    }, timeLimit);
});

const filterParent = document.querySelector('.filters');
filterParent.style.justifyContent = 'end';

const openSidebar = (e) => {
    const sidebar = document.getElementById('sidebar');

    if (sidebar) {
        sidebar.style.visibility = 'visible';
    }
}

const showTags = (event) => {
    const tagsContainer = document.getElementById('tags-container');
    const officialCategoriesContainer = document.getElementById('official-categories-container');

    tagsContainer.classList.remove('hidden');
    officialCategoriesContainer.classList.add('hidden');
    filterParent.style.justifyContent = 'space-between';
}

const showOfficialCategories = (event) => {
    const tagsContainer = document.getElementById('tags-container');
    const officialCategoriesContainer = document.getElementById('official-categories-container');

    tagsContainer.classList.add('hidden');
    officialCategoriesContainer.classList.remove('hidden');
    filterParent.style.justifyContent = 'space-between';
}

const selectFilter = (button) =>
{
    // Get the parent container
    const parent = button.closest('.scrollmenu');

    // Remove "selected" class from all children of the parent
    const children = parent.querySelectorAll('.badge');
    children.forEach(child => {
        child.classList.remove('selected');
    });

    // Set "selected" class to the clicked button
    button.classList.add('selected');
}

const setFilter = (event, filterValue, itemName) =>
{ 
    clearTimeout(timer);

    const oldValue = sessionStorage.getItem(itemName);

    if (oldValue !== filterValue)
    {
        selectFilter(event.currentTarget);
        sessionStorage.setItem(itemName, filterValue);

        timer = setTimeout(function() {
            getVideoList({})
        }, timeLimit);
    }
}


const setCategory = (event, category, itemName, callback) => {
    clearTimeout(timer);
    var newCategories = [];
    setTimeout((target) => {

        const oldCategories = JSON.parse(sessionStorage.getItem(itemName));
    
        newCategories = oldCategories;

        if (target.classList.contains('active'))
        {
            if (!newCategories.includes(category))
            {
                newCategories.push(category);
            }
        }

        else
        {
            newCategories = newCategories.filter((elmt) => elmt != category);
        }

        sessionStorage.setItem(itemName, JSON.stringify(newCategories));

    }, 50, event.currentTarget);

    timer = setTimeout(function() {
        callback();
    }, timeLimit);
}

searchCategoryCallback = () => {
    const searchBar = document.getElementById('searchBar');

    if (searchBar && searchBar.value)
    {
        getVideoList({searchValue: searchBar.value});
    }
}

sortCategoryCallback = () => {
    getVideoList({});
}






