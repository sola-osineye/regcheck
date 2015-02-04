window.onload = function() {
new Ajax.Autocompleter("registration_no", "product_description",base_url + "register/ajaxsearch/",{} );

//$('drugs_description').onsubmit = function(){
//    inline_results();
//	return false;
//}
}
//function inline_results(){
//  new Ajax.Updater('output_description', base_url + 'register/ajaxsearch',{method:'post', postBody:'product_name=true&registration_no=' + $F('registration_no')});
//  new Effect.Appear('output_description');
//}