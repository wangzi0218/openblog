<?php get_header(); ?>

<div class="container">
    <!-- Title Page -->
    <h1 class="text-5xl font-semibold tracking-wide text-center mb-8 title">
        <?php bloginfo('name'); ?>
    </h1>

    <!-- Categories List -->
    <div class="flex gap-4 flex-wrap justify-center items-center mb-8">
        <?php
        $categories = get_categories(array(
            'orderby' => 'name',
            'order'   => 'ASC'
        ));

        foreach($categories as $category) {
            $category_link = get_category_link($category->term_id);
            echo '<a href="' . esc_url($category_link) . '" class="text-sm px-4 py-2 hover:text-opacity-60 rounded-lg bg-neutral-100 dark:bg-neutral-800">';
            echo esc_html($category->name);
            echo '</a>';
        }
        ?>
    </div>

    <!-- Latest Posts -->
    <div>
        <h2 class="text-lg font-medium tracking-wide text-end mb-4"><?php _e('Latest Posts', 'openblog'); ?></h2>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8 mt-3">
            <?php
            if (have_posts()) :
                $post_count = 0;
                while (have_posts()) : the_post();
                    $post_count++;
                    ?>
                    <article class="grid grid-rows-[300px_auto] md:grid-rows-[300px_220px] min-h-full group <?php echo ($post_count === 1) ? 'md:col-span-2' : ''; ?>">
                        <a class="relative overflow-hidden" href="<?php the_permalink(); ?>">
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="h-full min-w-full hover:scale-[101%] transition-all duration-200 rounded-[2px]">
                                    <?php the_post_thumbnail('large', array('class' => 'h-full w-full object-cover')); ?>
                                </div>
                            <?php endif; ?>

                            <div class="z-30 absolute bottom-0 w-full h-20">
                                <div class="absolute bottom-0 w-full h-full bg-black bg-opacity-30 backdrop-blur-md"></div>
                                <div class="flex items-center justify-between gap-x-1 text-white px-6 py-4">
                                    <div class="flex flex-col gap-1 items-center justify-center">
                                        <time datetime="<?php echo get_the_date('c'); ?>">
                                            <?php echo get_the_date('M j, Y'); ?>
                                        </time>
                                        <span class="text-sm">
                                            <?php echo openblog_reading_time(); ?> min read
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </a>

                        <div class="flex flex-col justify-between gap-4 md:gap-8 py-4">
                            <div class="flex flex-col gap-3">
                                <a class="text-xl font-medium" href="<?php the_permalink(); ?>">
                                    <?php the_title(); ?>
                                </a>
                                <p class="overflow-hidden line-clamp-3 text-gray-700 dark:text-gray-300">
                                    <?php echo wp_trim_words(get_the_excerpt(), 20); ?>
                                </p>
                            </div>

                            <footer class="flex justify-between items-center">
                                <?php
                                $categories = get_the_category();
                                if ($categories) {
                                    echo '<a href="' . esc_url(get_category_link($categories[0]->term_id)) . '" class="text-sm px-2 py-1 rounded-lg bg-neutral-100 dark:bg-neutral-800 hover:text-opacity-60">';
                                    echo esc_html($categories[0]->name);
                                    echo '</a>';
                                }
                                ?>
                                <span class="transform transition-transform duration-200 group-hover:translate-x-1">
                                    →
                                </span>
                            </footer>
                        </div>
                    </article>
                <?php
                endwhile;
            else :
                ?>
                <p><?php _e('No posts found.', 'openblog'); ?></p>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>
