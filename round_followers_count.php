<?php

function round_followers_count( $value ) {
    if ( str_contains( $value, ',' ) ||
         str_contains( $value, 'k' ) ) {
        return $value;
    }

    $thousand = 1000;
    $milion   = $thousand ** 2;

    if ( $value >= $milion ) {
        $divider = $milion;
    } elseif( $value >= $thousand ) {
        $divider = $thousand;
    } else {
        return $value;
    }

    $float_value = $value / $divider;
    $int_value   = (int) $float_value;
    $parts       = explode( '.', $float_value );
    $rest_value  = isset( $parts[1] ) ? $parts[1] : null;
    $first_rest  = ! empty( $rest_value ) ? $rest_value[0] : null;
    $is_absolute = empty( $rest_value ) || $first_rest == 0;

    if ( ! $is_absolute ) {
        $rounded_value = $int_value . ',' . $first_rest;
    } else {
        $rounded_value = $int_value;
    }
    
    if ( $value >= $milion ) {
        $has_plural     = $int_value > 1 || ! $is_absolute;
        $rounded_value .= ! $has_plural ? 'milhão' : 'milhões';
    } else {
        $rounded_value .= 'mil';
    }

    return $rounded_value;
}
