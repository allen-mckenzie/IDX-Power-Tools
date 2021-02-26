<?php

	class IDXPT_Lead_Table {

        public function hooks() {
        }

		public function validate_lead_table() {
            global $wpdb;
			$table_name = 'idxpt_leads';
			$search = $wpdb->prepare( 'SHOW TABLES LIKE %s', $wpdb->esc_like( $table_name ) );
			if( !$wpdb->get_var( $query ) === $table_name ) {
				create_lead_table();
			}
		}
		
		public function create_lead_table() {
            global $wpdb;

			$charset_collate = $wpdb->get_charset_collate();

			$sql = "CREATE TABLE `idxpt_leads` (
				`ID` mediumint(8) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                'lead_id' mediumint(8) NOT NULL,
				`first_name` varchar(255) NULL,
				`last_name` varchar(255) NULL,
				`email` varchar(255) NULL,
				`phone` varchar(255) NOT NULL,
				`receiveUpdates` varchar(4) NOT NULL,
				`subscribeDate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
				`lastActivityDate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
				`status` varchar(16) NOT NULL,
				`savedSearches` int(4) NOT NULL,
				`savedProperties` int(4) NOT NULL
			);";

			require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
			dbDelta( $sql );

            update_option( "idxpt_db_version", $idxpt_db_version );
		}

        public function update_db() {
            global $idxpt_db_version;
            if( get_site_option( 'idxpt_db_version') != $idxpt_db_version ) {

            }
        }

	}