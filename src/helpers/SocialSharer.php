<?php

namespace bornfight\wpHelpers\helpers;

class SocialSharer {
	public function get_fb_share_link( string $url ): string {
		return sprintf( 'https://www.facebook.com/sharer/sharer.php?u=%s', $url );
	}

	public function get_twitter_share_link( string $url ): string {
		return sprintf( 'https://twitter.com/intent/tweet?url=%s', $url );
	}

	public function get_linkedin_share_link( string $url, string $title = '' ): string {
		return sprintf( 'https://www.linkedin.com/shareArticle?mini=true&url=%s&title=%s&summary=&source=', $url, $title );
	}

	public function get_email_share_link( string $url, string $title = '' ): string {
		return sprintf( 'mailto:?to=&body=%s&subject=%s', $url, $title );
	}

	public function get_fb_share_count( string $url ): int {
		$link = sprintf( 'https://graph.facebook.com/?id=%s', $url );

		try {
			$data = json_decode( @file_get_contents( $link ) );

			if ( isset( $data->share ) && isset( $data->share->share_count ) ) {
				return $data->share->share_count;
			}

			return 0;
		} catch ( \Exception $e ) {
			return 0;
		}
	}

	public function get_twitter_share_count( string $url ): int {
		$link = sprintf( 'http://opensharecount.com/count.json?url=%s', $url );


		try {
			$data = json_decode( @file_get_contents( $link ) );

			return $data->count;
		} catch ( \Exception $e ) {
			return 0;
		}
	}

	public function get_linkedin_share_count( string $url ): int {
		$link = sprintf( 'http://www.linkedin.com/countserv/count/share?url=%s&format=json', $url );

		try {
			$data = json_decode( @file_get_contents( $link ) );

			return $data->count;
		} catch ( \Exception $e ) {
			return 0;
		}
	}
}
