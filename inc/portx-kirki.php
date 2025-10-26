<?php

// Register Kirki panel
new \Kirki\Panel(
	'portx_panel',
	[
		'priority'    => 10,
		'title'       => esc_html__( 'Portx Options', 'portx' ),
		'description' => esc_html__( 'Portx options finds here!', 'portx' ),
	]
);

function top_header_section(){
	new \Kirki\Section(
		'portx_header',
		[
			'title'       => esc_html__( 'Top header options', 'portx' ),
			'description' => esc_html__( 'Top header options are here.', 'portx' ),
			'panel'       => 'portx_panel',
			'priority'    => 160,
		]
	);
	

	//Time
	new \Kirki\Field\Text(
		[
			'settings' => 'top_header_time_title',
			'label'    => esc_html__( 'Time Title', 'portx' ),
			'section'  => 'portx_header',
			'default'  => esc_html__( 'Sunday Closed', 'portx' ),
			'priority' => 10,
		]
	);
	new \Kirki\Field\Text(
		[
			'settings' => 'top_header_time',
			'label'    => esc_html__( 'Time', 'portx' ),
			'section'  => 'portx_header',
			'default'  => esc_html__( 'Mon - Sat 9.00 - 18.00', 'portx' ),
			'priority' => 10,
		]
	);

	// Email
	new \Kirki\Field\Text(
		[
			'settings' => 'top_header_email_title',
			'label'    => esc_html__( 'Email Title', 'portx' ),
			'section'  => 'portx_header',
			'default'  => esc_html__( 'Email', 'portx' ),
			'priority' => 10,
		]
	);
	new \Kirki\Field\Text(
		[
			'settings' => 'top_header_email',
			'label'    => esc_html__( 'Email', 'portx' ),
			'section'  => 'portx_header',
			'default'  => esc_html__( 'portxinfo@gmail.com', 'portx' ),
			'priority' => 10,
		]
	);

	// Phone
	new \Kirki\Field\Text(
		[
			'settings' => 'top_header_phone_title',
			'label'    => esc_html__( 'Phone Title', 'portx' ),
			'section'  => 'portx_header',
			'default'  => esc_html__( 'Call Us', 'portx' ),
			'priority' => 10,
		]
	);
	new \Kirki\Field\Text(
		[
			'settings' => 'top_header_phone',
			'label'    => esc_html__( 'Phone', 'portx' ),
			'section'  => 'portx_header',
			'default'  => esc_html__( '(+1) 122 456 789', 'portx' ),
			'priority' => 10,
		]
	);
}
top_header_section();

function company_social_section(){
  new \Kirki\Section(
    'portx_company_social',
		[
			'title'       => esc_html__( 'Company Social Options', 'portx' ),
			'description' => esc_html__( 'Company social options are here.', 'portx' ),
			'panel'       => 'portx_panel',
			'priority'    => 160,
		]
  );
	new \Kirki\Field\Text(
		[
			'settings' => 'company_social_facebook',
			'label'    => esc_html__( 'Facebook', 'portx' ),
			'section'  => 'portx_company_social',
			'default'  => esc_html__( '#', 'portx' ),
			'priority' => 10,
		]
	);

	new \Kirki\Field\Text(
		[
			'settings' => 'company_social_instagram',
			'label'    => esc_html__( 'Instagram', 'portx' ),
			'section'  => 'portx_company_social',
			'default'  => esc_html__( '#', 'portx' ),
			'priority' => 10,
		]
	);

  new \Kirki\Field\Text(
		[
			'settings' => 'company_social_twitter',
			'label'    => esc_html__( 'Twitter', 'portx' ),
			'section'  => 'portx_company_social',
			'default'  => esc_html__( '#', 'portx' ),
			'priority' => 10,
		]
	);

	new \Kirki\Field\Text(
		[
			'settings' => 'company_social_linkedin',
			'label'    => esc_html__( 'Linkedin', 'portx' ),
			'section'  => 'portx_company_social',
			'default'  => esc_html__( '#', 'portx' ),
			'priority' => 10,
		]
	);
}
company_social_section();

function header_logo(){
	new \Kirki\Section(
		'portx_header_logo',
		[
			'title'       => esc_html__( 'Header Logo & CTA', 'portx' ),
			'description' => esc_html__( 'Header Logo & CTA options are here.', 'portx' ),
			'panel'       => 'portx_panel',
			'priority'    => 160,
		]
	);
	
	new \Kirki\Field\Image(
		[
			'settings' => 'header_logo_white',
			'label'    => esc_html__( 'Logo', 'portx' ),
			'section'  => 'portx_header_logo_white',
			'default'  => esc_html__( get_template_directory_uri() . '/assets/img/logo/footer-logo.png', 'portx' ),
			'priority' => 10,
		]
	);

	new \Kirki\Field\Image(
		[
			'settings' => 'header_logo_black',
			'label'    => esc_html__( 'Black Logo', 'portx' ),
			'section'  => 'portx_header_logo',
			'default'  => esc_html__( get_template_directory_uri() . '/assets/img/logo/black-logo.png', 'portx' ),
			'priority' => 10,
		]
	);

  new \Kirki\Field\Text(
		[
			'settings' => 'header_cta_button_text',
			'label'    => esc_html__( 'CTA Button Text', 'portx' ),
			'section'  => 'portx_header_logo',
			'default'  => esc_html__( 'Request a Quote', 'portx' ),
			'priority' => 10,
		]
	);

  new \Kirki\Field\Text(
		[
			'settings' => 'header_cta_button_url',
			'label'    => esc_html__( 'CTA Button URL', 'portx' ),
			'section'  => 'portx_header_logo',
			'default'  => esc_html__( '#', 'portx' ),
			'priority' => 10,
		]
	);

	// MObile CTA button
  new \Kirki\Field\Text(
		[
			'settings' => 'mobile_cta_button_text',
			'label'    => esc_html__( 'Mobile CTA Button Text', 'portx' ),
			'section'  => 'portx_header_logo',
			'default'  => esc_html__( 'Request a Quote', 'portx' ),
			'priority' => 10,
		]
	);

  new \Kirki\Field\Text(
		[
			'settings' => 'mobile_cta_button_url',
			'label'    => esc_html__( 'Mobile CTA Button URL', 'portx' ),
			'section'  => 'portx_header_logo',
			'default'  => esc_html__( '#', 'portx' ),
			'priority' => 10,
		]
	);
}
header_logo();

function footer_section(){
  new \Kirki\Section(
    'portx_footer',
    [
      'title'       => esc_html__( 'Footer Options', 'portx' ),
      'description' => esc_html__( 'Footer options are here.', 'portx' ),
      'panel'       => 'portx_panel',
      'priority'    => 160,
    ]
  );
  
  new \Kirki\Field\Textarea(
    [
      'settings' => 'footer_copyright_text',
      'label'    => esc_html__( 'Copyright Text', 'portx' ),
      'section'  => 'portx_footer',
      'default'  => esc_html__( '© Copyright 2023, Portx. All Rights Reserved', 'portx' ),
      'priority' => 10,
    ]
  );
}
footer_section();