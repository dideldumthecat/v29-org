<?php

function v29_get_timeline_columns() {
    $bounds = v29_get_timeline_bounds();
    if ( ! $bounds ) {
        return [];
    }

    $current_year = (int) current_time( 'Y' );
    $last_year    = max( $bounds['end_year'], $current_year );

    $columns = [];

    for ( $year = $bounds['start_year']; $year <= $last_year; $year++ ) {
        if ( $year <= $current_year ) {
            $from = ( $year === $bounds['start_year'] ) ? $bounds['start_month'] : 1;
            for ( $month = $from; $month <= 12; $month++ ) {
                $columns[] = [ 'kind' => 'month', 'year' => $year, 'month' => $month ];
            }
        } else {
            $columns[] = [ 'kind' => 'year', 'year' => $year, 'month' => null ];
        }
    }

    return $columns;
}

function v29_get_timeline_bounds() {
    $earliest_start = v29_edge_date( 'start_date', 'ASC' );
    if ( ! $earliest_start ) {
        return null;
    }

    $latest = max( v29_edge_date( 'start_date', 'DESC' ), v29_edge_date( 'end_date', 'DESC' ) );

    return [
        'start_year'  => (int) substr( $earliest_start, 0, 4 ),
        'start_month' => (int) substr( $earliest_start, 5, 2 ),
        'end_year'    => (int) substr( $latest, 0, 4 ),
    ];
}

function v29_edge_date( $meta_key, $order ) {
    $ids = get_posts( [
        'post_type'      => 'v29_timeline_item',
        'posts_per_page' => 1,
        'meta_key'       => $meta_key,
        'orderby'        => 'meta_value',
        'order'          => $order,
        'fields'         => 'ids',
        'no_found_rows'  => true,
    ] );

    return $ids ? get_field( $meta_key, $ids[0] ) : null;
}

function v29_get_year_headers( $columns ) {
    $headers = [];
    foreach ( $columns as $i => $col ) {
        $year = $col['year'];
        if ( ! isset( $headers[ $year ] ) ) {
            $headers[ $year ] = [ 'year' => $year, 'grid_column' => $i + 2, 'span' => 0 ];
        }
        $headers[ $year ]['span']++;
    }
    return array_values( $headers );
}

function v29_build_column_map( $columns ) {
    $map = [];
    foreach ( $columns as $i => $col ) {
        $key = $col['kind'] === 'month'
            ? sprintf( '%04d-%02d', $col['year'], $col['month'] )
            : sprintf( '%04d', $col['year'] );
        $map[ $key ] = $i + 2;
    }
    return $map;
}

function v29_date_to_column( $date, $col_map ) {
    if ( ! $date ) {
        return null;
    }
    return $col_map[ substr( $date, 0, 7 ) ]   // monthly year: 'YYYY-MM'
        ?? $col_map[ substr( $date, 0, 4 ) ]    // compressed year: 'YYYY'
        ?? null;
}

function v29_build_text_item( $post_id, $col_map ) {
    $start = get_field( 'start_date', $post_id );
    $end   = get_field( 'end_date', $post_id ) ?: null;

    return [
        'kind'      => 'text',
        'body'      => wp_kses_post( get_field( 'body', $post_id ) ),
        'link'      => get_field( 'link', $post_id ) ?: null,
        'start_col' => v29_date_to_column( $start, $col_map ) ?: 2,
        'end_col'   => $end ? v29_date_to_column( $end, $col_map ) : null,
        'active'    => ( $end ?: $start ) >= current_time( 'Y-m-d' ),
    ];
}

function v29_build_media_item( $post_id, $col_map ) {
    $start   = get_field( 'start_date', $post_id );
    $end     = get_field( 'end_date', $post_id ) ?: null;
    $gallery = get_field( 'gallery', $post_id ) ?: [];

    $media = [];
    foreach ( $gallery as $entry ) {
        $file = $entry['file'] ?? null;
        if ( empty( $file['url'] ) ) {
            continue;
        }
        $mime = $file['mime_type'] ?? '';
        $media[] = [
            'type'    => ( strpos( $mime, 'video/' ) === 0 ) ? 'video' : 'image',
            'src'     => $file['url'],
            'caption' => $entry['caption'] ?? '',
            // 'white' is intentionally omitted for now — it becomes the hook for the
            // is_drawing / white-flag multiply treatment when that field lands.
        ];
    }

    return [
        'kind'       => 'media',
        'title'      => get_the_title( $post_id ),
        'thumb'      => $media[0] ?? null,      // first item is the thumbnail
        'media_json' => wp_json_encode( $media, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ),
        'start_col'  => v29_date_to_column( $start, $col_map ) ?: 2,
        'end_col'    => $end ? v29_date_to_column( $end, $col_map ) : null,
    ];
}

function v29_apply_spans( $items, $last_col ) {
    $count = count( $items );
    foreach ( $items as $i => &$item ) {
        if ( $item['end_col'] ) {
            $span = $item['end_col'] - $item['start_col'] + 1;          // explicit range (start + end date)
        } elseif ( ( $item['kind'] ?? 'text' ) === 'media' ) {
            $span = 1;                                                   // media without an end date = single point
        } elseif ( $i + 1 < $count ) {
            $span = $items[ $i + 1 ]['start_col'] - $item['start_col']; // text fills to the next item
        } else {
            $span = $last_col - $item['start_col'] + 1;                 // text fills to the end
        }
        $item['grid_column'] = $item['start_col'];
        $item['span']        = max( 1, $span );
    }
    unset( $item );
    return $items;
}

function v29_get_page_content( $slug ) {
    $page = get_page_by_path( $slug );
    return $page ? apply_filters( 'the_content', $page->post_content ) : '';
}

function v29_get_timeline_rows() {
    $columns  = v29_get_timeline_columns();
    $col_map  = v29_build_column_map( $columns );
    $last_col = count( $columns ) + 1;

    $terms = get_terms( [ 'taxonomy' => 'v29_row', 'hide_empty' => false ] );
    if ( is_wp_error( $terms ) ) {
        return [];
    }
    usort( $terms, function ( $a, $b ) {
        return (int) get_term_meta( $a->term_id, 'row_order', true )
             <=> (int) get_term_meta( $b->term_id, 'row_order', true );
    } );

    $items = new WP_Query( [
        'post_type'      => 'v29_timeline_item',
        'posts_per_page' => -1,
        'meta_key'       => 'start_date',
        'orderby'        => 'meta_value',
        'order'          => 'ASC',
        'no_found_rows'  => true,
    ] );

    $by_row = [];
    foreach ( $items->posts as $post ) {
        $term_ids = wp_get_post_terms( $post->ID, 'v29_row', [ 'fields' => 'ids' ] );
        if ( ! $term_ids ) {
            continue;
        }

        $by_row[ $term_ids[0] ][] = ( get_field( 'item_type', $post->ID ) === 'media' )
            ? v29_build_media_item( $post->ID, $col_map )
            : v29_build_text_item( $post->ID, $col_map );
    }

    $rows = [];
    foreach ( $terms as $i => $term ) {
        $rows[] = [
            'title'    => $term->name,
            'grid_row' => $i + 3,
            'items'    => v29_apply_spans( $by_row[ $term->term_id ] ?? [], $last_col ),
        ];
    }
    return $rows;
}