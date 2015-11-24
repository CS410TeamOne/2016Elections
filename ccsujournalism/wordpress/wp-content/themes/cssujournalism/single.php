<?php get_header() ?>
<div class='container'>
    <div class='jumbotron'>
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <h2> <?php the_title() ?></h2>
                <small><span class="glyphicon glyphicon-list"></span> <?php the_category(', ') ?> | <span class="glyphicon glyphicon-user"></span> <?php the_author() ?> | <span class="glyphicon glyphicon-time"></span> <?php the_time('F jS, Y') ?></small>
                <hr/>
                <div class='container'>
                    <?php the_content() ?>
                </div>
                <?php if(get_post_meta(get_the_ID(),'map',true)):?>
                <div class='well'>
                    <div style='margin:auto'>
                        <h3> Map </h3>
                    <?php
                    $src = 'http://maps.googleapis.com/maps/api/staticmap?autoscale=false&size=600x300&maptype=roadmap&key=AIzaSyBOKujjwVRasT8-zrFS2Cp4yeZolvspHnk&format=png&visual_refresh=true';
                    $marker = "&markers=size:mid%7Ccolor:0xff0000%7Clabel:1%7C" . get_post_meta(get_the_ID(), 'map', true);?>
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
</div>
<?php get_footer() ?>    

