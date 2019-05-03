<?php 

namespace Sort_Users_By_Date;

// Exit if accessed directly
if( ! defined( 'ABSPATH' ) ) {
    exit;
}
         
if ( is_admin()) {
    add_filter( 'manage_users_columns', __NAMESPACE__.'\new_modify_user_table', 99 );
    add_filter( 'manage_users_custom_column', __NAMESPACE__.'\new_modify_user_table_row', 10, 3 );
    add_filter( 'manage_users_sortable_columns', __NAMESPACE__.'\sortable_column' );
    add_action( 'pre_get_users', __NAMESPACE__.'\user_date_orderby');
    add_action( 'wp_login', __NAMESPACE__.'\user_last_login', 10, 2 );
}


function user_last_login( $user_login, $user ) {
    update_user_meta( $user->ID, 'last_login_time', time() );
}



function new_modify_user_table( $column ) {
    $column['last_login_time'] = 'Last Login Date';
    return $column;
}

function new_modify_user_table_row( $val, $column_name, $user_id ) {
    if ('last_login_time' === $column_name) {
        $date = get_user_meta( $user_id, 'last_login_time', true );
        return $date;
    } else{
        return $val;
    }
}

function sortable_column( $columns ) {
    $columns['last_login_time'] = 'last_login_time';
    //To make a column 'un-sortable' remove it from the array unset($columns['date']);
    return $columns;
}


function user_date_orderby( $user_query ) {

    if( 'last_login_time' == $user_query->get( 'orderby' ) ) {
        $user_query->set( 'orderby', 'meta_value' ); 
        $user_query->set( 'meta_key', 'last_login_time' );
    } 

}