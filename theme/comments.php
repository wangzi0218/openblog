<?php
if (post_password_required()) {
    return;
}
?>

<div id="comments" class="comments-area mt-12 bg-white dark:bg-gray-800 rounded-lg p-6">
    <?php if (have_comments()) : ?>
        <h2 class="text-2xl font-bold mb-6">
            <?php
            $comments_number = get_comments_number();
            if ($comments_number === '1') {
                printf(_x('One Comment', 'comments title', 'openblog'));
            } else {
                printf(
                    _nx(
                        '%1$s Comment',
                        '%1$s Comments',
                        $comments_number,
                        'comments title',
                        'openblog'
                    ),
                    number_format_i18n($comments_number)
                );
            }
            ?>
        </h2>

        <ol class="comment-list space-y-6">
            <?php
            wp_list_comments(array(
                'style'      => 'ol',
                'short_ping' => true,
                'callback'   => function($comment, $args, $depth) {
                    ?>
                    <li id="comment-<?php comment_ID(); ?>" <?php comment_class('comment bg-gray-50 dark:bg-gray-700/50 rounded-lg p-6'); ?>>
                        <article class="comment-body">
                            <footer class="comment-meta flex items-center gap-4 mb-4">
                                <?php echo get_avatar($comment, 48, '', '', array('class' => 'rounded-full')); ?>
                                <div>
                                    <div class="comment-author font-semibold">
                                        <?php echo get_comment_author_link(); ?>
                                    </div>
                                    <div class="comment-metadata text-sm text-gray-600 dark:text-gray-400">
                                        <time datetime="<?php comment_time('c'); ?>">
                                            <?php
                                            printf(
                                                _x('%1$s at %2$s', '1: date, 2: time', 'openblog'),
                                                get_comment_date(),
                                                get_comment_time()
                                            );
                                            ?>
                                        </time>
                                    </div>
                                </div>
                            </footer>

                            <div class="comment-content prose dark:prose-invert">
                                <?php comment_text(); ?>
                            </div>

                            <?php
                            if ('1' == $comment->comment_approved || $comment->comment_approved === 'approve') {
                                comment_reply_link(array_merge($args, array(
                                    'depth'     => $depth,
                                    'max_depth' => $args['max_depth'],
                                    'before'    => '<div class="reply mt-4">',
                                    'after'     => '</div>',
                                    'class'     => 'text-primary hover:text-primary-dark dark:hover:text-primary-light'
                                )));
                            }
                            ?>
                        </article>
                    </li>
                    <?php
                }
            ));
            ?>
        </ol>

        <?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : ?>
            <nav class="comment-navigation pagination mt-8">
                <?php
                paginate_comments_links(array(
                    'prev_text' => __('Previous', 'openblog'),
                    'next_text' => __('Next', 'openblog'),
                ));
                ?>
            </nav>
        <?php endif; ?>

    <?php endif; ?>

    <?php if (!comments_open() && get_comments_number() && post_type_supports(get_post_type(), 'comments')) : ?>
        <p class="no-comments text-gray-600 dark:text-gray-400">
            <?php _e('Comments are closed.', 'openblog'); ?>
        </p>
    <?php endif; ?>

    <?php
    comment_form(array(
        'class_form'           => 'mt-8',
        'title_reply'          => __('Leave a Comment', 'openblog'),
        'title_reply_before'   => '<h3 class="text-xl font-bold mb-4">',
        'title_reply_after'    => '</h3>',
        'class_submit'         => 'bg-primary hover:bg-primary-dark text-white font-bold py-2 px-4 rounded transition-colors',
        'comment_field'        => '<div class="comment-form-comment mb-4"><label for="comment" class="block text-sm font-medium mb-2">' . _x('Comment', 'noun', 'openblog') . '</label><textarea id="comment" name="comment" class="w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-800" rows="8" required></textarea></div>',
        'fields'               => array(
            'author' => '<div class="comment-form-author mb-4"><label for="author" class="block text-sm font-medium mb-2">' . __('Name', 'openblog') . ' <span class="required">*</span></label><input id="author" name="author" type="text" class="w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-800" required /></div>',
            'email'  => '<div class="comment-form-email mb-4"><label for="email" class="block text-sm font-medium mb-2">' . __('Email', 'openblog') . ' <span class="required">*</span></label><input id="email" name="email" type="email" class="w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-800" required /></div>',
            'url'    => '<div class="comment-form-url mb-4"><label for="url" class="block text-sm font-medium mb-2">' . __('Website', 'openblog') . '</label><input id="url" name="url" type="url" class="w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-800" /></div>',
        ),
    ));
    ?>
</div>
