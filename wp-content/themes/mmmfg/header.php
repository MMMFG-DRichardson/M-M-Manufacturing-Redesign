<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package vantage
 * @since vantage 1.0
 * @license GPL 2.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta http-equiv="X-UA-Compatible" content="IE=10" />
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://use.typekit.net/dqm6umi.js"></script>
    <script>try{Typekit.load({ async: true });}catch(e){}</script>
	<?php wp_head(); ?>
<script src="https://use.typekit.net/obt1mrh.js"></script>
<script>try{Typekit.load({ async: true });}catch(e){}</script>
<script src="https://use.typekit.net/sei7dce.js"></script>
<script>try{Typekit.load({ async: true });}catch(e){}</script>
<script src="https://use.typekit.net/vfq6oms.js"></script>
<script>try{Typekit.load({ async: true });}catch(e){}</script>
<script src="https://use.typekit.net/ydo2dkj.js"></script>
<script>try{Typekit.load({ async: true });}catch(e){}</script>

</head>

<body <?php body_class(); ?>>

<?php do_action('vantage_before_page_wrapper') ?>

<div id="page-wrapper">

	<?php do_action( 'vantage_before_masthead' ); ?>

	<?php if( ! siteorigin_page_setting( 'hide_masthead', false ) ) : ?>

		<?php get_template_part( 'parts/masthead', apply_filters( 'vantage_masthead_type', siteorigin_setting( 'layout_masthead' ) ) ); ?>

	<?php endif; ?>

	<?php do_action( 'vantage_after_masthead' ); ?>
    
	<?php do_action( 'vantage_before_main_container' ); ?>

	<div id="main" class="site-main">
		<div class="full-container">
			<?php do_action( 'vantage_main_top' ); ?>
