<?php if (get_field('enable_site_notification', 4)): ?>

<section class="site-notification">
    <div class="row">
        <div class="small-12 columns">
            <?php the_field('site_notification_content', 4); ?>
        </div>
    </div>
</section>

<?php endif; ?>