/* 
 *  Tested With:
 *    animate.css (v3.5.1): https://github.com/daneden/animate.css
 *    Bootstrap modal.js (v3.3.6): http://getbootstrap.com
 *  Usage: Be sure your modal div has class "animated" instead of "fade"
 *    and add the new data attributes for animate.css animation to use.
 *    Example:
 *    <div id="my-modal" class="modal animated" data-animate-css-show="fadeInRight" data-animate-css-hide="fadeOutLeft">
 *
 *    You can also use $(el).animateCss(class) to animate.css other stuff.
 */
(function($){

	$.fn.extend({
		animateCss: function (animationName) {
			var animationEnd = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
			animationName += $(this).hasClass('animated') ? '' : ' animated';
			$(this).addClass(animationName).one(animationEnd, function() {
				$(this).removeClass(animationName).trigger('animateCssEnd');
			});
		}
	});

	var _bs_original_hide = $.fn.modal.Constructor.prototype.hide;
	var _bs_original_show = $.fn.modal.Constructor.prototype.show;
	var _bs_original_backdrop = $.fn.modal.Constructor.prototype.backdrop;

	$.extend($.fn.modal.Constructor.prototype, {
		hide: function (e) {
			var animate = this.$element.hasClass('fade') ? 'fade' : '';
			animate = this.$element.hasClass('animated') ? 'animated' : animate;
			if(animate == 'animated'){
				if (e) e.preventDefault();

				e = $.Event('hide.bs.modal');

				this.$element.trigger(e);

				if (!this.isShown || e.isDefaultPrevented()) return;

				this.isShown = false;

				this.escape();
				this.resize();

				$(document).off('focusin.bs.modal');

				this.$element
					.removeClass('in')
					.off('click.dismiss.bs.modal')
					.off('mouseup.dismiss.bs.modal');

				this.$dialog.off('mousedown.dismiss.bs.modal');

				var that = this;
				this.$element.find('.modal-dialog').off('animateCssEnd').on('animateCssEnd',function(e){
					that.hideModal();
				});
				var effect = this.$element.attr('data-animate-css-hide') || 'fadeOutUp';
				this.$element.find('.modal-dialog').animateCss(effect);
			} else {
				return _bs_original_hide.call(this, e);
			}
		},
		show: function (_relatedTarget) {
			var animate = this.$element.hasClass('fade') ? 'fade' : '';
			animate = this.$element.hasClass('animated') ? 'animated' : animate;
			if(animate == 'animated'){
				var that = this;
				var e    = $.Event('show.bs.modal', { relatedTarget: _relatedTarget });

				this.$element.trigger(e);

				if (this.isShown || e.isDefaultPrevented()) return;

				this.isShown = true;

				this.checkScrollbar();
				this.setScrollbar();
				this.$body.addClass('modal-open');

				this.escape();
				this.resize();

				this.$element.on('click.dismiss.bs.modal', '[data-dismiss="modal"]', $.proxy(this.hide, this));

				this.$dialog.on('mousedown.dismiss.bs.modal', function () {
					that.$element.one('mouseup.dismiss.bs.modal', function (e) {
						if ($(e.target).is(that.$element)) that.ignoreBackdropClick = true
					})
				});

				this.backdrop(function () {
					if (!that.$element.parent().length) {
						that.$element.appendTo(that.$body); // don't move modals dom position
					}

					that.$element
						.show()
						.scrollTop(0);

					that.adjustDialog();

					that.$element[0].offsetWidth; // force reflow

					that.$element.addClass('in');

					that.enforceFocus();

					var e = $.Event('shown.bs.modal', { relatedTarget: _relatedTarget });

					that.$element.find('.modal-dialog').off('animateCssEnd').on('animateCssEnd',function(){
						that.$element.trigger('focus').trigger(e)
					});
					var effect = that.$element.attr('data-animate-css-show') || 'fadeInDown';
					that.$element.find('.modal-dialog').animateCss(effect);
				})
			} else {
				return _bs_original_show.call(this, _relatedTarget);
			}
		},
		backdrop: function (callback) {
			var animate = this.$element.hasClass('fade') ? 'fade' : '';
			animate = this.$element.hasClass('animated') ? 'animated' : animate;
			if(animate == 'animated') {
				var that = this;

				if (this.isShown && this.options.backdrop) {
					var doAnimate = $.support.transition;

					this.$backdrop = $(document.createElement('div'))
						.addClass('modal-backdrop fade')
						.appendTo(this.$body);

					this.$element.on('click.dismiss.bs.modal', $.proxy(function (e) {
						if (this.ignoreBackdropClick) {
							this.ignoreBackdropClick = false;
							return
						}
						if (e.target !== e.currentTarget) return;
						this.options.backdrop == 'static'
							? this.$element[0].focus()
							: this.hide()
					}, this))

					if (doAnimate) this.$backdrop[0].offsetWidth; // force reflow

					this.$backdrop.addClass('in');

					if (!callback) return;

					doAnimate ?
						this.$backdrop
							.one('bsTransitionEnd', callback)
							.emulateTransitionEnd(150) :
						callback()

				} else if (!this.isShown && this.$backdrop) {
					this.$backdrop.removeClass('in');

					var callbackRemove = function () {
						that.removeBackdrop();
						callback && callback()
					};
					$.support.transition ?
						this.$backdrop
							.one('bsTransitionEnd', callbackRemove)
							.emulateTransitionEnd(150) :
						callbackRemove()

				} else if (callback) {
					callback()
				}
			} else {
				return _bs_original_backdrop.call(this, callback);
			}
		}
	});
}(jQuery));