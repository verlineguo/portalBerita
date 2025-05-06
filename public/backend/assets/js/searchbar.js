// Dashboard Search Bar Functionality

// Wait for document to be ready
document.addEventListener('DOMContentLoaded', function() {
    // Elements
    const searchBar = document.querySelector('.search-bar');
    const searchInput = document.querySelector('.search-control');
    const searchShow = document.querySelector('.search-show');
    const searchClose = document.querySelector('.search-close');
    const resultContainer = document.createElement('div');
    
    // Add class to result container
    resultContainer.classList.add('search-results');
    searchBar.appendChild(resultContainer);
    
    // Style search results container
    resultContainer.style.position = 'absolute';
    resultContainer.style.top = '100%';
    resultContainer.style.left = '0';
    resultContainer.style.right = '0';
    resultContainer.style.backgroundColor = '#fff';
    resultContainer.style.boxShadow = '0 5px 15px rgba(0,0,0,0.1)';
    resultContainer.style.borderRadius = '0 0 8px 8px';
    resultContainer.style.maxHeight = '400px';
    resultContainer.style.overflowY = 'auto';
    resultContainer.style.zIndex = '1000';
    resultContainer.style.display = 'none';
    
    // Show search bar when search icon is clicked
    searchShow.addEventListener('click', function() {
        searchBar.classList.add('search-active');
        searchInput.focus();
    });
    
    // Hide search bar when close icon is clicked
    searchClose.addEventListener('click', function() {
        searchBar.classList.remove('search-active');
        searchInput.value = '';
        resultContainer.style.display = 'none';
    });
    
    // Debounce function to limit API calls while typing
    function debounce(func, wait) {
        let timeout;
        return function(...args) {
            clearTimeout(timeout);
            timeout = setTimeout(() => func.apply(this, args), wait);
        };
    }
    
    // Function to fetch search results from server
    const fetchSearchResults = debounce(function(query) {
        if (query.length < 2) {
            resultContainer.style.display = 'none';
            return;
        }
        
        // Show loading indicator
        resultContainer.innerHTML = '<div class="p-3 text-center"><i class="bx bx-loader-alt bx-spin"></i> Searching...</div>';
        resultContainer.style.display = 'block';
        
        // Fetch results from server
        fetch(`/dashboard/search?query=${encodeURIComponent(query)}`)
            .then(response => response.json())
            .then(data => {
                displayResults(data);
            })
            .catch(error => {
                resultContainer.innerHTML = '<div class="p-3 text-center text-danger">Error fetching results</div>';
                console.error('Search error:', error);
            });
    }, 300); // Wait 300ms after user stops typing
    
    // Function to display search results
    function displayResults(data) {
        if (!data || (data.posts.length === 0 && data.categories.length === 0 && 
            data.tags.length === 0 && data.users.length === 0)) {
            resultContainer.innerHTML = '<div class="p-3 text-center">No results found</div>';
            return;
        }
        
        let html = '';
        
        // Posts section
        if (data.posts && data.posts.length > 0) {
            html += `<div class="search-section">
                        <h6 class="p-2 bg-light mb-0">Posts</h6>
                        <ul class="list-group list-group-flush">`;
            
            data.posts.forEach(post => {
                html += `<li class="list-group-item">
                            <a href="/admin/post/edit/${post.id}" class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <img src="${post.image ? '/storage/' + post.image : '/assets/images/placeholder.jpg'}" 
                                         class="rounded" width="50" height="50" alt="${post.title}">
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="mb-0">${post.title}</h6>
                                    <small>${post.category_name}</small>
                                </div>
                            </a>
                        </li>`;
            });
            
            html += `</ul></div>`;
        }
        
        // Categories section
        if (data.categories && data.categories.length > 0) {
            html += `<div class="search-section">
                        <h6 class="p-2 bg-light mb-0">Categories</h6>
                        <ul class="list-group list-group-flush">`;
            
            data.categories.forEach(category => {
                html += `<li class="list-group-item">
                            <a href="/admin/category/edit/${category.id}">${category.name}</a>
                        </li>`;
            });
            
            html += `</ul></div>`;
        }
        
        // Tags section
        if (data.tags && data.tags.length > 0) {
            html += `<div class="search-section">
                        <h6 class="p-2 bg-light mb-0">Tags</h6>
                        <ul class="list-group list-group-flush">`;
            
            data.tags.forEach(tag => {
                html += `<li class="list-group-item">
                            <a href="/admin/tag/edit/${tag.id}">${tag.name}</a>
                        </li>`;
            });
            
            html += `</ul></div>`;
        }
        
        // Users section
        if (data.users && data.users.length > 0) {
            html += `<div class="search-section">
                        <h6 class="p-2 bg-light mb-0">Users</h6>
                        <ul class="list-group list-group-flush">`;
            
            data.users.forEach(user => {
                html += `<li class="list-group-item">
                            <a href="/admin/user/edit/${user.id}" class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <img src="${user.profile_picture ? '/storage/' + user.profile_picture : '/backend/assets/images/profile.png'}" 
                                         class="rounded-circle" width="40" height="40" alt="${user.name}">
                                         
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="mb-0">${user.name}</h6>
                                    <small>${user.email}</small>
                                </div>
                            </a>
                        </li>`;
            });
            
            html += `</ul></div>`;
        }
        
        resultContainer.innerHTML = html;
        resultContainer.style.display = 'block';
    }
    
    // Listen for input changes to trigger search
    searchInput.addEventListener('input', function() {
        const query = this.value.trim();
        fetchSearchResults(query);
    });
    
    // Close search results when clicking outside
    document.addEventListener('click', function(event) {
        if (!searchBar.contains(event.target)) {
            resultContainer.style.display = 'none';
        }
    });
});