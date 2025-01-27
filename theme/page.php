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
            </div>
        </article>

        <?php
        if (comments_open() || get_comments_number()) :
            comments_template();
        endif;
        ?>

    <?php endwhile; ?>
</div>

<?php get_footer(); ?>
