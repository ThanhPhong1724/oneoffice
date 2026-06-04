
		jQuery(document).ready(function ($) {
			//$('.absolute-footer .copyright-footer').html('<div><a href="https://omnis.vn/" target="_blank">Thiết kế web</a> bởi: <a href="https://omnis.vn/" target="_blank">Omnis.vn</a></div>');
			$('.product-footer .product-section #reviews').closest('.product-section').addClass('hidden');
			$('.product-footer .product-section .shop_attributes').closest('.product-section').addClass('hidden');
			$('.product-footer .product-section').find('h5.mt').each(function (index, el) {
				if ($(this).html() == 'Mô tả') {
					$(this).html('Thông tin chi tiết');
				}
			});

			$('#product-sidebar .thongtinsp').prepend('<h1>' + $('.product-info .product-title').html() + '</div>');

			$('.btn-trang').click(function (event) {
				var form = $(this).next().find('form');

				if (form.attr('method') == 'post') {
					$('html').addClass('csncngbg_openq');
					form.find('.csncngbg').addClass('openq');
					form.closest('.section').addClass('section_zindex');
					form.closest('.section').addClass('section_zindex');
				}
			});

			$('.background_close_csncngbg').click(function (event) {
				$(this).closest('.csncngbg').removeClass('openq');
				$('html').removeClass('csncngbg_openq');
				$(this).closest('.wpcf7-form').closest('.section').removeClass('section_zindex');
			});
			$('.close_csncngbg').click(function (event) {
				$(this).closest('.csncngbg').removeClass('openq');
				$('html').removeClass('csncngbg_openq');
				$(this).closest('.wpcf7-form').closest('.section').removeClass('section_zindex');
			});

			var list = new cookieList("btn_care");
			list.remove('undefined');
			list.remove('null');
			capNhatCare(list);
			// Use ooSite.homeUrl (passed via wp_localize_script) to support subdirectory installs
			var _qtUrl = (typeof ooSite !== 'undefined' && ooSite.homeUrl) ? ooSite.homeUrl + 'quan-tam/' : '/quan-tam/';
			$('.care-container .care-info .care-page-link').attr('href', _qtUrl);

			$('.js-btn-care').click(function (event) {
				var product_id = $(this).attr('data-id');
				var str_list = list.items();
				if (str_list.indexOf(product_id) != -1) {
					list.remove(product_id);
					// alert(list.items());
					$(this).removeClass('active');
					$(this).html('<span><i class="fa fa-thumbs-o-up" aria-hidden="true"></i><i class="fa fa-thumbs-up" aria-hidden="true"></i></span> Quan tâm');
				} else {
					list.add(product_id);
					// alert(list.items());
					$(this).addClass('active');
					$(this).html('<span><i class="fa fa-thumbs-o-up" aria-hidden="true"></i><i class="fa fa-thumbs-up" aria-hidden="true"></i></span> Đã quan tâm');
				}
				capNhatCare(list);
			});
		});

		function capNhatCare(list) {
			var count_care = 0;
			var str_list = '';
			//alert(list.items());
			if (list.items().toString()) {
				str_list = list.items().toString().split(',');
			}
			jQuery.each(str_list, function (index, value) {
				//alert(index + ': ' + value);
				count_care++;
				jQuery('body').find('.js-btn-care').each(function (index, el) {
					var product_id = jQuery(this).attr('data-id');
					if (product_id == value) {
						jQuery(this).addClass('active');
						jQuery(this).html('<span><i class="fa fa-thumbs-o-up" aria-hidden="true"></i><i class="fa fa-thumbs-up" aria-hidden="true"></i></span> Đã quan tâm');
					}
				});
			});

			jQuery('#masthead .care-container .count-care').html(count_care);
			if (count_care > 0) {
				jQuery('#masthead .care-container .care-info').removeClass('empty');
			} else {
				jQuery('#masthead .care-container .care-info').addClass('empty');
			}
		}

		//This is not production quality, its just demo code.
		var cookieList = function (cookieName) {
			//When the cookie is saved the items will be a comma seperated string
			//So we will split the cookie by comma to get the original array
			var cookie = jQuery.cookie(cookieName);
			//Load the items or a new array if null.
			var items = cookie ? cookie.split(/,/) : new Array();

			//Return a object that we can use to access the array.
			//while hiding direct access to the declared items array
			//this is called closures see http://www.jibbering.com/faq/faq_notes/closures.html
			return {
				"add": function (val) {
					//Add to the items.
					items.push(val);
					//Save the items to a cookie.
					//EDIT: Modified from linked answer by Nick see 
					//      http://stackoverflow.com/questions/3387251/how-to-store-array-in-jquery-cookie
					jQuery.cookie(cookieName, items.join(','), { path: '/' });
				},
				"remove": function (val) {
					//EDIT: Thx to Assef and luke for remove.
					indx = items.indexOf(val);
					if (indx != -1) items.splice(indx, 1);
					jQuery.cookie(cookieName, items.join(','), { path: '/' });
				},
				"clear": function () {
					items = null;
					//clear the cookie.
					jQuery.cookie(cookieName, null, { path: '/' });
				},
				"items": function () {
					//Get all the items.
					return items;
				}
			}
		}

		function setCookie(cname, cvalue, extimes) {
			var d = new Date();
			d.setTime(d.getTime() + (extimes));
			var expires = "expires=" + d.toUTCString();
			document.cookie = cname + "=" + cvalue + "; " + expires;
		}

		function getCookie(cname) {
			var name = cname + "=";
			var ca = document.cookie.split(';');
			for (var i = 0; i < ca.length; i++) {
				var c = ca[i];
				while (c.charAt(0) == ' ') c = c.substring(1);
				if (c.indexOf(name) == 0) return c.substring(name.length, c.length);
			}
			return "";
		}

		function empty(e) {
			switch (e) {
				case "":
					return true;
				case null:
					return true;
				case false:
					return true;
				case typeof this == "undefined":
					return true;
				default: return false;
			}
		}