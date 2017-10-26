/*
Copyright (c) 2003-2012, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.editorConfig = function( config )
{
	config.language = 'zh-cn';
	config.uiColor = '#FFA';
	config.skin = 'v2';
	config.width = 850;
	config.height = 400;
	config.toolbar = 'Full';
	
	config.enterMode = CKEDITOR.ENTER_BR; 
	
	config.disableNativeSpellChecker = false ;
    config.scayt_autoStartup = false;
	
	config.font_names = '宋体/宋体;黑体/黑体;仿宋/仿宋_GB2312;楷体/楷体_GB2312;隶书/隶书;幼圆/幼圆;'+ config.font_names ;


};
