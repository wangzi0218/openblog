document.addEventListener('DOMContentLoaded', function() {
    const searchButton = document.getElementById('search-button');
    const searchModal = document.getElementById('search-modal');
    const searchInput = document.getElementById('search-input');
    const searchResults = document.getElementById('search-results');
    const closeButton = document.getElementById('close-search');

    if (!searchButton || !searchModal || !searchInput || !searchResults || !closeButton) return;

    // 打开搜索模态框
    searchButton.addEventListener('click', function() {
        searchModal.classList.remove('hidden');
        setTimeout(() => {
            searchModal.classList.add('opacity-100');
            searchInput.focus();
        }, 10);
    });

    // 关闭搜索模态框
    function closeSearchModal() {
        searchModal.classList.remove('opacity-100');
        setTimeout(() => {
            searchModal.classList.add('hidden');
            searchInput.value = '';
            searchResults.innerHTML = '';
        }, 300);
    }

    closeButton.addEventListener('click', closeSearchModal);

    // 点击模态框背景关闭
    searchModal.addEventListener('click', function(e) {
        if (e.target === searchModal) {
            closeSearchModal();
        }
    });

    // ESC 键关闭
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && !searchModal.classList.contains('hidden')) {
            closeSearchModal();
        }
    });

    // 处理搜索
    let searchTimeout;
    searchInput.addEventListener('input', function() {
        clearTimeout(searchTimeout);
        const query = this.value.trim();
        
        if (query.length < 2) {
            searchResults.innerHTML = '';
            return;
        }

        searchTimeout = setTimeout(() => {
            // 发送 AJAX 请求到 WordPress REST API
            fetch(`${wpApiSettings.root}wp/v2/search?search=${encodeURIComponent(query)}&per_page=5&type=post`)
                .then(response => response.json())
                .then(posts => {
                    searchResults.innerHTML = '';
                    
                    if (posts.length === 0) {
                        searchResults.innerHTML = '<p class="p-4 text-gray-500">No results found</p>';
                        return;
                    }

                    posts.forEach(post => {
                        const article = document.createElement('article');
                        article.className = 'p-4 hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors';
                        article.innerHTML = `
                            <a href="${post.url}" class="block">
                                <h3 class="text-lg font-medium mb-2">${post.title}</h3>
                                <p class="text-sm text-gray-600 dark:text-gray-400">${post.excerpt || ''}</p>
                            </a>
                        `;
                        searchResults.appendChild(article);
                    });
                })
                .catch(error => {
                    console.error('Search error:', error);
                    searchResults.innerHTML = '<p class="p-4 text-red-500">Error performing search</p>';
                });
        }, 300);
    });
});
