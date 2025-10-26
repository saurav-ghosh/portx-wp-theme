<?php
/**
 * Template Name: Contact Page
 *
 * This is the template that displays the contact page.
 *
 * @package Insurez
 */
get_header();

while ( have_posts() ) : the_post();
    the_content(); 
endwhile;

get_footer();