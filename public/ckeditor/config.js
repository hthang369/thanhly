/**
 * @license Copyright (c) 2003-2022, CKSource Holding sp. z o.o. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	config.allowedContent = true;
	config.filebrowserBrowseUrl = location.origin + '/ckfinder/browser';
	config.filebrowserImageBrowseUrl = location.origin + '/ckfinder/browser?type=Images';
	config.filebrowserFlashBrowseUrl = location.origin + '/ckfinder/browser?type=Flash';
	config.filebrowserUploadUrl = location.origin + './ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files';
	config.filebrowserImageUploadUrl = location.origin + './ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';
	config.filebrowserFlashUploadUrl = location.origin + './ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash';
};
