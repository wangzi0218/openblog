document.addEventListener('DOMContentLoaded', function() {
    // 初始化动画设置
    if (!('animations' in localStorage)) {
        localStorage.setItem('animations', 'true');
    }

    const showAnimations = localStorage.getItem('animations') === 'true';
    
    if (showAnimations) {
        // 标题动画
        const titles = document.querySelectorAll('.title');
        titles.forEach(title => {
            title.style.opacity = '0';
            title.style.transform = 'translateY(80px)';
            
            setTimeout(() => {
                title.style.transition = 'transform 0.8s ease, opacity 0.8s ease';
                title.style.transform = 'translateY(0)';
                title.style.opacity = '1';
            }, 100);
        });

        // 文章卡片动画
        const articles = document.querySelectorAll('article');
        articles.forEach((article, index) => {
            article.style.opacity = '0';
            article.style.transform = 'translateY(100px)';
            
            setTimeout(() => {
                article.style.transition = 'transform 0.8s ease, opacity 0.8s ease';
                article.style.transform = 'translateY(0)';
                article.style.opacity = '1';
            }, 100 + (index * 100)); // 错开每个文章的动画时间
        });

        // 标签动画
        const tags = document.querySelectorAll('.tag');
        tags.forEach((tag, index) => {
            tag.style.opacity = '0';
            tag.style.transform = 'scale(0.8)';
            
            setTimeout(() => {
                tag.style.transition = 'transform 0.5s ease, opacity 0.5s ease';
                tag.style.transform = 'scale(1)';
                tag.style.opacity = '1';
            }, 100 + (index * 50));
        });
    }
});
