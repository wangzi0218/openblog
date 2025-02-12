<!DOCTYPE html>
<html <?php language_attributes(); ?> class="scroll-smooth">
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class('bg-white text-stone-950 dark:bg-[#0a0910] dark:text-white'); ?>>
<?php wp_body_open(); ?>

<main class="px-5 sm:mx-auto sm:max-w-2xl sm:px-8 lg:px-0 antialiased md:max-w-6xl grid gap-12 mt-4 overflow-hidden md:overflow-visible">
    <header class="relative flex items-center h-12 font-semibold">
        <a class="text-lg mr-auto" href="<?php echo esc_url(home_url('/')); ?>">
            <?php 
            if (has_custom_logo()) {
                the_custom_logo();
            } else {
                bloginfo('name');
            }
            ?>
        </a>

        <div id="header-drawer" 
             class="shadow rounded-l-lg md:bg-transparent dark:md:bg-transparent bg-white dark:bg-[#0a0910] md:shadow-none md:rounded-none md:border-none md:h-auto md:static absolute transition-transform duration-300 ease-in translate-x-96 md:translate-x-0 top-12 -right-5 pl-4 pt-6 pb-4 md:p-0 h-[200px] w-[200px] z-50">
            <nav class="flex h-full flex-col justify-between gap-12 text-left md:flex-row md:w-full md:gap-5">
                <div class="flex flex-col gap-4 md:flex-row md:border-r-2 border-black pr-4 dark:border-white">
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'primary',
                        'container' => false,
                        'menu_class' => 'flex flex-col gap-4 md:flex-row',
                        'fallback_cb' => false,
                        'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                        'walker' => new OpenBlog_Nav_Walker()
                    ));
                    ?>
                </div>

                <div class="flex justify-center items-center md:justify-end gap-3 md:p-0">
                    <!-- Search Button -->
                    <button id="search-button" 
                            class="h-6 w-6 focus:outline-none"
                            aria-label="Search">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </button>

                    <?php if (function_exists('openblog_social_links')) : ?>
                        <?php openblog_social_links(); ?>
                    <?php endif; ?>
                    
                    <!-- Theme Toggle Button -->
                    <button id="theme-toggle" 
                            class="relative h-6 w-6 focus:outline-none transform transition-transform duration-300"
                            aria-label="Toggle Theme">
                        <span class="absolute inset-0 dark:hidden">🌞</span>
                        <span class="absolute inset-0 hidden dark:inline">🌙</span>
                    </button>
                </div>
            </nav>
        </div>

        <!-- Mobile Menu Button -->
        <button id="mobile-menu-button" 
                class="md:hidden h-6 w-6 focus:outline-none"
                aria-label="Toggle Menu">
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"/>
            </svg>
        </button>
    </header>

    <!-- Search Modal -->
    <div id="search-modal" 
         class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden opacity-0 transition-opacity duration-300">
        <div class="container mx-auto px-4 h-full flex items-center justify-center">
            <div class="bg-white dark:bg-gray-800 w-full max-w-2xl rounded-lg shadow-xl">
                <div class="p-4 border-b border-gray-200 dark:border-gray-700 flex justify-between items-center">
                    <h2 class="text-xl font-semibold"><?php _e('Search', 'openblog'); ?></h2>
                    <button id="close-search" class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div class="p-4">
                    <input type="text" 
                           id="search-input"
                           class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary dark:bg-gray-700"
                           placeholder="<?php _e('Type to search...', 'openblog'); ?>">
                </div>
                <div id="search-results" class="max-h-96 overflow-y-auto border-t border-gray-200 dark:border-gray-700"></div>
            </div>
        </div>
    </div>

    <main class="py-12"><!-- 主内容区域开始 -->
