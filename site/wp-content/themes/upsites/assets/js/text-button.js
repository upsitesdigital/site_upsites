(function() {
  tinymce.PluginManager.add('US_tc_button', function(editor, url) {
    editor.addButton('US_tc_button', {
      text: 'Custom button',
      icon: false,
      onclick: function() {
        editor.windowManager.open({
          title: 'Insert button tag',
          body: [{
            type: 'textbox',
            name: 'title',
            label: 'Texto'
          }, {
            type: 'textbox',
            name: 'link',
            label: 'Link'
          }, {
            type: 'radio',
            name: 'target',
            label: 'Nova aba'
          }],
          onsubmit: function(e) {
            let target = e.data.target == 1 ? '_blank' : '_self';
            editor.insertContent('<a target="' + target + '" class="btnPost" href="' + e.data.link + '">' + e.data.title + '</a>');
          }
        });
      }
    });
  });
})();