jQuery(document).ready(function() {
    jQuery('.im').addClass("hidden1").viewportChecker({

        classToAdd: 'visible1 animated bounceInRight',
        offset: 100
       });



           jQuery('#emkanatsite img').addClass("hidden1").viewportChecker({

        classToAdd: 'visible1 animated flipInX',
        offset: 100
       });

       	       jQuery('.tim').addClass("hidden1").viewportChecker({

        classToAdd: 'visible1 tim animated flipInY ',
        offset: 100
       });

       	   	       jQuery('.headimg,.imgslide').addClass("hidden1").viewportChecker({

        classToAdd: 'visible1 tim animated fadeInDown ',
        offset: 100
       });
});