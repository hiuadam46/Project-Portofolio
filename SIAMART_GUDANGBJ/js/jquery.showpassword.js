(function($){$.fn.extend({showPassword:function(f){return this.each(function(){var c=function(a){var a=$(a);var b=$("<input type='text' />");b.insertAfter(a).attr({'class':a.attr('class'),'style':a.attr('style')});return b};var d=function($this,$that){$that.val($this.val())};var e=function(){if($checkbox.is(':checked')){d($this,$clone);$clone.show();$this.hide()}else{d($clone,$this);$clone.hide();$this.show()}};var $clone=c(this),$this=$(this),$checkbox=$(f);$checkbox.click(function(){e()});$this.keyup(function(){d($this,$clone)});$clone.keyup(function(){d($clone,$this)});e()})}})})(jQuery);