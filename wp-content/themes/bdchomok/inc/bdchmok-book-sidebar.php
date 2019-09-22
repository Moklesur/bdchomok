<?php

if( ! defined('ABSPATH' ) ) die;


class BD_Chomok_Sidebar {
	
	
	public function get_all_terms(){

		$term_id = get_queried_object();

		$posts = new WP_Query([
			'post_type' => 'product',
			'tax_query' => [
				[
					'taxonomy' => 'product_cat',
					'terms'	=> $term_id->term_id,
					'field'	=> 'term_id'
				]
			]
		]);

		$authors = [];
		$publishers = [];
		$subjects = [];
		$brands = [];
		$accessories = [];

		while($posts->have_posts()) {
			$posts->the_post();

			$terms = get_the_terms(
				get_the_ID(),
				'product_cat'
			);


			// for showing the terms parent uncomment the line below and change the parent compare numbers
			//echo '<pre>', print_r($terms, 1), '</pre>';


			foreach($terms as $term) {
				
				if(isset($term->parent)) {
					
					if($term->parent == 33 && ! in_array($term, $authors)) {
						$authors[] = $term;
					}
					
					if($term->parent == 32 && ! in_array($term, $publishers)) {
						$publishers[] = $term;
					}
					
					if($term->parent == 34 && ! in_array($term, $subjects)) {
						$subjects[] = $term;
					}
					
					if($term->parent == 550 && ! in_array($term, $brands)) {
						$brands[] = $term;
					}
					
					if($term->parent == 56 && ! in_array($term, $accessories)) {
						$accessories[] = $term;
					}
					
				}
				
				
			}

		}

		wp_reset_query();
		
		return [
			'authors'	=> $authors,
			'publishers' => $publishers,
			'subjects'	=> $subjects,
			'brands'	=> $brands,
			'accessories'	=> $accessories
		];

	}
	
}

