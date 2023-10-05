sessionStorage.setItem('pagination_base_url', '/api/takedowns');

document.addEventListener('DOMContentLoaded', function() {
    getVideoList({baseUrl: '/api/takedowns'})
});