/**
 * plugin.js
 *
<<<<<<< HEAD
 * Released under LGPL License.
 * Copyright (c) 1999-2015 Ephox Corp. All rights reserved
=======
 * Copyright, Moxiecode Systems AB
 * Released under LGPL License.
>>>>>>> origin/master
 *
 * License: http://www.tinymce.com/license
 * Contributing: http://www.tinymce.com/contributing
 */

/*global tinymce:true */

tinymce.PluginManager.add('fullscreen', function(editor) {
	var fullscreenState = false, DOM = tinymce.DOM, iframeWidth, iframeHeight, resizeHandler;
<<<<<<< HEAD
	var containerWidth, containerHeight, scrollPos;
=======
	var containerWidth, containerHeight;
>>>>>>> origin/master

	if (editor.settings.inline) {
		return;
	}

	function getWindowSize() {
		var w, h, win = window, doc = document;
		var body = doc.body;

		// Old IE
		if (body.offsetWidth) {
			w = body.offsetWidth;
			h = body.offsetHeight;
		}

		// Modern browsers
		if (win.innerWidth && win.innerHeight) {
			w = win.innerWidth;
			h = win.innerHeight;
		}

		return {w: w, h: h};
	}

<<<<<<< HEAD
	function getScrollPos() {
		var vp = tinymce.DOM.getViewPort();

		return {
			x: vp.x,
			y: vp.y
		};
	}

	function setScrollPos(pos) {
		scrollTo(pos.x, pos.y);
	}

=======
>>>>>>> origin/master
	function toggleFullscreen() {
		var body = document.body, documentElement = document.documentElement, editorContainerStyle;
		var editorContainer, iframe, iframeStyle;

		function resize() {
			DOM.setStyle(iframe, 'height', getWindowSize().h - (editorContainer.clientHeight - iframe.clientHeight));
		}

		fullscreenState = !fullscreenState;

		editorContainer = editor.getContainer();
		editorContainerStyle = editorContainer.style;
		iframe = editor.getContentAreaContainer().firstChild;
		iframeStyle = iframe.style;

		if (fullscreenState) {
<<<<<<< HEAD
			scrollPos = getScrollPos();
=======
>>>>>>> origin/master
			iframeWidth = iframeStyle.width;
			iframeHeight = iframeStyle.height;
			iframeStyle.width = iframeStyle.height = '100%';
			containerWidth = editorContainerStyle.width;
			containerHeight = editorContainerStyle.height;
			editorContainerStyle.width = editorContainerStyle.height = '';

			DOM.addClass(body, 'mce-fullscreen');
			DOM.addClass(documentElement, 'mce-fullscreen');
			DOM.addClass(editorContainer, 'mce-fullscreen');

			DOM.bind(window, 'resize', resize);
			resize();
			resizeHandler = resize;
		} else {
			iframeStyle.width = iframeWidth;
			iframeStyle.height = iframeHeight;

			if (containerWidth) {
				editorContainerStyle.width = containerWidth;
			}

			if (containerHeight) {
				editorContainerStyle.height = containerHeight;
			}

			DOM.removeClass(body, 'mce-fullscreen');
			DOM.removeClass(documentElement, 'mce-fullscreen');
			DOM.removeClass(editorContainer, 'mce-fullscreen');
			DOM.unbind(window, 'resize', resizeHandler);
<<<<<<< HEAD
			setScrollPos(scrollPos);
=======
>>>>>>> origin/master
		}

		editor.fire('FullscreenStateChanged', {state: fullscreenState});
	}

	editor.on('init', function() {
<<<<<<< HEAD
		editor.addShortcut('Ctrl+Shift+F', '', toggleFullscreen);
=======
		editor.addShortcut('Meta+Alt+F', '', toggleFullscreen);
>>>>>>> origin/master
	});

	editor.on('remove', function() {
		if (resizeHandler) {
			DOM.unbind(window, 'resize', resizeHandler);
		}
	});

	editor.addCommand('mceFullScreen', toggleFullscreen);

	editor.addMenuItem('fullscreen', {
		text: 'Fullscreen',
<<<<<<< HEAD
		shortcut: 'Ctrl+Shift+F',
		selectable: true,
		onClick: function() {
			toggleFullscreen();
			editor.focus();
		},
=======
		shortcut: 'Meta+Alt+F',
		selectable: true,
		onClick: toggleFullscreen,
>>>>>>> origin/master
		onPostRender: function() {
			var self = this;

			editor.on('FullscreenStateChanged', function(e) {
				self.active(e.state);
			});
		},
		context: 'view'
	});

	editor.addButton('fullscreen', {
		tooltip: 'Fullscreen',
<<<<<<< HEAD
		shortcut: 'Ctrl+Alt+F',
=======
		shortcut: 'Meta+Alt+F',
>>>>>>> origin/master
		onClick: toggleFullscreen,
		onPostRender: function() {
			var self = this;

			editor.on('FullscreenStateChanged', function(e) {
				self.active(e.state);
			});
		}
	});

	return {
		isFullscreen: function() {
			return fullscreenState;
		}
	};
<<<<<<< HEAD
});
=======
});
>>>>>>> origin/master
