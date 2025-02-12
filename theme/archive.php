<?php get_header(); ?>

<div class="container">
    <!-- Archive Title -->
    <h1 class="text-5xl font-semibold tracking-wide text-center mb-8 title">
        <?php
        if (is_category()) {
            single_cat_title();
        } elseif (is_tag()) {
            single_tag_title('#');
        } elseif (is_author()) {
            the_author();
        } elseif (is_date()) {
            if (is_day()) {
                printf(__('Daily Archives: %s', 'openblog'), get_the_date());
            } elseif (is_month()) {
                printf(__('Monthly Archives: %s', 'openblog'), get_the_date('F Y'));
            } elseif (is_year()) {
                printf(__('Yearly Archives: %s', 'openblog'), get_the_date('Y'));
            }
        } else {
            _e('Archives', 'openblog');
        }
        ?>
    </h1>

    <?php if (is_tag() || is_category()) : ?>
        <!-- All Tags/Categories List -->
        <div class="flex gap-4 flex-wrap justify-center items-center mb-8">
            <?php
            if (is_tag()) {
                $terms = get_tags(array(
                    'orderby' => 'name',
                    'order'   => 'ASC'
                ));
                foreach ($terms as $term) {
                    $class = get_query_var('tag') === $term->slug ? 'bg-primary text-white' : 'bg-neutral-100 dark:bg-neutral-800';
                    echo '<a href="' . get_tag_link($term->term_id) . '" class="text-sm px-4 py-2 hover:text-opacity-60 rounded-lg ' . $class . '">';
                    echo '#' . esc_html($term->name);
                    echo '</a>';
                }
            } else {
                $terms = get_categories(array(
                    'orderby' => 'name',
                    'order'   => 'ASC'
                ));
                foreach ($terms as $term) {
                    $class = get_query_var('category_name') === $term->slug ? 'bg-primary text-white' : 'bg-neutral-100 dark:bg-neutral-800';
                    echo '<a href="' . get_category_link($term->term_id) . '" class="text-sm px-4 py-2 hover:text-opacity-60 rounded-lg ' . $class . '">';
                    echo esc_html($term->name);
                    echo '</a>';
                }
            }
            ?>
        </div>
    <?php endif; ?>

    <?php if (have_posts()) : ?>
        <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
            <?php while (have_posts()) : the_post(); ?>
                <article class="bg-white dark:bg-gray-800 rounded-lg shadow-sm overflow-hidden">
                    <?php if (has_post_thumbnail()) : ?>
                        <a href="<?php the_permalink(); ?>" class="block aspect-video overflow-hidden">
                            <?php the_post_thumbnail('large', array('class' => 'w-full h-full object-cover hover:scale-105 transition-transform duration-300')); ?>
                        </a>
                    <?php endif; ?>
                    
                    <div class="p-6">
                        <header class="mb-4">
                            <h2 class="text-xl font-bold mb-2">
                                <a href="<?php the_permalink(); ?>" class="hover:text-primary">
                                    <?php the_title(); ?>
                                </a>
                            </h2>
                            <div class="text-sm text-gray-600 dark:text-gray-400">
                                <?php echo get_the_date(); ?> · <?php echo get_the_author(); ?>
                            </div>
                        </header>
                        
                        <div class="text-gray-600 dark:text-gray-400 mb-4">
                            <?php the_excerpt(); ?>
                        </div>
                        
                        <footer class="flex items-center justify-between">
                            <div class="flex flex-wrap gap-2">
                                <?php
                                $categories = get_the_category();
                                if ($categories) {
                                    foreach ($categories as $category) {
                                        echo '<a href="' . esc_url(get_category_link($category->term_id)) . '" class="badge">' . esc_html($category->name) . '</a>';
                                    }
                                }
                                ?>
                            </div>
                        </footer>
                    </div>
                </article>
            <?php endwhile; ?>
        </div>

        <?php if (get_next_posts_link() || get_previous_posts_link()) : ?>
            <nav class="pagination mt-12">
                <?php
                $pagination = get_the_posts_pagination(array(
                    'mid_size' => 2,
                    'prev_text' => __('Previous', 'openblog'),
                    'next_text' => __('Next', 'openblog'),
                ));
                echo str_replace('navigation pagination', 'flex justify-center gap-2', $pagination);
                ?>
            </nav>
        <?php endif; ?>

    <?php else : ?>
        <div class="text-center py-12">
            <h2 class="text-2xl font-bold mb-4"><?php _e('No posts found', 'openblog'); ?></h2>
            <p class="text-gray-600 dark:text-gray-400"><?php _e('It seems we can't find what you're looking for.', 'openblog'); ?></p>
        </div>
    <?php endif; ?>
</div>

<?php get_footer(); ?>
