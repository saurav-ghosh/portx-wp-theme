<?php
/**
 * Template Name: Home Page
 *
 * This is the template that displays the home page.
 *
 * @package Insurez
 */
get_header();

while ( have_posts() ) : the_post();
    the_content(); 
endwhile;

get_footer();