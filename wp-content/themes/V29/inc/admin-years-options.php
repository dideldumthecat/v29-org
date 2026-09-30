<?php
/**
 * "Years" options page under Timeline Items, with the select that unlocks
 * the month view for upcoming years. Its field group lives in scf/.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'acf/init', 'v29_register_years_options_page' );

function v29_register_years_options_page() {
	acf_add_options_sub_page( [
		'page_title'  => 'Years',
		'menu_title'  => 'Years',
		'menu_slug'   => 'v29-years',
		'parent_slug' => 'edit.php?post_type=v29_timeline_item',
		'capability'  => 'edit_posts',
	] );
}

add_filter( 'acf/load_field/name=v29_month_view_until', 'v29_load_month_view_until_choices' );

function v29_load_month_view_until_choices( $field ) {
	$current_year = (int) current_time( 'Y' );

	$field['choices'] = [];
	for ( $year = $current_year; $year <= $current_year + 1; $year++ ) {
		$field['choices'][ $year ] = (string) $year;
	}
	$field['default_value'] = $current_year;

	return $field;
}
