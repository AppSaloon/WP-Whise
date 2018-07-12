<?php

namespace wp_whise\config;

use wp_whise\config\cpt\Estate_Cpt_Config;
use wp_whise\config\cpt\Project_Cpt_Config;

class Init_Config {

	public function __construct() {
		new Project_Cpt_Config();
		new Estate_Cpt_Config();
		new Project_Settings_Config();
	}
}