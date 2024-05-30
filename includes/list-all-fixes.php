<?php
/* List All Fixes Page */
?>
<div class="fixes-wrapper">
    <h1>All Fixes</h1>
    <form role="search" method="get" id="searchform" action="" class="search-form">
        <input type="text" name="s" id="s" placeholder="Search fixes..." value="<?php echo get_search_query(); ?>" />
        <button type="submit" id="searchsubmit">Search</button>
    </form>

    <?php
    $args = array(
        'post_type' => 'fix',
        'posts_per_page' => -1,
    );

    $fixes_query = new WP_Query($args);

    if ($fixes_query->have_posts()) :
    ?>
    <table id="fixesTable" class="fixes-table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Issue Type</th>
                <th>Severity</th>
                <th>System</th>
                <th>Attachments</th>
                <th>Tags</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($fixes_query->have_posts()): $fixes_query->the_post(); ?>
            <tr>
                <td><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></td>
                <td><?php echo get_post_meta(get_the_ID(), 'description', true); ?></td>
                <td><?php
                    $issue_type = get_the_terms(get_the_ID(), 'issue_type');
                    if ($issue_type && !is_wp_error($issue_type)) {
                        $issue_type_names = array();
                        foreach ($issue_type as $type) {
                            $issue_type_names[] = $type->name;
                        }
                        echo implode(', ', $issue_type_names);
                    } else {
                        echo 'None';
                    }
                ?></td>
                <td><?php
                    $severity = get_the_terms(get_the_ID(), 'severity');
                    if ($severity && !is_wp_error($severity)) {
                        $severity_names = array();
                        foreach ($severity as $sev) {
                            $severity_names[] = $sev->name;
                        }
                        echo implode(', ', $severity_names);
                    } else {
                        echo 'None';
                    }
                ?></td>
                <td><?php
                    $system_id = get_post_meta(get_the_ID(), 'system', true);
                    if ($system_id) {
                        $system = get_post($system_id);
                        echo $system ? $system->post_title : 'None';
                    } else {
                        echo 'None';
                    }

                ?></td>
                <td><?php
                    $attachments = get_post_meta(get_the_ID(), 'attachments', true);
                    if ($attachments) {
                        foreach ($attachments as $attachment_id) {
                            $attachment_url = wp_get_attachment_url($attachment_id);
                            echo '<a href="' . $attachment_url . '" target="_blank">View Attachment</a><br>';
                        }
                    } else {
                        echo 'None';
                    }
                ?></td>
                <td><?php
                    $tags = get_the_terms(get_the_ID(), 'post_tag');
                    if ($tags && !is_wp_error($tags)) {
                        $tag_names = array();
                        foreach ($tags as $tag) {
                            $tag_names[] = $tag->name;
                        }
                        echo implode(', ', $tag_names);
                    } else {
                        echo 'None';
                    }
                ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <?php else : ?>
        <p>No fixes found.</p>
    <?php endif; wp_reset_postdata(); ?>
</div>
