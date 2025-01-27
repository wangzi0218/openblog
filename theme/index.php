<?php get_header(); ?>

<div class="container mx-auto px-4 py-8">
    <?php if (have_posts()) : ?>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php 
            $post_count = 0;
            while (have_posts()) : the_post(); 
                $post_count++;
                $article_class = $post_count === 1 ? 'md:col-span-2' : '';
            ?>
                <article class="bg-background dark:bg-background border border-border rounded-lg shadow-sm overflow-hidden transition-transform hover:-translate-y-1 <?php echo $article_class; ?>">
                    <?php if (has_post_thumbnail()) : ?>
                        <a href="<?php the_permalink(); ?>" class="block aspect-video overflow-hidden">
                            <?php the_post_thumbnail('large', array('class' => 'w-full h-full object-cover transition-transform hover:scale-105 duration-300')); ?>
                        </a>
                    <?php endif; ?>
                    
                    <div class="p-6">
                        <header class="mb-4">
                            <h2 class="text-xl font-bold mb-2">
                                <a href="<?php the_permalink(); ?>" class="text-foreground hover:text-muted-foreground transition-colors">
                                    <?php the_title(); ?>
                                </a>
                            </h2>
                            <div class="text-sm text-muted-foreground">
                                <?php echo get_the_date(); ?> · <?php echo get_the_author(); ?>
                            </div>
                        </header>
                        
                        <div class="text-muted-foreground mb-4">
                            <?php the_excerpt(); ?>
                        </div>
                        
                        <footer class="flex items-center justify-between">
                            <div class="flex flex-wrap gap-2">
                                <?php
                                $categories = get_the_category();
                                if ($categories) {
                                    foreach ($categories as $category) {
                                        echo '<a href="' . esc_url(get_category_link($category->term_id)) . '" class="inline-flex items-center px-3 py-1 text-xs font-medium rounded-full bg-background-secondary text-muted-foreground hover:text-foreground hover:bg-muted transition-colors">' . esc_html($category->name) . '</a>';
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
                    'prev_text' => '上一页',
                    'next_text' => '下一页',
                ));
                echo str_replace('navigation pagination', 'flex justify-center gap-2', $pagination);
                ?>
            </nav>
        <?php endif; ?>

    <?php else : ?>
        <div class="text-center py-12">
            <h2 class="text-2xl font-bold mb-4">没有找到文章</h2>
            <p class="text-gray-600 dark:text-gray-400">暂时没有任何文章，请稍后再来访问。</p>
        </div>
    <?php endif; ?>
</div>

<?php get_footer(); ?>
