<?php
/**
 * @package   ModuloBox
 * @author    Themeone <themeone.master@gmail.com>
 * @copyright 2017 Themeone
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$allowed_html = array(
	'a' => array(
		'href'   => array(),
		'target' => array()
	)
);

$Envato_token    = 'https://build.envato.com/create-token/?purchase:download=t&purchase:verify=t&purchase:list=t';
$ticket_support  = 'https://themeoneticket.ticksy.com/';
$renew_support   = 'https://codecanyon.net/user/theme-one/portfolio';

$plugin_info     = get_option( MOBX_NAME . '_plugin_info' );
$access_token    = isset( $plugin_info['access_token'] ) ? $plugin_info['access_token'] : null;
$last_version    = isset( $plugin_info['version'] ) ?  $plugin_info['version'] : MOBX_VERSION;
$plugin_license  = isset( $plugin_info['license'] ) ? ' (' . $plugin_info['license'] . ')' : null;
$supported_until = isset( $plugin_info['supported_until'] ) ? $plugin_info['supported_until'] : null;

if ( $supported_until ) {
	
	$days_left = __( 'Days left', 'modulobox' );
	$expired   = __( 'Expired', 'modulobox' );
	$diff_days = floor( ( strtotime( $supported_until ) - time() ) / ( 60 * 60 * 24 ) );
	$supported_until = $diff_days > 0 ? ' (' . $diff_days . ' ' . $days_left . ')' : ( $plugin_info ? ' (' . $expired . ')' : null );
	
}

echo '<div class="mobx-tab-content mobx-updates-support-content">';

	echo '<h2>' . esc_html__( 'Updates &amp; Support', 'modulobox' ) . '</h2>';
	echo '<p>';
		esc_html_e( 'In order to benefit of automatic updates in your admin dashboard, you must register ModuloBox.', 'modulobox' );
		echo '<br>';
		esc_html_e( 'The registration system is made thanks to Envato API (full OAuth authentication flow).', 'modulobox' );
		echo '<br>';
		esc_html_e( 'No personal data are retrieved or stored by ModuloBox plugin when registering.', 'modulobox' );
	echo '</p>';

	echo '<h3>' . esc_html__( 'Register Plugin', 'modulobox' ) . esc_html( $plugin_license ) . '</h3>';
	echo '<p>' . esc_html__( 'Please find below the steps to register ModuloBox:', 'modulobox' ) . '</p>';

	echo '<ol class="mobx-list">';
		echo '<li>' . sprintf( wp_kses( __( 'Click <a target="_blank" href="%s">Generate A Personal Token</a> to be directed to the Token Creation page', 'modulobox' ), $allowed_html ), esc_url( $Envato_token ) ) . '</li>';
		echo '<li>' . esc_html__( 'Enter a name in the "Token Name" field (for example: ModuloBox)', 'modulobox' ) . '</li>';
		echo '<li>' . esc_html__( 'Check the "Terms and Conditions" checkbox, then click "Create Token"', 'modulobox' ) . '</li>';
		echo '<li>' . esc_html__( 'Copy your generated Personal Token, select confirm checkbox and click "Woohoo Got It"', 'modulobox' ) . '</li>';
		echo '<li>' . esc_html__( 'Enter your Personal Token in the field below and click "Register ModuloBox"', 'modulobox' ) . '</li>';
	echo '</ol>';

	echo '<br>';

	echo '<input type="password" class="mobx-register-input" placeholder="' . esc_attr__( 'Enter your Envato Personal Token', 'modulobox' ) . '" value="' . esc_attr( $access_token ) . '">';
	echo '<button type="button" class="mobx-register-button' . ( $plugin_info ? ' mobx-registered' : null ) . '" data-type="register_plugin" data-msg="registering_msg">' . esc_html__( 'Register ModuloBox', 'modulobox' ) . '</button>';

	echo '<h3>' . esc_html__( 'Premium Ticket Support', 'modulobox' ) . esc_html( $supported_until ) . '</h3>';

	if ( $plugin_info ) { 

		echo '<p>' . esc_html__( 'Get direct help from our qualified support team.', 'modulobox' ) . '</p>';
		
		if ( isset( $diff_days ) && $diff_days > 0 ) {
			echo '<a target="_blank" class="mobx-button mobx-ticket-button" href="' . esc_url( $ticket_support ) . '">' . esc_html__( 'Open a Ticket', 'modulobox' ) . '</a>';
		} else {
			echo '<a target="_blank" class="mobx-button mobx-ticket-button mobx-renew-support" href="' . esc_url( $renew_support ) . '">' . esc_html__( 'Renew Support', 'modulobox' ) . '</a>';
		}

	} else {

		echo '<p>' . esc_html__( 'Please register ModuloBox Plugin to get direct help from our qualified support team.', 'modulobox' ) . '</p>';

	}

	echo '<h3>' . esc_html__( 'Automatic Updates', 'modulobox' ) . '</h3>';
	
	if ( $plugin_info ) { 

		echo '<p>';
			esc_html_e( 'Automatic updates use the native WordPress update system.', 'modulobox' );
			echo '<br>';
			esc_html_e( 'The package will be directly downloaded from Envato.', 'modulobox' );
		echo '</p>';

		if ( version_compare( $last_version, MOBX_VERSION ) <=  0 ) {

			echo '<a class="mobx-button mobx-check-update-button" data-type="check_plugin_update" data-msg="checking_msg">' . esc_html__( 'Check for updates', 'modulobox' ) . '</a>';

		} else {

			// Upgrade link
			$upgrade_link = add_query_arg( array(
				'action' => 'upgrade-plugin',
				'plugin' => esc_attr( MOBX_BASE )
			), self_admin_url( 'update.php' ) );

			// Update button
			printf(
				'<a class="update-now mobx-button mobx-update-button" href="%1$s" aria-label="%2$s" data-name="%3$s %6$s" data-plugin="%4$s" data-slug="%5$s" data-version="%6$s">%7$s</a>',
				esc_url( wp_nonce_url( $upgrade_link, 'upgrade-plugin_' . esc_attr( MOBX_BASE ) ) ),
				esc_attr__( 'Update now', 'modulobox' ),
				esc_attr( MOBX_NAME ),
				esc_attr( MOBX_BASE ),
				sanitize_key( dirname( MOBX_BASE ) ),
				esc_attr( $last_version ),
				sprintf( esc_html__( 'Update ModuloBox to v%s', 'modulobox' ), $last_version )
			);

		}

	} else {

		echo '<p>' . esc_html__( 'Please register ModuloBox Plugin to benefit of automatic updates.', 'modulobox' ) . '</p>';	

	}

echo '</div>';
