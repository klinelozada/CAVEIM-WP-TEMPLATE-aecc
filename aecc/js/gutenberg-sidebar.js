registerPlugin( 'misha-seo', {
	render: function() {
		return el( Fragment, {},
			el( PluginSidebarMoreMenuItem,
				{
					target: 'misha-seo',
					icon: mishaIcon,
				},
				'SEO'
			),
			el( PluginSidebar,
				{
					name: 'misha-seo',
					icon: mishaIcon,
					title: 'SEO',
				},
				el( PanelBody, {},
					// Field 1
					el( MetaTextControl,
						{
							metaKey: 'misha_plugin_seo_title',
							title : 'Title',
						}
					),
					// Field 2
					el( MetaTextareaControl,
						{
							metaKey: 'misha_plugin_seo_description',
							title : 'Description',
						}
					),
					// Field 3
					el( MetaCheckboxControl,
						{
							metaKey: 'misha_plugin_seo_robots',
							title : 'Hide from search engines',
						}
					),
				)
			)
		);
	}
} );