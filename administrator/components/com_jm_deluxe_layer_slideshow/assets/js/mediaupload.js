function jInsertFieldValue(value, id) {
	var old_value = document.id(id).value;
	if (old_value != value) {
		var elem = document.id(id);
		elem.value = value;
		elem.fireEvent("change");
		if (typeof(elem.onchange) === "function") {
			elem.onchange();
		}
		changeBackground(value,id);
	}
}

function jMediaRefreshPreview(id) {
	var value = document.id(id).value;
	var img = document.id(id + "_preview");
	if (img) {
		if (value) {
			img.src = "' . JURI::root() . '" + value;
			document.id(id + "_preview_empty").setStyle("display", "none");
			document.id(id + "_preview_img").setStyle("display", "");
		} else { 
			img.src = ""
			document.id(id + "_preview_empty").setStyle("display", "");
			document.id(id + "_preview_img").setStyle("display", "none");
		} 
	} 
}

function jMediaRefreshPreviewTip(tip)
{
	tip.setStyle("display", "block");
	var img = tip.getElement("img.media-preview");
	var id = img.getProperty("id");
	id = id.substring(0, id.length - "_preview".length);
	jMediaRefreshPreview(id);
}