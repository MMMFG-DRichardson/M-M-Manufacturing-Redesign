/* ==========================================================
 * wc.js
 * http://soliloquywp.com/
 * ==========================================================
 * Copyright 2014 Thomas Griffin.
 *
 * Licensed under the GPL License, Version 2.0 or later (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.gnu.org/licenses/gpl-2.0.html
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 * ========================================================== */
;(function($){
	
    $(function(){
	    
        // Initialize JS.
        soliloquywcInit();

        // Initialize JS when the Featured Content slider type is selected.
        $(document).on('soliloquySliderType', function(e, data){
            if ( data.type && 'wc' == data.type ) {
                soliloquywcInit();
            }
        });

        // Callback function to initialize the Featured Content JS.
        function soliloquywcInit() {

            // Run conditionals.
            soliloquywcConditionals();

        }

        // Callback function to show/hide conditional elements.
        function soliloquywcConditionals() {
	        
            // Show/hide post title linking if the product title is to be output.
            if ( $('#soliloquy-config-wc-product-title').is(':checked') ) {
	            
                $('#soliloquy-config-wc-product-title-link-box').show();
                
            } else {
	            
                $('#soliloquy-config-wc-product-title-link-box').hide();
                
            }
            
            $(document).on('change', '#soliloquy-config-wc-product-title', function(){
	            
                if ( $(this).is(':checked') ){
                
                    $('#soliloquy-config-wc-product-title-link-box').fadeIn();
                    
                } else { 
	                
                    $('#soliloquy-config-wc-product-title-link-box').fadeOut();
                
                }
            });
            
          
            if ( $('#soliloquy-config-wc-price-range').is(':checked') ) {
	            
                $('#soliloquy-config-wc-min-price-box, #soliloquy-config-wc-max-price-box' ).show();
                
            } else {
	            
                $('#soliloquy-config-wc-min-price-box, #soliloquy-config-wc-max-price-box').hide();
                
            }
            
            $(document).on('change', '#soliloquy-config-wc-price-range', function(){
	            
                if ( $(this).is(':checked') ){
                
                    $('#soliloquy-config-wc-min-price-box, #soliloquy-config-wc-max-price-box').fadeIn();
                    
                } else { 
	                
                    $('#soliloquy-config-wc-min-price-box, #soliloquy-config-wc-max-price-box').fadeOut();
                
                }
            });        
                
            // Show/hide content length and ellipses box if content is to be output.
            if ( 'meta_value' == $('#soliloquy-config-wc-orderby').val() ||  'meta_value_num' == $('#soliloquy-config-wc-orderby').val() ) {
	            
                $('#soliloquy-config-wc-meta-key-box').show();
            
            } else {
	            
                $('#soliloquy-config-wc-meta-key-box').hide();
            }
            $(document).on('change', '#soliloquy-config-wc-orderby', function(){
	            
                if ( 'meta_value' == $(this).val() || 'meta_value_num' == $(this).val() ) {
                    $('#soliloquy-config-wc-meta-key-box').fadeIn();
                } else {
	                
                     $('#soliloquy-config-wc-meta-key-box').fadeOut();
                }
                
            });            
            // Show/hide content length and ellipses box if content is to be output.
            if ( 'post_content' == $('#soliloquy-config-wc-content-type').val() ) {
	            
                $('#soliloquy-config-wc-content-length-box, #soliloquy-config-wc-content-ellipses-box, #soliloquy-content-wc-content-html').show();
            
            } else {
	            
                $('#soliloquy-config-wc-content-length-box, #soliloquy-config-wc-content-ellipses-box, #soliloquy-content-wc-content-html').hide();
            }
            
            $(document).on('change', '#soliloquy-config-wc-content-type', function(){
	            
                if ( 'post_content' == $(this).val() ) {
                    $('#soliloquy-config-wc-content-length-box, #soliloquy-config-wc-content-ellipses-box, #soliloquy-content-wc-content-html').fadeIn();
                } else {
	                
                    $('#soliloquy-config-wc-content-length-box, #soliloquy-config-wc-content-ellipses-box, #soliloquy-content-wc-content-html').fadeOut();
                }
                
            });

        }

    });
}(jQuery));