<?php

namespace bornfight\wpHelpers\helpers;

class PaginationHelper {
	public function get_pagination_start_page( int $current_page ): int {
		if ( $current_page == 1 || $current_page == 2 ) {
			return 1;
		}

		return $current_page - 1;
	}

	public function get_pagination_end_page( int $current_page, int $max_pages ): int {
		if ( $current_page < $max_pages - 3 ) {
			return $current_page + 2;
		}

		return $max_pages + 1;
	}
}