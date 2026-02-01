function openid_login(fo_obj){
	var validator = xe.getApp('validator')[0];
	if(!validator) return false;
	if(!fo_obj.elements['_filter']) jQuery(fo_obj).prepend('<input type="hidden" name="_filter" value="" />');
	fo_obj.elements['_filter'].value = 'openid_login';
	validator.cast('ADD_CALLBACK', ['openid_login', function(form){
		var params={}, responses=[], elms=form.elements, data=jQuery(form).serializeArray();
		jQuery.each(data, function(i, field){
			var val = jQuery.trim(field.value);
			if(!val) return true;
			if(/\[\]$/.test(field.name)) field.name = field.name.replace(/\[\]$/, '');
			if(params[field.name]) params[field.name] += '|@|'+val;
			else params[field.name] = field.value;
		});
		responses = ['error','message'];
		exec_xml('member','procMemberOpenIDLogin', params, completeMessageOpenIDLogin, responses, params, form);
	}]);
	validator.cast('VALIDATE', [fo_obj,'openid_login']);
	return false;
};

(function($){
	var validator = xe.getApp('Validator')[0];
	if(!validator) return false;
	validator.cast('ADD_FILTER', ['openid_login', {
		'openid': {required:true}
	}]);
	validator.cast('ADD_MESSAGE', ['openid', 'OpenID']);
	validator.cast('ADD_MESSAGE', ['isnull', 'Please input a value for %s']);
	validator.cast('ADD_MESSAGE', ['outofrange', 'Please align the text length of %s']);
	validator.cast('ADD_MESSAGE', ['equalto', 'The value of %s is invalid']);
	validator.cast('ADD_MESSAGE', ['invalid_email', 'The format of %s is invalid. ex) developers@xpressengine.com']);
	validator.cast('ADD_MESSAGE', ['invalid_userid', 'The format of %s is invalid.\nAll values should consist of alphabets, numbers or underscore(_) and the first letter should be alphabet']);
	validator.cast('ADD_MESSAGE', ['invalid_user_id', 'The format of %s is invalid.\nAll values should consist of alphabets, numbers or underscore(_) and the first letter should be alphabet']);
	validator.cast('ADD_MESSAGE', ['invalid_homepage', 'The format of %s is invalid. ex) http://xpressengine.com/']);
	validator.cast('ADD_MESSAGE', ['invalid_korean', 'The format of %s is invalid. Please input Korean only']);
	validator.cast('ADD_MESSAGE', ['invalid_korean_number', 'The format of %s is invalid. Please input Korean or numbers']);
	validator.cast('ADD_MESSAGE', ['invalid_alpha', 'The format of %s is invalid. Please input alphabets only']);
	validator.cast('ADD_MESSAGE', ['invalid_alpha_number', 'The format of %s is invalid. Please input alphabets or numbers']);
	validator.cast('ADD_MESSAGE', ['invalid_number', 'The format of %s is invalid. Please input numbers only']);
})(jQuery);