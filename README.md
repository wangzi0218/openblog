# OpenBlog | WordPress 主题

[English](#english) | [中文说明](#chinese)

<h2 id="english">English</h2>

A modern WordPress theme based on the blog-template by danielcgilibert. This theme transforms the original static blog template into a fully functional WordPress theme, making it more accessible and easier to use for content creators.

### Project Structure

```
openblog/
├── theme/                  # WordPress theme files
│   ├── css/               # CSS files
│   │   └── tailwind.css   # Tailwind source file
│   ├── js/                # JavaScript files
│   │   └── theme.js       # Theme JavaScript
│   ├── archive.php        # Archive template
│   ├── comments.php       # Comments template
│   ├── footer.php         # Footer template
│   ├── functions.php      # Theme functions
│   ├── header.php         # Header template
│   ├── index.php          # Main template
│   ├── page.php          # Page template
│   ├── single.php        # Single post template
│   ├── style.css         # Main theme stylesheet
│   └── tailwind.config.js # Tailwind configuration
├── package.json           # Project dependencies
└── README.md             # Project documentation
```

### Comparison with Original Template

| Feature | Original Template | OpenBlog WordPress Theme |
|---------|------------------|-------------------------|
| Platform | Static Site (Astro) | WordPress |
| Content Management | File-based | WordPress Admin Panel |
| Deployment | Requires build process | Simple WordPress installation |
| User-friendly | Technical knowledge required | No coding required |
| SEO | Basic | WordPress SEO ecosystem |
| Plugins Support | Limited | Full WordPress plugins support |

### Key Features

- 🎨 Modern and clean design inherited from the original template
- 📱 Fully responsive layout optimized for all devices
- 🌓 Dark mode support with smooth transitions
- 🎯 Enhanced SEO with WordPress optimization
- 🚀 Fast and lightweight theme structure
- 💅 Tailwind CSS for modern styling
- 📝 Clean typography and reading experience
- 🔌 Full WordPress functionality integration
- 🛠️ Easy customization through WordPress Customizer

<h2 id="chinese">中文说明</h2>

这是一个基于 danielcgilibert 的 blog-template 改造的现代 WordPress 主题。我们将原始的静态博客模板转换为功能完整的 WordPress 主题，使其更易于内容创作者使用。

### 项目结构

```
openblog/
├── theme/                  # WordPress 主题文件
│   ├── css/               # CSS 文件
│   │   └── tailwind.css   # Tailwind 源文件
│   ├── js/                # JavaScript 文件
│   │   └── theme.js       # 主题 JavaScript
│   ├── archive.php        # 归档模板
│   ├── comments.php       # 评论模板
│   ├── footer.php         # 页脚模板
│   ├── functions.php      # 主题函数
│   ├── header.php         # 页头模板
│   ├── index.php          # 主模板
│   ├── page.php          # 页面模板
│   ├── single.php        # 单文章模板
│   ├── style.css         # 主题样式表
│   └── tailwind.config.js # Tailwind 配置
├── package.json           # 项目依赖
└── README.md             # 项目文档
```

### 与原模板对比

| 功能特性 | 原始模板 | OpenBlog WordPress 主题 |
|---------|---------|----------------------|
| 平台 | 静态站点 (Astro) | WordPress |
| 内容管理 | 基于文件 | WordPress 后台管理 |
| 部署方式 | 需要构建过程 | 简单的 WordPress 安装 |
| 用户友好度 | 需要技术知识 | 无需编码知识 |
| SEO | 基础支持 | WordPress SEO 生态系统 |
| 插件支持 | 有限 | 完整的 WordPress 插件支持 |

### 核心特性

- 继承原模板的现代简洁设计
- 全响应式布局，完美适配各种设备
- 深色模式支持，平滑切换效果
- WordPress 优化的 SEO 支持
- 轻量快速的主题架构
- 使用 Tailwind CSS 实现现代化样式
- 清晰的排版和阅读体验
- 完整的 WordPress 功能集成
- 通过 WordPress 定制器轻松自定义

## Installation | 安装方法

1. Download the latest release from the [releases page](https://github.com/wangzi0218/openblog/releases)
   下载最新版本
2. Upload the theme through WordPress admin panel: Appearance > Themes > Add New > Upload Theme
   通过 WordPress 后台上传主题：外观 > 主题 > 添加 > 上传主题
3. Activate the theme
   启用主题
4. Customize the theme settings through WordPress Customizer
   通过 WordPress 定制器自定义主题设置

## Development | 开发

### Local Development with WordPress | 本地 WordPress 开发

1. Install Local WordPress | 安装 Local WordPress
   - Download and install [Local](https://localwp.com/)
   - Create a new WordPress site

2. Link Theme for Development | 链接主题进行开发
   ```bash
   # Find your Local WordPress themes directory
   # It might be in one of these locations:
   # - ~/Library/Application Support/Local/run/[site-name]/app/public/wp-content/themes/
   # - ~/.local/share/Local/run/[site-name]/app/public/wp-content/themes/
   # - [Local installation path]/[site-name]/app/public/wp-content/themes/
   
   # Create symbolic link (replace [themes-path] with your actual path)
   ln -s /path/to/your/openblog/theme [themes-path]/openblog
   ```

3. Development Workflow | 开发工作流
   ```bash
   # Install dependencies
   npm install
   
   # Start development server (watches for CSS changes)
   npm run dev
   ```

   The development server will:
   - Watch for changes in PHP files and automatically compile any new Tailwind CSS classes
   - Watch for changes in CSS files and recompile automatically
   - Hot reload CSS changes in the browser

4. Development Best Practices | 开发最佳实践
   - Always keep `npm run dev` running while developing
   - Any new Tailwind CSS classes in PHP files will be automatically detected and compiled
   - Changes to PHP files will be reflected immediately in WordPress
   - Test all changes in both light and dark modes
   - Check responsive design using browser dev tools

5. Testing | 测试
   - Activate the theme in WordPress admin
   - Changes to PHP files will be reflected immediately
   - New CSS classes will be compiled automatically when running `npm run dev`
   - Test all features:
     - Navigation menus
     - Widget areas
     - Comments
     - Archive pages
     - Single posts and pages
     - Responsive design
     - Dark mode

### Building for Production | 生产环境构建

```bash
# Install dependencies
npm install

# Build CSS for production
npm run build

# Create theme zip file
cd theme && zip -r ../openblog.zip . && cd ..
```

The generated `openblog.zip` can be installed on any WordPress site.

To work on the theme locally | 本地开发：

```bash
# Install dependencies | 安装依赖
npm install

# Start development server | 启动开发服务器
npm run dev

# Build for production | 构建生产版本
npm run build
```

## License | 许可证

This project is open source and available under the [MIT License](LICENSE).
本项目采用 [MIT 许可证](LICENSE) 开源。

## Credits | 致谢

- Original template by [danielcgilibert](https://github.com/danielcgilibert/blog-template)
  原始模板作者：[danielcgilibert](https://github.com/danielcgilibert/blog-template)
- Modified and maintained by [wannz](https://github.com/wangzi0218)
  修改和维护：[wannz](https://github.com/wangzi0218)
