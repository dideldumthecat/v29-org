<?php

$context = Timber::context();
$context['body_class'] = implode(' ', get_body_class());
$context['rows'] = v29_get_timeline_rows();
$context['columns'] = v29_get_timeline_columns();
$context['year_headers'] = v29_get_year_headers( $context['columns'] );
$context['about_content'] = v29_get_page_content( 'about' );
$context['impressum_content'] = v29_get_page_content( 'legal' );

Timber::render('index.twig', $context);