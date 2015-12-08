<?php get_header() ?>
<?php 
if(wp_is_mobile()){
        echo "<div class='content-mobile'>";
}else{ 
        echo "<div class='content'>";
}
    ?>
    <div class='well'>
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <h2> <?php the_title() ?></h2>
                <small><span class="glyphicon glyphicon-list"></span> <?php the_category(', ') ?> | <span class="glyphicon glyphicon-user"></span> <?php the_author() ?> | <span class="glyphicon glyphicon-time"></span> <?php the_time('F jS, Y') ?></small>
                <hr/>
                    <?php the_content() ?>
                <?php if (get_post_meta(get_the_ID(), 'map', true)): ?>
                    <div class='well'>
                        <div style='margin:auto'>
                            
                            <?php
                            if(wp_is_mobile()){
                                $size="300x150";
                            }else{
                                 echo "<h3> Map </h3>";
                                $size="600x300";
                            }
                            $src = 'http://maps.googleapis.com/maps/api/staticmap?autoscale=false&size='. $size . '&maptype=roadmap&key=AIzaSyBOKujjwVRasT8-zrFS2Cp4yeZolvspHnk&format=png&visual_refresh=true';
                            $marker = "&markers=size:mid%7Ccolor:0xff0000%7Clabel:1%7C" . get_post_meta(get_the_ID(), 'map', true);
                            ?>
                            <img src="<?php echo $src . $marker ?>"/>
                        </div>
                    </div>
                    <hr/>               
                <?php endif; ?>
                <?php comments_template() ?>
                <?php
				endwhile;
				else: endif;
				?>
    </div>
<?php get_footer() ?>    

