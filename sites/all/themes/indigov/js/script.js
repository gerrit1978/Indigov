/**
 * @file
 * A JavaScript file for the theme.
 *
 * In order for this JavaScript to be loaded on pages, see the instructions in
 * the README.txt next to this file.
 */

// JavaScript should be made compatible with libraries other than jQuery by
// wrapping it with an "anonymous closure". See:
// - https://drupal.org/node/1446420
// - http://www.adequatelygood.com/2010/3/JavaScript-Module-Pattern-In-Depth
(function ($, Drupal, window, document, undefined) {


// To understand behaviors, see https://drupal.org/node/756722#behaviors
Drupal.behaviors.whiteCanvas = {
  attach: function(context, settings) {
  
    $('.hoekske').each(function(index) {
      // get parent width
      var titleWidth = ($(this).parent().find('h2').width()) + 17;
      $(this).width(titleWidth);
      var paper = Raphael($('.hoekske')[index], titleWidth, 30);
			var attr = {
				fill: "#ffffff",
				stroke: "none"
			};
      var circle = paper.rect(0, 10, 200, 30);
      circle.rotate(-3);
      circle.attr(attr);
    });
  
    $('.block-hoekske').each(function(index) {
      // get parent width
      var titleWidth = ($(this).parent().find('h2').width()) + 17;
      $(this).width(titleWidth);
      var paper = Raphael($('.block-hoekske')[index], titleWidth, 30);
			var attr = {
				fill: "#ffffff",
				stroke: "none"
			};
      var circle = paper.rect(0, 10, 200, 30);
      circle.rotate(-3);
      circle.attr(attr);
    });
    
  
/*
    // set canvas size
    $("canvas").each(function() {
      var titleWidth = $(this).parent().find('h2').width();
      $(this).css({
        width: titleWidth,
        display: "block"
      });
      $(this).width(titleWidth);
    });
  
    var canvasElements = document.getElementsByTagName("canvas");
    var length = canvasElements.length;
    canvas = null;
    for (var i = 0; i < length; i++) {
      canvas = canvasElements[i];
	    if (canvas.getContext) {
	      var canvasContext = canvas.getContext("2d");
	      canvasContext.beginPath();
	      canvasContext.rect(0, 0, 200, 100);
	      canvasContext.fillStyle = 'red';
	      canvasContext.fill();
	    }
    }
*/
/*
    $('canvas.white').each(function() {
      var canvasWidth = $(this).width();
			$("canvas").drawPolygon({
			  fillStyle: "#36c",
			  x: 100, y: 750,
			  radius: 750,
			  sides: 3,
			});
*/
/*
			$("canvas").drawRect({
			  fillStyle: "#fff",
			  x: 150, y: 145,
			  width: 310,
			  height: 100,
			  rotate: -4
			});

    });
*/
  }
};


})(jQuery, Drupal, this, this.document);
