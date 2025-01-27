    </main><!-- 主内容区域结束 -->

    <footer class="py-8 mt-auto bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700">
        <div class="container">
            <div class="grid gap-8 md:grid-cols-3">
                <!-- 友情链接 -->
                <div class="bg-gray-50 dark:bg-gray-700/50 rounded-lg p-6">
                    <h3 class="text-lg font-semibold mb-4"><?php _e('Friend Links', 'openblog'); ?></h3>
                    <?php
                    $friend_links = get_option('openblog_friend_links', array());
                    if (!empty($friend_links)) :
                        echo '<ul class="space-y-2">';
                        foreach ($friend_links as $link) :
                            echo '<li><a href="' . esc_url($link['url']) . '" class="text-gray-600 dark:text-gray-400 hover:text-primary dark:hover:text-primary" target="_blank">' . esc_html($link['name']) . '</a></li>';
                        endforeach;
                        echo '</ul>';
                    else :
                        echo '<p class="text-gray-600 dark:text-gray-400">' . __('No friend links added yet.', 'openblog') . '</p>';
                    endif;
                    ?>
                </div>

                <!-- 广告区域 -->
                <div class="bg-gray-50 dark:bg-gray-700/50 rounded-lg p-6">
                    <h3 class="text-lg font-semibold mb-4"><?php _e('Advertisement', 'openblog'); ?></h3>
                    <?php
                    $advertisement = get_option('openblog_advertisement', '');
                    if (!empty($advertisement)) :
                        echo wp_kses_post($advertisement);
                    else :
                        echo '<p class="text-gray-600 dark:text-gray-400">' . __('No advertisement content.', 'openblog') . '</p>';
                    endif;
                    ?>
                </div>

                <!-- 徽章区域 -->
                <div class="bg-gray-50 dark:bg-gray-700/50 rounded-lg p-6">
                    <h3 class="text-lg font-semibold mb-4"><?php _e('Badges', 'openblog'); ?></h3>
                    <?php
                    $badges = get_option('openblog_badges', array());
                    if (!empty($badges)) :
                        echo '<div class="flex flex-wrap gap-4">';
                        foreach ($badges as $badge) :
                            if (!empty($badge['image']) && !empty($badge['url'])) :
                                echo '<a href="' . esc_url($badge['url']) . '" target="_blank" rel="noopener noreferrer">';
                                echo '<img src="' . esc_url($badge['image']) . '" alt="' . esc_attr($badge['name']) . '" class="h-8">';
                                echo '</a>';
                            endif;
                        endforeach;
                        echo '</div>';
                    else :
                        echo '<p class="text-gray-600 dark:text-gray-400">' . __('No badges added yet.', 'openblog') . '</p>';
                    endif;
                    ?>
                </div>
            </div>

            <div class="mt-8 pt-8 border-t border-gray-200 dark:border-gray-700 text-center text-gray-600 dark:text-gray-400">
                <p>
                    &copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. 
                    <?php _e('All rights reserved.', 'openblog'); ?>
                </p>
                <p class="mt-2">
                    <?php
                    printf(
                        /* translators: %1$s: Theme name, %2$s: Theme author URL */
                        esc_html__('Theme %1$s by %2$s', 'openblog'),
                        'OpenBlog',
                        '<a href="https://github.com/danielcgilibert" target="_blank" rel="noopener noreferrer" class="hover:text-primary">danielcgilibert</a>'
                    );
                    ?>
                </p>
            </div>
        </div>
    </footer>

    <?php wp_footer(); ?>
</body>
</html>
