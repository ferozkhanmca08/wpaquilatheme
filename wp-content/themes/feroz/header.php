
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="description" content="">
        <meta name="author" content="">

        <title>ebook landing page template</title>

        <!-- CSS FILES -->        
        <link rel="preconnect" href="https://fonts.googleapis.com">
        
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

        <link href="https://fonts.googleapis.com/css2?family=Unbounded:wght@300;400;600;700&display=swap" rel="stylesheet">

        <link href="<?php bloginfo('template_directory') ?>/css/bootstrap.min.css" rel="stylesheet">

        <link href="<?php bloginfo('template_directory') ?>/css/bootstrap-icons.css" rel="stylesheet">

        <link href="<?php bloginfo('template_directory') ?>/css/templatemo-ebook-landing.css" rel="stylesheet">
     </head> 


 <nav class="navbar navbar-expand-lg">
                <div class="container">
                    <a class="navbar-brand" href="<?php echo site_url(); ?>">
                        <!--i class="navbar-brand-icon bi-book me-2"></i>
                        <span>ebook</span-->
                        	<img src="<?php echo get_header_image(); ?>" />
                    </a>

                    <div class="d-lg-none ms-auto me-3">
                        <a href="#" class="btn custom-btn custom-border-btn btn-naira btn-inverted">
                            <i class="btn-icon bi-cloud-download"></i>
                            <span>Download</span><!-- duplicated another one below for mobile -->
                        </a>
                    </div>
    
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
    
                    <div class="collapse navbar-collapse" id="navbarNav">                        
                    	<?php  wp_nav_menu(array('theme_location'=>'primary-menu', 'menu_class'=>'nav')) ?>
                        <div class="d-none d-lg-block">
                            <a href="#" class="btn custom-btn custom-border-btn btn-naira btn-inverted">
                                <i class="btn-icon bi-cloud-download"></i>
                                <span>Download</span><!-- duplicated above one for mobile -->
                            </a>
                        </div>
                    </div>
                </div>
	</nav>