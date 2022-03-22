<?php

namespace bornfight\wpHelpers\helpers;

class WPSocialSharer extends SocialSharer {
	public function get_fb_share_link( string $url = '' ): string {
		if ( empty( $url ) ) {
			return parent::get_fb_share_link( get_permalink() );
		}

		return parent::get_fb_share_link( $url );
	}

	public function get_twitter_share_link( string $url = '' ): string {
		if ( empty( $url ) ) {
			return parent::get_twitter_share_link( get_permalink() );
		}

		return parent::get_twitter_share_link( $url );
	}

	public function get_linkedin_share_link( string $url = '', string $title = '' ): string {
		$title = ! empty( $title ) ? $title : get_the_title();
		if ( empty( $url ) ) {
			return parent::get_linkedin_share_link( get_permalink(), $title );
		}

		return parent::get_linkedin_share_link( $url, $title );
	}

	public function get_email_share_link( string $url = '', string $title = '' ): string {
		$title = ! empty( $title ) ? $title : get_the_title();
		if ( empty( $url ) ) {
			return parent::get_email_share_link( get_permalink(), $title );
		}

		return parent::get_email_share_link( $url, $title );
	}

	public function get_fb_share_count( string $url = '' ): int {
		if ( empty( $url ) ) {
			return parent::get_fb_share_count( get_permalink() );
		}

		return parent::get_fb_share_count( $url );
	}

	public function get_twitter_share_count( string $url = '' ): int {
		if ( empty( $url ) ) {
			return parent::get_twitter_share_count( get_permalink() );
		}

		return parent::get_twitter_share_count( $url );
	}

	public function get_linkedin_share_count( string $url = '' ): int {
		if ( empty( $url ) ) {
			return parent::get_linkedin_share_count( get_permalink() );
		}

		return parent::get_linkedin_share_count( $url );
	}
}
