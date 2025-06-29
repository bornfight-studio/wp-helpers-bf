<?php

namespace bornfight\wpHelpers\bundles;

class AssetBundle
{

protected static $include_base_path = '/static/';

    public array $js  = array();
    public array $css = array();

    public bool $async_css = false;

    public function get_base_url() {
        return INCLUDE_URL . self::$include_base_path;
    }

    public function get_base_path() {
        return get_theme_file_path( self::$include_base_path );
    }

    public static function register() {
        $bundle = new static();
        $bundle->enqueue_scripts();
        $bundle->enqueue_styles();
    }

    protected function enqueue_scripts() {
        foreach ( $this->js as $handle => $data ) {
            if ( isset( $data['path'] ) === false ) {
                throw new \Exception( 'Missing path definition for ' . $handle );
            }

            $path           = $data['path'];
            $version        = isset( $data['version'] ) ? $data['version'] : 1.0;
            $timestamp_bust = isset( $data['timestamp_bust'] ) && $data['timestamp_bust'] ? $data['timestamp_bust'] : false;
            $in_footer      = isset( $data['in_footer'] ) ? $data['in_footer'] : true;

            if ( $timestamp_bust ) {
                $version .= sprintf( '.%d', filemtime( $this->get_base_path() . $path ) );
            }

            wp_enqueue_script( $handle, $this->get_base_url() . $path, array(), $version, $in_footer );

            if ( isset( $data['localize'] ) ) {
                if ( isset( $data['localize']['object'] ) === false ) {
                    throw new \Exception( 'Missing object name for localize ' . $handle );
                }

                $localize_data = isset( $data['localize']['data'] ) ? $data['localize']['data'] : array();

                wp_localize_script( $handle, $data['localize']['object'], $localize_data );
            }

        }
    }

    protected function enqueue_styles() {
        if ( $this->async_css ) {
            add_action( 'wp_head', function () {
                ?>
                <script>
                    function loadCSS(e, n, o, t) {
                        "use strict";
                        var d = window.document.createElement("link"),
                            i = n || window.document.getElementsByTagName("script")[0], r = window.document.styleSheets;
                        return d.rel = "stylesheet", d.href = e, d.media = "only x", t && (d.onload = t), i.parentNode.insertBefore(d, i), d.onloadcssdefined = function (e) {
                            for (var n, o = 0; o < r.length; o++) r[o].href && r[o].href === d.href && (n = !0);
                            n ? e() : setTimeout(function () {
                                d.onloadcssdefined(e)
                            })
                        }, d.onloadcssdefined(function () {
                            d.media = o || "all"
                        }), d
                    }

                    // CSS DEV
					<?php foreach ( $this->css as $handle => $data ) { ?>
                    loadCSS("<?php echo $this->get_base_url() . $data['path']; ?>");
					<?php } ?>
                </script>
                <noscript>
                    <!-- CSS DEV -->
					<?php
                    foreach ( $this->css as $handle => $data ) { ?>
                        <link rel="stylesheet" href="<?php echo $this->get_base_url() . $data['path']; ?>">
						<?php
                    } ?>
                </noscript>
				<?php
            } );
        } else {
            foreach ( $this->css as $handle => $data ) {
                if ( isset( $data['path'] ) === false ) {
                    throw new \Exception( 'Missing path definition for ' . $handle );
                }

                $path           = $data['path'];
                $version        = isset( $data['version'] ) ? $data['version'] : 1.0;
                $timestamp_bust = isset( $data['timestamp_bust'] ) && $data['timestamp_bust'] ? $data['timestamp_bust'] : false;
                $in_footer      = isset( $data['in_footer'] ) ? $data['in_footer'] : true;

                if ( $timestamp_bust ) {
                    $version .= sprintf( '.%d', filemtime( $this->get_base_path() . $path ) );
                }

                wp_enqueue_style( $handle, $this->get_base_url() . $path, array(), $version, $in_footer );
            }
        }
    }
}