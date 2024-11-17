
  if (window.XMLHttpRequest)
      {
        // AJAX nutzen mit IE7+, Chrome, Firefox, Safari, Opera
        //alert("AJAX nutzen mit IE7+, Chrome, Firefox, Safari, Opera");
        xmlhttp=new XMLHttpRequest();
      }
  else
      {
        // AJAX mit IE6, IE5
        //alert("AJAX mit IE6, IE5");
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
      }

      // Wenn die Fenstergröße verändert, wird automatisch die Seite mit den letzten Parameter neu aufgebaut
														window.onresize = function(){ONRESIZE();};										
														function ONRESIZE()
														{
															var isMobile =
															{
																Android: function () {return navigator.userAgent.match(/Android/i);},
																BlackBerry: function () {return navigator.userAgent.match(/BlackBerry/i);},
																iOS: function () {return navigator.userAgent.match(/iPhone|iPod|iPad/i);},
																Opera: function () {return navigator.userAgent.match(/Opera Mini/i);},
																Windows: function () {return navigator.userAgent.match(/IEMobile/i);},
																any: function () {return ((isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows()));}
															};
															if (isMobile.any())
															{
																var result = 'Your on a mobile device';
																if (orientation_onresize!=window.orientation)
																{
																	// Orientierung, Weite und Höhe des Bildschirms festhalten
																	orientation_onresize=window.orientation;
																	swidth_onresize=window.innerWidth;
																	sheight_onresize=window.innerHeight;
																	main(display_onresize,sid_onresize,navigation_onresize,nav1row_onresize,nav2row_onresize,nav3row_onresize,nav4row_onresize,con1row_onresize,con2row_onresize,con3row_onresize,con4row_onresize);
																}
															}
															else
																{
																	var result = 'No mobile device';
																	// Orientierung, Weite und Höhe des Bildschirms festhalten
																	orientation_onresize=window.orientation;
																	swidth_onresize=window.innerWidth;
																	sheight_onresize=window.innerHeight;
																	main(display_onresize,sid_onresize,navigation_onresize,nav1row_onresize,nav2row_onresize,nav3row_onresize,nav4row_onresize,con1row_onresize,con2row_onresize,con3row_onresize,con4row_onresize);
																}
															}

                                                            // -----------------------------------------------------------------------------------------------------------------------------
  // Styles generieren
  $sty1="overflow:hidden; position:fixed; z-index:1;";
  $sty2="overflow:auto; padding-right:100; position:absolute; z-index:2;";
  $sty3="position:absolute; -webkit-appearance: none; border-radius:0; z-index:3";
  $sty4="position:absolute; -webkit-appearance: none; border-radius:0; z-index:4";
  $sty101="overflow:hidden; position:absolute; z-index:101;";
  $sty102="overflow:auto; padding-right:100; position:absolute; z-index:102;";
  $sty103="overflow:hidden; position:absolute; -webkit-appearance: none; border-radius:0; z-index:103;";
  $sty104="overflow:hidden; position:absolute; -webkit-appearance: none; border-radius:0; z-index:104;";
  $sty201="overflow:hidden; position:absolute; z-index:201;";
  
  