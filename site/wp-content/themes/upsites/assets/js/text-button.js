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
            let origin = e.data.link.indexOf("?") != -1 ? e.data.link + '&origin=' + jQuery('input[name="post_title"]').val() : e.data.link + '?origin=' + jQuery('input[name="post_title"]').val();
            editor.insertContent('<a data-test="' + origin + '" rel="dofollow" target="' + target + '" class="btnPost" href="' + origin + '">' + e.data.title + '</a>');
          }
        });
      }
    });
  });
  tinymce.PluginManager.add('US_tc_button2', function(editor, url) {
    editor.addButton('US_tc_button2', {
      text: 'Call to action',
      icon: false,
      onclick: function() {
        editor.windowManager.open({
          title: 'Insert button tag',
          body: [{
            type: 'textbox',
            name: 'shortcode',
            label: 'Shortcode',
            value: '[calltoaction title="Precisando de um site profissional?" text="Descubra quanto custa o seu site"]'
          }],
          onsubmit: function(e) {
            editor.insertContent(e.data.shortcode);
          }
        });
      }
    });
  });

  
  tinymce.PluginManager.add('US_tc_button3', function(editor, url) {
    editor.addButton('US_tc_button3', {
      text: 'Citação (Sucesso)',
      icon: false,
      onclick: function() {
        editor.windowManager.open({
          title: 'Insert blockquote tag',
          width: 500,
          height: 150,
          body: [{
            type: 'textbox',
            name: 'text',
            label: 'Texto',
            value: '',
            multiline: true,
            minHeight: 100,
          }],
          onsubmit: function(e) {
            editor.insertContent('<blockquote class="success"><div class="icon"><img src="'+url+'/../img/reviewed.svg" alt=""></div><p>' + e.data.text + '</p></blockquote>');
          }
        });
      }
    });
  });
  tinymce.PluginManager.add('US_tc_button4', function(editor, url) {
    editor.addButton('US_tc_button4', {
      text: 'Citação (Aviso)',
      icon: false,
      onclick: function() {
        editor.windowManager.open({
          title: 'Insert blockquote tag',
          width: 500,
          height: 150,
          body: [{
            type: 'textbox',
            name: 'text',
            label: 'Texto',
            value: '',
            multiline: true,
            minHeight: 100,
          }],
          onsubmit: function(e) {
            editor.insertContent('<blockquote class="warning"><div class="icon"><img src="'+url+'/../img/warning.svg" alt=""></div><p>' + e.data.text + '</p></blockquote>');
          }
        });
      }
    });
  });

  function escape(s) {
    let lookup = {
        '&': "&amp;",
        '"': "&quot;",
        '\'': "&apos;",
        '<': "&lt;",
        '>': "&gt;"
    };
    return s.replace( /[&"'<>]/g, c => lookup[c] );
  }

  tinymce.PluginManager.add('US_tc_button5', function(editor, url) {
    editor.addButton('US_tc_button5', {
      text: 'Code tag',
      icon: false,
      onclick: function() {
        editor.windowManager.open({
          title: 'Insert code tag',
          width: 500,
          height: 200,
          body: [{
            type: 'textbox',
            name: 'title',
            label: 'Titulo'
          },{
            type: 'textbox',
            name: 'code',
            label: 'Code',
            value: '',
            multiline: true,
            minHeight: 100,
          }],
          onsubmit: function(e) {
            editor.insertContent('<div class="box-code"><div class="title-box"><div class="title-code">' + e.data.title + '</div><button class="copy-btn"><i class="fa fa-clone" aria-hidden="true"></i>Copiar código</button></div><div class="content-code"><code>' + escape(e.data.code) + '</code></div></div>');
          }
        });
      }
    });
  });
})();