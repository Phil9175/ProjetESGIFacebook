/**
 * @license Copyright (c) 2003-2015, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	 config.filebrowserBrowseUrl = '/view/kcfinder/browse.php?opener=ckeditor&type=files';
   config.filebrowserImageBrowseUrl = '/view/kcfinder/browse.php?opener=ckeditor&type=images';
   config.filebrowserFlashBrowseUrl = '/view/kcfinder/browse.php?opener=ckeditor&type=flash';
   config.filebrowserUploadUrl = '/view/kcfinder/upload.php?opener=ckeditor&type=files';
   config.filebrowserImageUploadUrl = '/view/kcfinder/upload.php?opener=ckeditor&type=images';
   config.filebrowserFlashUploadUrl = '/view/kcfinder/upload.php?opener=ckeditor&type=flash';
   
};
