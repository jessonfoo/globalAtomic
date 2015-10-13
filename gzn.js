(function(jQuery){
  jQuery.fn.gznElSwap = function(el) {
      var attrs = {};
      jQuery.each(this[0].attributes, function(x, attr) {
          attrs[attr.nodeName] = attr.nodeValue;
        }); 
      this.replaceWith(function() {
            return jQuery("<" + el + "/>", attrs).append(jQuery(this).contents());
          });
    } 
})(jQuery);
