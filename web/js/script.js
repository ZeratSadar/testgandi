$("document").ready(function(){

  var isOpera = !!window.opera || navigator.userAgent.indexOf(' OPR/') >= 0;
      // Opera 8.0+ (UA detection to detect Blink/v8-powered Opera)
  var isFirefox = typeof InstallTrigger !== 'undefined';   // Firefox 1.0+
  var isSafari = Object.prototype.toString.call(window.HTMLElement).indexOf('Constructor') > 0;
      // At least Safari 3+: "[object HTMLElementConstructor]"
  var isChrome = !!window.chrome && !isOpera;              // Chrome 1+
  var isIE = /*@cc_on!@*/false || !!document.documentMode; // At least IE6

  //script INDEX SLIDER
  //animation début slider
  var slideWidth = $("#slideshow").width();
  var slideHeight = slideWidth/2;
  $("#slideshow").css("height","0vw");
  $("#slideshow").animate({
      height:slideHeight
  },400,"swing");

  //animation auto slide
  var etape = 0;
  var nb_element_de_class=$(".imgslider").length;
  function slide() {
      etape++;
      if (etape==nb_element_de_class){
          etape=0;
      };
      var leftv = etape*-slideWidth;
      $("#sContent").animate({
      left:leftv.toString()+"px",
      }, 2000,"swing");
  };
  var next = setInterval(function(){slide();},5000);

  //click slide manuel
  $(".btnslider").click(function(){
      clearInterval(next);
     etape = parseInt($(this.id).selector.substring(4,5));
     var leftv = etape*-slideWidth;
    $("#sContent").stop();
     $("#sContent").animate({
      left:leftv.toString()+"px",
      }, 200,"swing");
     next = setInterval(function(){slide();},5000);
  });

  //correction taille du slide en resize
  function resizeSlider() {
    slideWidth = $("#slideshow").width();
    slideHeight = slideWidth/2;
    $("#slideshow").css("height","45vw");
  };

  //script MENU

  var winH = $("#logoms").height()+35;
   $(window).scroll(function ()    {
      if ( $(window).scrollTop() > winH)
      {
          $("#menu").addClass("fix");
          $("#menu").removeClass("unfix");
          $("#milieu").css("margin-top","285px");
      }
      else  if ($(window).scrollTop() < winH)
      {
          $("#menu").addClass("unfix");
          $("#menu").removeClass("fix");
          $("#milieu").css("margin-top","5px");
      }
  });


  //script FOOTER

  function placeFooter() {
    var footerpos = window.innerHeight-(parseInt($("#menu").css("height")))-(parseInt($("#footer").css("height")))-120;
    $("#milieu").css("min-height",footerpos);
  };

  placeFooter();


  //script COMMU

  //hover des images
  // $(".fichecom").hover(function(){
  //   $("#"+this.id.toString()+" .imgfichecom").animate({
  //     opacity:"0.1"
  //   },100);
  //   $("#"+this.id.toString()+" .logofichecom").animate({
  //     opacity:"0.1"
  //   },100);
  // }, function(){
  //   $("#"+this.id.toString()+" .imgfichecom").animate({
  //     opacity:"1"
  //   },200);
  //   $("#"+this.id.toString()+" .logofichecom").animate({
  //     opacity:"1"
  //   },200);
  // });
 //  //modale
 //  $("#modal").hide();
 //  $("#voile").hide();

 // var ident;
 //  function modalOpen() {
 //    //Ajout du contenu
 //    //ajouter selection de classe en fonction de l'ID généré par PHP
 //    $(".modalphoto").css("background-image",$("#"+ident.toString()+" .imgfichecom").css("background-image"));
 //    $(".modaltitre").html($("#"+ident.toString()+" .txtfichecom").html());
 //    $(".modaltext").html($("#"+ident.toString()+" .descfichecom").html());
 //    $(".modalinfo").html($("#"+ident.toString()+" .infofichecom").html());
 //    //modal pour event
 //    $(".modalphotoevent").css("background-image",$("#"+ident.toString()+" .fichephotoevent").css("background-image"));
 //    $(".modaldateevent").html($("#"+ident.toString()+" .dateevent").html());
 //    $(".modaltitreevent").html($("#"+ident.toString()+" .titreevent").html());
 //    $(".modaltextevent").html($("#"+ident.toString()+" .hiddentext").html());
 //    //modal pour media
 //    if (document.getElementById("modalcontphotomedia")) {
 //      if (isChrome == true) {
 //        $(".modalphotomedia").attr("src",$("#"+ident.toString()+" .fichephotomedia").css("background-image").substring($("#"+ident.toString()+" .fichephotomedia").css("background-image").indexOf("h"),$("#num1 .fichephotomedia").css("background-image").lastIndexOf(')')));
 //      } else {
 //        $(".modalphotomedia").attr("src",$("#"+ident.toString()+" .fichephotomedia").css("background-image").substring($("#"+ident.toString()+" .fichephotomedia").css("background-image").indexOf("h"),$("#num1 .fichephotomedia").css("background-image").length-2));
 //      };
 //      $(".modaldatemedia").html($("#"+ident.toString()+" .dateevent").html());
 //      $(".modaltitremedia").html($("#"+ident.toString()+" .titreevent").html());
 //      $(".modaltextmedia").html($("#"+ident.toString()+" .hiddentext").html());
 //    };
 //    //animation de l'ouverture
 //    this.heightSize = $("#modal").height();
 //    $("#modal").css("margin-top",(this.heightSize/-2).toString()+"px")
 //    $("#modal").show();
 //    $("#modal").css("height","0px")
 //    $("#voile").show();
 //    $("#modal").animate({
 //      height:this.heightSize+"px"
 //    },400,"swing", function(){
 //      $("#crux").animate({
 //        top:"-12px",
 //        right:"-12px"
 //      },400,"swing");
 //    });
 //    /*$("#contmodal").animate({
 //      height:this.heightSize+"px"
 //    },400,"swing");*/
 //  };

 //  $(".fichecom").click(function(){
 //    ident = this.id;
 //    modalOpen();
 //  });


  // $("#crux").click(function(){
  // 	$("#modal").hide();
  // 	$("#modal").css("height","0px");
  //   $("#crux").css({
  //     top:"5px",
  //     right:"5px"
  //   });
  // });

 //  function modalPlace () {
 //    if (document.body.offsetWidth > 900) {
 //      this.modalwidth = 900;
 //    } else if (document.body.offsetWidth > 600) {
 //  		this.modalwidth = document.body.offsetWidth/100*80;
 //  	} else {
 //  		this.modalwidth = document.body.offsetWidth/100*90;
 //  	};
 //  	$("#modal").css("width",this.modalwidth.toString()+"px");
 //  	$("#modal").css("margin-left", (this.modalwidth/-2).toString()+"px");
 //    this.modalwidth = document.body.offsetWidth/100*90;
 //    $(".modalmedia").css("width",this.modalwidth.toString()+"px");
 //    $(".modalmedia").css("margin-left", (this.modalwidth/-2).toString()+"px");
 //  };

 //  modalPlace();


  //script COMMENT

  function posImgComment() {
  	if (document.body.offsetWidth > 600) {
  		this.widthComp = (document.body.offsetWidth/100*80).toString()+"px";
  	} else {
  		this.widthComp = (document.body.offsetWidth).toString()+"px";
  	};
  	$("#photop0").css("width", this.widthComp);
    $("#photop1").css("width", this.widthComp);
    $("#textcomment").css("width", this.widthComp);
    if (document.getElementById("photop0")) {
  	   this.margleft = (document.getElementById("photop0").offsetWidth/-2).toString()+"px";
    };
  	$("#photop0").css("margin-left", this.margleft);
    $("#photop1").css("margin-left", this.margleft);
    $("#textcomment").css("margin-left", this.margleft);
  };

  posImgComment();

  //script OnResize

  var adaptResize = window.onresize = function() {
			placeFooter();
			modalPlace();
			posImgComment();
      resizeSlider();
	};

});
