jQuery(document).ready(function($) {

   tinymce.create('tinymce.plugins.custom_plugin', {
        init : function(ed, url) {
                // Register command for when button is clicked
                ed.addCommand('custom_insert_shortcode', function() {
                    selected = tinyMCE.activeEditor.selection.getContent();

                   if( selected ){
                        //If text is selected when button is clicked
                        //Wrap shortcode around it.
                        content =  '[log-data]'+selected+'[/log-data]';
                    }else{
                        content =  '[log-data]';
                    }

                   tinymce.execCommand('mceInsertContent', false, content);
                });

           // Register buttons - trigger above command when clicked
            ed.addButton('custom_button', {title : 'Insert shortcode', cmd : 'custom_insert_shortcode', image: 'http://screenshots.sharkz.in/sushma/add1600.png' });
        },  
    });

   // Register our TinyMCE plugin
    // first parameter is the button ID1
    // second parameter must match the first parameter of the tinymce.create() function above
    tinymce.PluginManager.add('custom_button', tinymce.plugins.custom_plugin);
});