/**--------------------------------------------------------------------# Package - JoomlaMan Module# Version 1.0# --------------------------------------------------------------------# Author - JoomlaMan http://www.joomlaman.com# Copyright (coffee) 2012 - 2013 JoomlaMan.com. All Rights Reserved.# @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later# Websites: http://www.JoomlaMan.com---------------------------------------------------------------------**/jQuery.noConflict();(function ($) {	$.fn.jmOnOff = function(){		this.each(function () {			var $this = $(this);			var div = $('<div>').addClass('jmonoff');			var $spanon = $('<span>').addClass('jmonoff-on');			var $spanoff = $('<span>').addClass('jmonoff-off');			div.append($spanon).append($spanoff)			if($this.is(':checked')){				div.addClass('checked');			}			div.addClass('onoff');			$spanon.click(function(){				div.addClass('checked');				$this.attr('checked', true);				$this.trigger('change');			});			$spanoff.click(function(){				div.removeClass('checked');				$this.attr('checked', false);				$this.trigger('change');			});			$this.after(div);			$this.css({display:'none'});		});	}		$.fn.jmSelectSingle = function(){ 		this.each(function () {			var $this = $(this);			$this.wrap('<div style="float:left"/>');			var $div = $('<div>').addClass('jmlist-single-options');			var $div_select = $('<div>').addClass('jmlist-single').addClass('slideUp');			$this.after($div);			$this.after($div_select);			jQuery(document).click(function(){				$div.parent().slideUp();				$div_select.removeClass('slideDown').addClass('slideUp');			})				$div_select.toggle(function(){				if($(this).hasClass('slideDown')){					$div.parent().slideUp();					$(this).removeClass('slideDown').addClass('slideUp');				}else{					$div.parents('.overlay').css({display:'block'});					$div.parent().slideDown();					$(this).removeClass('slideUp').addClass('slideDown');				}			},function(){				if($(this).hasClass('slideDown')){					$div.parent().slideUp();					$(this).removeClass('slideDown').addClass('slideUp');				}else{					$div.parents('.overlay').css({display:'block'});					$div.parent().slideDown();					$(this).removeClass('slideUp').addClass('slideDown');				}			});			$.each($this.find('option'), function(i,el){                                var $self = $(this);				var $option = $('<div>').addClass('option').attr('index',i).text($(el).text());				if($(el).is(':selected')){					$option.addClass('selected');					$div_select.text($(el).text());				}				$option.click(function(){					$(this).addClass('selected');					$this.find('option').prop('selected', false);					$this.find('option').eq(i).prop('selected', true);					$div_select.text($(this).text());					//$self.trigger('click');					$this.trigger('change');					$div.find('.option').not(this).removeClass('selected');					$div.parent().slideUp();				}).appendTo($div);			});					$div.wrap('<div class="overlay" style="position:absolute; z-index:1000; display: none;"/>');			$this.css({display:'none'});		});	};	$(document).ready(function(){		$('input[type=checkbox].jm-field.onoff').jmOnOff();		$('select.jm-field.single').jmSelectSingle(); 	})})(jQuery);