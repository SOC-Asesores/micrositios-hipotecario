$( document ).ready(function() {
    $('.multiple-items').slick({
        infinite: true,
        slidesToShow: 4,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
        arrows: true,
        responsive: [
          {
            breakpoint: 768,
            settings: {
              arrows: false,
              centerMode: true,
              centerPadding: '40px',
              slidesToShow: 2
            }
          },
          {
            breakpoint: 480,
            settings: {
              arrows: false,
              centerMode: true,
              centerPadding: '40px',
              slidesToShow: 1
            }
          }
        ]
    });

    

    $('.multiple-items-3').slick({
        infinite: true,
        slidesToShow: 4,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
        arrows: true,
        responsive: [
          {
            breakpoint: 768,
            settings: {
              arrows: false,
              centerMode: true,
              centerPadding: '40px',
              slidesToShow: 2
            }
          },
          {
            breakpoint: 480,
            settings: {
              arrows: false,
              centerMode: true,
              centerPadding: '40px',
              slidesToShow: 1
            }
          }
        ]
    });

     $('#filter-city').change(function(){
        var value = $(this).find("option:selected").attr('value');
        $('.asesor-card').addClass("d-none");
        $('.'+value).removeClass("d-none");
    });
    $("#myTab .nav-item .nav-link").click(function(e){
      var id = $(this).attr("aria-controls");
      $(".tab-pane").removeClass("active");
      $(".tab-pane").removeClass("show");
      $("#"+id).addClass("active");
      $("#"+id).addClass("show");
    });
    $("#but-hipotecario").click(function(e){
      e.preventDefault();
      $("#but-hipotecario").addClass("active");
      $("#but-empresarial").removeClass("active");
      $("#but-seguros").removeClass("active");
      $("#but-otros").removeClass("active");

      $("#info-hipotecario").removeClass("d-none-sli");
      $("#info-empresarial").addClass("d-none-sli");
      $("#info-seguros").addClass("d-none-sli");
      $("#info-otros").addClass("d-none-sli");
     

    });
    $("#but-empresarial").click(function(e){
      e.preventDefault();
      $("#but-hipotecario").removeClass("active");
      $("#but-empresarial").addClass("active");
      $("#but-seguros").removeClass("active");
      $("#but-otros").removeClass("active");

       $("#info-hipotecario").addClass("d-none-sli");
      $("#info-empresarial").removeClass("d-none-sli");
      $("#info-seguros").addClass("d-none-sli");
      $("#info-otros").addClass("d-none-sli");
     
    });
    $("#but-seguros").click(function(e){
      e.preventDefault();
      $("#but-hipotecario").removeClass("active");
      $("#but-empresarial").removeClass("active");
      $("#but-seguros").addClass("active");
      $("#but-otros").removeClass("active");

       $("#info-hipotecario").addClass("d-none-sli");
      $("#info-empresarial").addClass("d-none-sli");
      $("#info-seguros").removeClass("d-none-sli");
      $("#info-otros").addClass("d-none-sli");

    });
    $("#but-otros").click(function(e){
      e.preventDefault();
      $("#but-hipotecario").removeClass("active");
      $("#but-empresarial").removeClass("active");
      $("#but-seguros").removeClass("active");
      $("#but-otros").addClass("active");
      
       $("#info-hipotecario").addClass("d-none-sli");
      $("#info-empresarial").addClass("d-none-sli");
      $("#info-seguros").addClass("d-none-sli");
      $("#info-otros").removeClass("d-none-sli");

    });
    $(".want-asesoria").click(function(e){
      $(".form-aseso").removeClass("d-none");
      $(".info-pop").addClass("d-none");
    });
    $('a[href*="#"]').on('click', function (e) {
        
    });
    $('.top-chevron').on('click', function (e) {
      e.preventDefault();
      $(".certificado_content").toggleClass("show");
    });
    $('.paso_1').on('click', function (e) {
      e.preventDefault();
      $(".cotizador_lista li a").removeClass("active");
      $(".paso_1").addClass("active");
      $(".pasos").addClass("d-none");
      $(".info_1").removeClass("d-none");
    });
    $('.paso_2').on('click', function (e) {
      e.preventDefault();
      $(".cotizador_lista li a").removeClass("active");
      $(".paso_2").addClass("active");
      $(".pasos").addClass("d-none");
      $(".info_2").removeClass("d-none");
    });
    $('.paso_3').on('click', function (e) {
      e.preventDefault();
      $(".cotizador_lista li a").removeClass("active");
      $(".paso_3").addClass("active");
      $(".pasos").addClass("d-none");
      $(".info_3").removeClass("d-none");
    });
    $('.paso_4').on('click', function (e) {
      e.preventDefault();
      $(".cotizador_lista li a").removeClass("active");
      $(".paso_4").addClass("active");
      $(".pasos").addClass("d-none");
      $(".info_4").removeClass("d-none");
    });
    $('.paso_5').on('click', function (e) {
      e.preventDefault();
      $(".cotizador_lista li a").removeClass("active");
      $(".paso_5").addClass("active");
      $(".pasos").addClass("d-none");
      $(".info_5").removeClass("d-none");
    });
    $(".close").click(function(e){
       $(".form-aseso").addClass("d-none");
        $(".info-pop").removeClass("d-none");
    });
});

    $(document).on("click", function(event){
        if(!$(event.target).closest(".modal-dialog").length){
            $(".form-aseso").addClass("d-none");
            $(".info-pop").removeClass("d-none");
        }
    });

    var lastScrollTop = 0;
                $(window).scroll(function(event){

                   var st = $(this).scrollTop();
                   if (st == 0){
                       $('.text-md-center.text-center.ml-md-4.movil-log-2').addClass('movil-log');
                       $('.text-md-center.text-center.ml-md-4.movil-log-2').removeClass('movil-log-2');
                       $('body.plata').addClass("plata-2");
                       $('body.plata').removeClass("plata");
                       $('body.oro').addClass("oro-2");
                       $('body.oro').removeClass("oro");
                       $('body.diamante').addClass("diamante-2");
                       $('body.diamante').removeClass("diamante");
                       $(".top-head").addClass("d-none");
                       $(".certificado").removeClass("d-none");
                   } else {
                    $('.text-md-center.text-center.ml-md-4.movil-log').addClass('movil-log-2');
                      $('.text-md-center.text-center.ml-md-4.movil-log').removeClass('movil-log');
                       $('body.plata-2').addClass("plata");
                       $('body.plata-2').removeClass("plata-2");
                       $('body.oro-2').addClass("oro");
                       $('body.oro-2').removeClass("oro-2");
                       $('body.diamante-2').addClass("diamante");
                       $('body.diamante-2').removeClass("diamante-2");
                       $(".top-head").removeClass("d-none");
                       $(".certificado").addClass("d-none");
                   }
                   lastScrollTop = st;
                });


 