jQuery(function($){

    //aqui añado la clase que hace que se active o desactive el menu-open
    $(".menu-toggler").on('click',function(){
        $("body").toggleClass("menu-open")
    });

    //aqui llamamos a la funcion owl para que el carousel funcione
    $(".owl-carousel").owlCarousel({
        loop: true, //opción que hace que el bucle del carrousel se repita infinitmente
        margin:10, //espacio entre elementos del carrousel
        nav: true, //habilita los controles de navegacion del carrousel
        items:1, //esto indica que se muesta 1 elemento en el carrusel (modo movil)
        autoHeight:true, //los botones del nav se adaptan a la altura según la imagen mas alta
        responsive:{
            600:{
                items:2 //aqui indicamos que cuando la pantalla sea mayor a 600px se mostrarán 2 elementos (modo desktop)
            }
        }
    });
});