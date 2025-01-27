<?php get_header(); ?>

<div class="container py-8">
    <?php while (have_posts()) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class('bg-white dark:bg-gray-800 rounded-lg shadow-sm overflow-hidden'); ?>>
            <?php if (has_post_thumbnail()) : ?>
                <div class="aspect-video overflow-hidden">
                    <?php the_post_thumbnail('full', array('class' => 'w-full h-full object-cover')); ?>
                </div>
            <?php endif; ?>
            
            <div class="p-6 md:p-8">
                <header class="mb-6">
                    <h1 class="text-3xl font-bold mb-2">
                        <?php the_title(); ?>
                    </h1>
                    <div class="flex flex-wrap items-center gap-4 text-sm text-gray-600 dark:text-gray-400">
                        <span>
                            <?php echo get_the_date(); ?>
                        </span>
                        <span>·</span>
                        <span>
                            <?php
                            printf(
                                /* translators: %s: Author name */
                                __('By %s', 'openblog'),
                                get_the_author()
                            );
                            ?>
                        </span>
                        <?php if (get_the_category_list()) : ?>
                            <span>·</span>
                            <span>
                                <?php
                                $categories_list = get_the_category_list(', ');
                                printf(
                                    /* translators: %s: Category list */
                                    __('In %s', 'openblog'),
                                    $categories_list
                                );
                                ?>
                            </span>
                        <?php endif; ?>
                    </div>
                </header>

                <div class="prose dark:prose-invert max-w-none">
                    <?php the_content(); ?>
                </div>

                <?php
                wp_link_pages(array(
                    'before'      => '<nav class="page-links mt-6"><span class="page-links-title">' . __('Pages:', 'openblog') . '</span>',
                    'after'       => '</nav>',
                    'link_before' => '<span class="page-number">',
                    'link_after'  => '</span>',
                ));
                ?>

                <footer class="mt-8 pt-8 border-t border-gray-200 dark:border-gray-700">
                    <?php if (has_tag()) : ?>
                        <div class="flex flex-wrap gap-2 mb-6">
                            <?php
                            $tags_list = get_the_tag_list('', '');
                            if ($tags_list) {
                                printf(
                                    '<span class="mr-2">%s</span>%s',
                                    esc_html__('Tags:', 'openblog'),
                                    $tags_list
                                );
                            }
                            ?>
                        </div>
                    <?php endif; ?>

                    <div class="flex justify-between items-center">
                        <?php
                        $prev_post = get_previous_post();
                        $next_post = get_next_post();
                        ?>
                        <div class="flex-1">
                            <?php if ($prev_post) : ?>
                                <a href="<?php echo get_permalink($prev_post); ?>" class="text-primary hover:text-primary-dark dark:hover:text-primary-light">
                                    <span class="block text-sm text-gray-600 dark:text-gray-400">
                                        <?php _e('Previous Post', 'openblog'); ?>
                                    </span>
                                    <span class="block font-semibold">
                                        <?php echo get_the_title($prev_post); ?>
                                    </span>
                                </a>
                            <?php endif; ?>
                        </div>
                        <div class="flex-1 text-right">
                            <?php if ($next_post) : ?>
                                <a href="<?php echo get_permalink($next_post); ?>" class="text-primary hover:text-primary-dark dark:hover:text-primary-light">
                                    <span class="block text-sm text-gray-600 dark:text-gray-400">
                                        <?php _e('Next Post', 'openblog'); ?>
                                    </span>
                                    <span class="block font-semibold">
                                        <?php echo get_the_title($next_post); ?>
                                    </span>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </footer>
            </div>
        </article>

        <?php
        // If comments are open or we have at least one comment, load up the comment template.
        if (comments_open() || get_comments_number()) :
            comments_template();
        endif;
        ?>

    <?php endwhile; ?>
</div>

<?php get_footer(); ?>
