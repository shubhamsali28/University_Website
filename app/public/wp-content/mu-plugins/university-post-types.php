<?php
function university_post_types()
{
	//Campus Post type
	register_post_type('campus', array(
		//TO only give campus permission to any particular user
		'capability_type' => 'campus',
		'map_meta_cap' => true,
		'supports' => array('title', 'editor', 'excerpt'),
		'rewrite' => array('slug' => 'campuses'),
		'has_archive' => true,
		'public' => true,
	    'labels' => array(
        'name' => 'Campuses',
        'add_new_item' => 'Add New Campus',
        'edit_item' => 'Edit Campus',
        'all_items' => 'All Campuses'
	    ),
	    'menu_icon' => 'dashicons-location-alt'

	));

	//Event Post type
	register_post_type('event', array(
		//TO only give event permission to any particular user
		'capability_type' => 'event',
		'map_meta_cap' => true,
		'supports' => array('title', 'editor', 'excerpt'),
		'rewrite' => array('slug' => 'events'),
		'has_archive' => true,
		'public' => true,
	    'labels' => array(
        'name' => 'Events',
        'add_new_item' => 'Add New Event',
        'edit_item' => 'Edit Event',
        'all_items' => 'All Events'
	    ),
	    'menu_icon' => 'dashicons-calendar'

	));

	//Program Post type
	register_post_type('program', array(
		'supports' => array('title'),
		'rewrite' => array('slug' => 'programs'),
		'has_archive' => true,
		'public' => true,
	    'labels' => array(
        'name' => 'Programs',
        'add_new_item' => 'Add New Program',
        'edit_item' => 'Edit Program',
        'all_items' => 'All Programs'
	    ),
	    'menu_icon' => 'dashicons-awards'

	));

	//Professor Post type
	register_post_type('professor', array(
		//TO only give event permission to any particular user
		'capability_type' => 'professor',
		'map_meta_cap' => true,
		'show_in_rest' => true,
		'supports' => array('title', 'editor', 'thumbnail'),
		'public' => true,
	    'labels' => array(
        'name' => 'Professors',
        'add_new_item' => 'Add New Professor',
        'edit_item' => 'Edit Professor',
        'all_items' => 'All Professors'
	    ),
	    'menu_icon' => 'dashicons-welcome-learn-more'

	));

	//Note Post type
	register_post_type('note', array(
		//TO only give event permission to any particular user
		'capability_type' => 'note',
		'map_meta_cap' => true,
		'show_in_rest' => true,
		'supports' => array('title', 'editor'),
		'public' => false, //Not to display to everyone even to admin
		'show_ui' => true, //To display Note post type to admin
	    'labels' => array(
        'name' => 'Notes',
        'add_new_item' => 'Add New Note',
        'edit_item' => 'Edit Note',
        'all_items' => 'All Notes'
	    ),
	    'menu_icon' => 'dashicons-welcome-write-blog'

	));


	//Like Post type
	register_post_type('like', array(
		//TO only give event permission to any particular user
		'supports' => array('title'),
		'public' => false, //Not to display to everyone even to admin
		'show_ui' => true, //To display Note post type to admin
	    'labels' => array(
        'name' => 'Likes',
        'add_new_item' => 'Add New Like',
        'edit_item' => 'Edit Like',
        'all_items' => 'All Likes'
	    ),
	    'menu_icon' => 'dashicons-heart'

	));


}

add_action('init', 'university_post_types');