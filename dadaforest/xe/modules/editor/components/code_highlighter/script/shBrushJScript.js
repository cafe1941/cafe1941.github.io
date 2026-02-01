/**
 * SyntaxHighlighter
 * http://alexgorbatchev.com/
 *
 * SyntaxHighlighter is donationware. If you are using it, please donate.
 * http://alexgorbatchev.com/wiki/SyntaxHighlighter:Donate
 *
 * @version
 * 2.0.320 (May 03 2009)
 * 
 * @copyright
 * Copyright (C) 2004-2009 Alex Gorbatchev.
 *
 * @license
 * This file is part of SyntaxHighlighter.
 * 
 * SyntaxHighlighter is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * 
 * SyntaxHighlighter is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with SyntaxHighlighter.  If not, see <http://www.gnu.org/copyleft/lesser.html>.
 */
SyntaxHighlighter.brushes.JScript = function()
{
	var keywords =	'break case catch continue ' +
					'default delete do else false  ' +
					'for function if in instanceof ' +
					'new null return super switch ' +
					'this throw true try typeof var while with'
					;

	var jquery_keywords =
		/* Core */
		'$ jQuery each size length selector context eq get index data removeData queue dequeue fn extend noConflict '+
		/* Attributes */
		'attr removeAttr addClass hasClass removeClass toggleClass html text val '+
		/* Traversing */
		'eq filter is map not slice add children closest contents find next nextAll offsetParent parent parents prev prevAll siblings andSelf end '+
		/* Manipulation */
		'append appendTo prepend prependTo after before insertAfter insertBefore wrap wrapAll wrapInner replaceWith replaceAll empty remove clone '+
		/* CSS */
		'css offset position scrollTop scrollLeft height width innerHeight innerWidth outerHeight outerWidth '+
		/* Events */
		'ready bind one trigger triggerHandler unbind live die hover toggle blur change click dblclick error focus keydown keypress keyup load mousedown mouseenter mouseleave mousemove mouseout mouseover mouseup resize scroll select submit unload '+
		/* Effects */
		'show hide toggle slideDown slideUp slideToggle fadeIn fadeOut fadeTo animate stop fx off '+
		/* Ajax */
		'ajax load get getJSON getScript post ajaxComplete ajaxError ajaxSend ajaxStart ajaxStop ajaxSuccess ajaxSetup serialize serializeArray '+
		/* Utilities */
		'support browser version boxModel each extend grep makeArray map inArray merge unique isArray isFunction trim param'
		;

	keywords += jquery_keywords;

	this.regexList = [
		{ regex: SyntaxHighlighter.regexLib.singleLineCComments,	css: 'comments' },			// one line comments
		{ regex: SyntaxHighlighter.regexLib.multiLineCComments,		css: 'comments' },			// multiline comments
		{ regex: SyntaxHighlighter.regexLib.doubleQuotedString,		css: 'string' },			// double quoted strings
		{ regex: SyntaxHighlighter.regexLib.singleQuotedString,		css: 'string' },			// single quoted strings
		{ regex: /\s*#.*/gm,										css: 'preprocessor' },		// preprocessor tags like #region and #endregion
		{ regex: new RegExp(this.getKeywords(keywords), 'gm'),		css: 'keyword' }			// keywords
		];
	
	this.forHtmlScript(SyntaxHighlighter.regexLib.scriptScriptTags);
};

SyntaxHighlighter.brushes.JScript.prototype	= new SyntaxHighlighter.Highlighter();
SyntaxHighlighter.brushes.JScript.aliases	= ['js', 'jscript', 'javascript'];
