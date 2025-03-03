<?php

namespace bornfight\wpHelpers\helpers;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

class BreadcrumbsHelper
{
    private string $post_url   = '';
    private string $post_title = '';

    private string $home_url   = '';
    private string $home_title = '';

    private array $crumbs = array();

    public function __construct( $home_title = '',  string $home_url = '', string $post_title = '', string $post_url = '') {

        if( empty( $post_url ) ) {
            $this->post_url = get_the_permalink();
        } else {
            $this->post_url = $post_url;
        }

        if( empty( $post_title ) ) {
            $this->post_title = get_the_title();
        } else {
            $this->post_title = $post_title;
        }

        if( empty( $home_url ) ) {
            $this->home_url = get_home_url();
        } else {
            $this->home_url = $home_url;
        }

        if( ! empty( $home_title ) ) {
            $this->home_title = $home_title;
        }

		$this->build_crumbs_from_url();
    }


    private function build_crumbs_from_url(): void {

		// base url is homepage
		$base_url = trailingslashit( $this->home_url );

		// remove homepage url from post url
		$diff_url = str_replace( $this->home_url, '', $this->post_url);

		// clean from slashes
		$path = ltrim( $diff_url, '/' );
		$path = rtrim( $path, '/' );

        if( ! empty( $path ) ) {

			// explode path
            $ex = explode( '/', $path );

			// remove last item from array, that is actual post
			array_pop( $ex );

			// first crumb is homepage
			$this->add_crumb( $this->home_title, trailingslashit( $this->home_url ), true, false );

			// now try to get crumb title and url
            if( ! empty( $ex ) ) {
				$url_stack = array();
                foreach( $ex as $url_segment ) {
					$url_stack[] = $url_segment;

					// build post url and try to get post_id
					$post_url = $base_url . implode( '/', $url_stack );
					$post_id = url_to_postid( $post_url );

					if( $post_id ) {
						$post_title = get_the_title( $post_id );
					} else {
						$post_title = $url_segment;
					}

					$this->add_crumb( $post_title, trailingslashit( $post_url ), false, false );
                }
            }

			// last is only title
			$this->add_crumb( $this->post_title, '', false, true );
        }
    }

	public function reset_crumbs(): void {
		$this->crumbs = array();
	}

    public function add_crumb( $title, $url, $first = false, $last = false ): void {
        $this->crumbs[] = array(
            'title'  => $title,
            'url'    => $url,
            'first'  => $first,
            'last'   => $last,
        );
    }

    public function get_crumbs(): array {
        return $this->crumbs;
    }

}
