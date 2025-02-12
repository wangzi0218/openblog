document.addEventListener('DOMContentLoaded', function() {
    // 获取主题切换按钮和 HTML 元素
    const themeToggle = document.querySelector('.theme-toggle');
    const html = document.documentElement;
    
    // 从 localStorage 中获取保存的主题
    const savedTheme = localStorage.getItem('theme');
    
    // 如果有保存的主题，应用它
    if (savedTheme) {
        html.classList.toggle('dark', savedTheme === 'dark');
    } else {
        // 如果没有保存的主题，检查系统偏好
        const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
        html.classList.toggle('dark', prefersDark);
    }
    
    // 监听主题切换按钮点击
    themeToggle.addEventListener('click', function() {
        // 切换暗色模式类
        html.classList.toggle('dark');
        
        // 保存主题选择到 localStorage
        const isDark = html.classList.contains('dark');
        localStorage.setItem('theme', isDark ? 'dark' : 'light');
    });
    
    // 监听系统主题变化
    window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', function(e) {
        if (!localStorage.getItem('theme')) {
            html.classList.toggle('dark', e.matches);
        }
    });
});
