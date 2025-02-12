<?php get_header(); ?>

<article class="min-w-full md:py-4 sm:max-w-none md:max-w-none">
    <?php while (have_posts()) : the_post(); ?>
        <header class="mb-3 flex flex-col justify-center items-center gap-6">
            <div class="flex flex-col gap-2">
                <div class="flex items-center justify-center gap-x-1">
                    <p class="text-center text-sm text-opacity-50">
                        <?php _e('Published', 'openblog'); ?> 
                        <time datetime="<?php echo get_the_date('c'); ?>">
                            <?php echo get_the_date('M j, Y'); ?>
                        </time>
                    </p>
                    <p class="text-center text-sm text-opacity-50 font-bold">
                        - <?php echo openblog_reading_time(); ?> min read
                    </p>
                </div>
                <h1 class="text-center text-4xl md:text-6xl md:pb-2.5 font-semibold">
                    <?php the_title(); ?>
                </h1>
            </div>

            <div class="flex flex-wrap justify-center items-center gap-2 gap-y-4 md:gap-5">
                <?php
                $tags = get_the_tags();
                if ($tags) {
                    foreach ($tags as $tag) {
                        echo '<a href="' . get_tag_link($tag->term_id) . '" class="text-sm px-4 py-2 hover:text-opacity-60 rounded-lg bg-neutral-100 dark:bg-neutral-800">';
                        echo esc_html($tag->name);
                        echo '</a>';
                    }
                }
                ?>
            </div>
        </header>

        <?php if (has_post_thumbnail()) : ?>
            <div class="my-8">
                <?php the_post_thumbnail('full', array(
                    'class' => 'rounded-md w-full max-h-[300px] md:max-h-[500px] object-cover'
                )); ?>
            </div>
        <?php endif; ?>

        <div class="prose prose-lg dark:prose-invert max-w-[720px] mx-auto">
            <?php the_content(); ?>
        </div>

        <footer class="mt-16">
            <div class="flex flex-wrap justify-center items-center gap-4">
                <?php
                $categories = get_the_category();
                if ($categories) {
                    foreach ($categories as $category) {
                        echo '<a href="' . esc_url(get_category_link($category->term_id)) . '" class="text-sm px-4 py-2 hover:text-opacity-60 rounded-lg bg-neutral-100 dark:bg-neutral-800">';
                        echo esc_html($category->name);
                        echo '</a>';
                    }
                }
                ?>
            </div>

            <?php
            // 上一篇和下一篇文章导航
            $prev_post = get_previous_post();
            $next_post = get_next_post();
            
            if ($prev_post || $next_post) :
            ?>
                <nav class="flex justify-between items-center mt-8 py-8 border-t border-gray-200 dark:border-gray-700">
                    <?php if ($prev_post) : ?>
                        <a href="<?php echo get_permalink($prev_post); ?>" class="flex items-center gap-2 hover:text-opacity-60">
                            <span>←</span>
                            <span><?php echo get_the_title($prev_post); ?></span>
                        </a>
                    <?php else : ?>
                        <div></div>
                    <?php endif; ?>

                    <?php if ($next_post) : ?>
                        <a href="<?php echo get_permalink($next_post); ?>" class="flex items-center gap-2 hover:text-opacity-60">
                            <span><?php echo get_the_title($next_post); ?></span>
                            <span>→</span>
                        </a>
                    <?php else : ?>
                        <div></div>
                    <?php endif; ?>
                </nav>
            <?php endif; ?>
        </footer>

        <?php
        // 如果评论开启，显示评论区域
        if (comments_open() || get_comments_number()) :
            comments_template();
        endif;
        ?>

    <?php endwhile; ?>
</article>

<?php get_footer(); ?>
