/*
 * Really Simple Color Picker in jQuery
 * Licensed under the MIT (MIT-LICENSE.txt) licenses.
 * Copyright (c) 2008 Lakshan Perera (www.laktek.com)
 *                    Daniel Lacy (daniellacy.com)
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to
 * deal in the Software without restriction, including without limitation the
 * rights to use, copy, modify, merge, publish, distribute, sublicense, and/or
 * sell copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR 
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
 * FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS
 * IN THE SOFTWARE.
*/

(function ($jj) {
    /**
     * Create a couple private variables.
    **/
    var selectorOwner,
        activePalette,
        cItterate       = 0,
        templates       = {
            control : $jj('<div class="colorPicker-picker">&nbsp;</div>'),
            palette : $jj('<div id="colorPicker_palette" class="colorPicker-palette" />'),
            swatch  : $jj('<div class="colorPicker-swatch">&nbsp;</div>'),
            hexLabel: $jj('<label for="colorPicker_hex"></label>'),
            hexField: $jj('<input type="text" id="colorPicker_hex" />')
        },
        transparent     = "transparent",
        lastColor;

    /**
     * Create our colorPicker function
    **/
    $jj.fn.colorPicker = function (options) {
        return this.each(function () {
            // Setup time. Clone new elements from our templates, set some IDs, make shortcuts, jazzercise.
            var element      = $jj(this),
                opts         = $jj.extend({}, $jj.fn.colorPicker.defaults, options),
                defaultColor = $jj.fn.colorPicker.toHex(
                        (element.val().length > 0) ? element.val() : opts.pickerDefault
                    ),
                newControl   = templates.control.clone(),
                newPalette   = templates.palette.clone().attr('id', 'colorPicker_palette-' + cItterate),
                newHexLabel  = templates.hexLabel.clone(),
                newHexField  = templates.hexField.clone(),
                paletteId    = newPalette[0].id,
                swatch;

            /**
             * Build a color palette.
            **/
            $jj.each(opts.colors, function (i) {
                swatch = templates.swatch.clone();

                if (opts.colors[i] === transparent) {
                    swatch.addClass(transparent).text('X');

                    $jj.fn.colorPicker.bindPalette(newHexField, swatch, transparent);

                } else {
                    swatch.css("background-color", "#" + this);

                    $jj.fn.colorPicker.bindPalette(newHexField, swatch);

                }

                swatch.appendTo(newPalette);
            });

            newHexLabel.attr('for', 'colorPicker_hex-' + cItterate);

            newHexField.attr({
                'id'    : 'colorPicker_hex-' + cItterate,
                'value' : defaultColor
            });

            newHexField.bind("keydown", function (event) {
                if (event.keyCode === 13) {
                    $jj.fn.colorPicker.changeColor($jj.fn.colorPicker.toHex($jj(this).val()));
                }
                if (event.keyCode === 27) {
                    $jj.fn.colorPicker.hidePalette(paletteId);
                }
            });

            $jj('<div class="colorPicker_hexWrap" />').append(newHexLabel).appendTo(newPalette);

            newPalette.find('.colorPicker_hexWrap').append(newHexField);

            $jj("body").append(newPalette);

            newPalette.hide();



            /**
             * Build replacement interface for original color input.
            **/
            newControl.css("background-color", defaultColor);

            newControl.bind("click", function () {
                $jj.fn.colorPicker.togglePalette($jj('#' + paletteId), $jj(this));
            });

            element.after(newControl);

            element.bind("change", function () {
                element.next(".colorPicker-picker").css(
                    "background-color", $jj.fn.colorPicker.toHex($jj(this).val())
                );
            });

            // Hide the original input.
            element.val(defaultColor).hide();

            cItterate++;
        });
    };

    /**
     * Extend colorPicker with... all our functionality.
    **/
    $jj.extend(true, $jj.fn.colorPicker, {
        /**
         * Return a Hex color, convert an RGB value and return Hex, or return false.
         *
         * Inspired by http://code.google.com/p/jquery-color-utils
        **/
        toHex : function (color) {
            // If we have a standard or shorthand Hex color, return that value.
            if (color.match(/[0-9A-F]{6}|[0-9A-F]{3}$/i)) {
                return (color.charAt(0) === "#") ? color : ("#" + color);

            // Alternatively, check for RGB color, then convert and return it as Hex.
            } else if (color.match(/^rgb\(\s*(\d{1,3})\s*,\s*(\d{1,3})\s*,\s*(\d{1,3})\s*\)$/)) {
                var c = ([parseInt(RegExp.$1, 10), parseInt(RegExp.$2, 10), parseInt(RegExp.$3, 10)]),
                    pad = function (str) {
                        if (str.length < 2) {
                            for (var i = 0, len = 2 - str.length; i < len; i++) {
                                str = '0' + str;
                            }
                        }

                        return str;
                    };

                if (c.length === 3) {
                    var r = pad(c[0].toString(16)),
                        g = pad(c[1].toString(16)),
                        b = pad(c[2].toString(16));

                    return '#' + r + g + b;
                }

            // Otherwise we wont do anything.
            } else {
                return false;

            }
        },

        /**
         * Check whether user clicked on the selector or owner.
        **/
        checkMouse : function (event, paletteId) {
            var selector = activePalette,
                selectorParent = $jj(event.target).parents("#" + selector.attr('id')).length;

            if (event.target === $jj(selector)[0] || event.target === selectorOwner || selectorParent > 0) {
                return;
            }

            $jj.fn.colorPicker.hidePalette();
        },

        /**
         * Hide the color palette modal.
        **/
        hidePalette : function (paletteId) {
            $jj(document).unbind("mousedown", $jj.fn.colorPicker.checkMouse);

            $jj('.colorPicker-palette').hide();
        },

        /**
         * Show the color palette modal.
        **/
        showPalette : function (palette) {
            var hexColor = selectorOwner.prev("input").val();

            palette.css({
                top: selectorOwner.offset().top + (selectorOwner.outerHeight()),
                left: selectorOwner.offset().left
            });

            $jj("#color_value").val(hexColor);

            palette.show();

            $jj(document).bind("mousedown", $jj.fn.colorPicker.checkMouse);
        },

        /**
         * Toggle visibility of the colorPicker palette.
        **/
        togglePalette : function (palette, origin) {
            // selectorOwner is the clicked .colorPicker-picker.
            if (origin) {
                selectorOwner = origin;
            }

            activePalette = palette;

            if (activePalette.is(':visible')) {
                $jj.fn.colorPicker.hidePalette();

            } else {
                $jj.fn.colorPicker.showPalette(palette);

            }
        },

        /**
         * Update the input with a newly selected color.
        **/
        changeColor : function (value) {
            selectorOwner.css("background-color", value);

            selectorOwner.prev("input").val(value).change();

            $jj.fn.colorPicker.hidePalette();
        },

        /**
         * Bind events to the color palette swatches.
        */
        bindPalette : function (paletteInput, element, color) {
            color = color ? color : $jj.fn.colorPicker.toHex(element.css("background-color"));

            element.bind({
                click : function (ev) {
                    lastColor = color;

                    $jj.fn.colorPicker.changeColor(color);
                },
                mouseover : function (ev) {
                    lastColor = paletteInput.val();

                    $jj(this).css("border-color", "#AAA");

                    paletteInput.val(color);
                },
                mouseout : function (ev) {
                    $jj(this).css("border-color", "#111");

                    paletteInput.val(selectorOwner.css("background-color"));

                    paletteInput.val(lastColor);
                }
            });
        }
    });

    /**
     * Default colorPicker options.
     *
     * These are publibly available for global modification using a setting such as:
     *
     * $jj.fn.colorPicker.defaults.colors = ['151337', '111111']
     *
     * They can also be applied on a per-bound element basis like so:
     *
     * $jj('#element1').colorPicker({pickerDefault: 'efefef', transparency: true});
     * $jj('#element2').colorPicker({pickerDefault: '333333', colors: ['333333', '111111']});
     *
    **/
    $jj.fn.colorPicker.defaults = {
        // colorPicker default selected color.
        pickerDefault : "CC3300",

        // Default color set.
        colors : [
'000000', '000033', '000066', '000099', '0000CC', '0000FF',
'330000', '330033', '330066', '330099', '3300CC', '3300FF',
'660000', '660033', '660066', '660099', '6600CC', '6600FF',
'003300', '003333', '003366', '003399', '0033CC', '0033FF',
'333300', '333333', '333366', '333399', '3333CC', '3333FF',
'663300', '663333', '663366', '663399', '6633CC', '6633FF',
'006600', '006633', '006666', '006699', '0066CC', '0066FF',
'336600', '336633', '336666', '336699', '3366CC', '3366FF',
'666600', '666633', '666666', '666699', '6666CC', '6666FF',
'009900', '009933', '009966', '009999', '0099CC', '0099FF',
'339900', '339933', '339966', '339999', '3399CC', '3399FF',
'669900', '669933', '669966', '669999', '6699CC', '6699FF',
'00CC00', '00CC33', '00CC66', '00CC99', '00CCCC', '00CCFF',
'33CC00', '33CC33', '33CC66', '33CC99', '33CCCC', '33CCFF',
'66CC00', '66CC33', '66CC66', '66CC99', '66CCCC', '66CCFF',
'00FF00', '00FF33', '00FF66', '00FF99', '00FFCC', '00FFFF',
'33FF00', '33FF33', '33FF66', '33FF99', '33FFCC', '33FFFF',
'66FF00', '66FF33', '66FF66', '66FF99', '66FFCC', '66FFFF',

'990000', '990033', '990066', '990099', '9900CC', '9900FF',
'CC0000', 'CC0033', 'CC0066', 'CC0099', 'CC00CC', 'CC00FF',
'FF0000', 'FF0033', 'FF0066', 'FF0099', 'FF00CC', 'FF00FF',
'993300', '993333', '993366', '993399', '9933CC', '9933FF',
'CC3300', 'CC3333', 'CC3366', 'CC3399', 'CC33CC', 'CC33FF',
'FF3300', 'FF3333', 'FF3366', 'FF3399', 'FF33CC', 'FF33FF',
'996600', '996633', '996666', '996699', '9966CC', '9966FF',
'CC6600', 'CC6633', 'CC6666', 'CC6699', 'CC66CC', 'CC66FF',
'FF6600', 'FF6633', 'FF6666', 'FF6699', 'FF66CC', 'FF66FF',
'999900', '999933', '999966', '999999', '9999CC', '9999FF',
'CC9900', 'CC9933', 'CC9966', 'CC9999', 'CC99CC', 'CC99FF',
'FF9900', 'FF9933', 'FF9966', 'FF9999', 'FF99CC', 'FF99FF',
'99CC00', '99CC33', '99CC66', '99CC99', '99CCCC', '99CCFF',
'CCCC00', 'CCCC33', 'CCCC66', 'CCCC99', 'CCCCCC', 'CCCCFF',
'FFCC00', 'FFCC33', 'FFCC66', 'FFCC99', 'FFCCCC', 'FFCCFF',
'99FF00', '99FF33', '99FF66', '99FF99', '99FFCC', '99FFFF',
'CCFF00', 'CCFF33', 'CCFF66', 'CCFF99', 'CCFFCC', 'CCFFFF',
'FFFF00', 'FFFF33', 'FFFF66', 'FFFF99', 'FFFFCC', 'FFFFFF'],

        // If we want to simply add more colors to the default set, use addColors.
        addColors : []
    };

})(jQuery);

$jj(function() { 
	$jj('#colorpopup').colorPicker(); 
	$jj('#colorslider').colorPicker(); 
	$jj('#colorheader').colorPicker(); 
	$jj('#colorhey').colorPicker(); 
	$jj('#colorfooter').colorPicker(); 
	$jj('#colorexit').colorPicker();  
	$jj('#colorinside').colorPicker();  
	$jj('#colorregular').colorPicker();  
	$jj('#colorregister').colorPicker();
});