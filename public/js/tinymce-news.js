tinymce.init({
  selector: 'textarea.tinymce',
  plugins: [
    // Core editing features
    'anchor', 'autolink', 'charmap', 'codesample', 'emoticons', 'image', 'link', 'lists', 'media', 'searchreplace', 'table', 'visualblocks', 'wordcount',
    // Your account includes a free trial of TinyMCE premium features
    'checklist', 'mediaembed', 'casechange', 'export', 'formatpainter', 'pageembed', 'permanentpen', 'powerpaste', 'advtable', 'advcode', 'editimage', 'advtemplate', 'ai', 'mentions', 'tableofcontents', 'footnotes', 'autocorrect', 'inlinecss', 'markdown',
  ],
  toolbar: 'undo redo | blocks | bold italic underline strikethrough | link image media table | forecolor backcolor | spellcheckdialog a11ycheck | align | checklist bullist | emoticons charmap | removeformat',
  menubar: false,  // Désactive la barre de menu
  tinycomments_mode: 'embedded',
  tinycomments_author: 'Author name',
  mergetags_list: [
    { value: 'First.Name', title: 'First Name' },
    { value: 'Email', title: 'Email' },
  ],
  ai_request: (request, respondWith) => respondWith.string(() => Promise.reject('See docs to implement AI Assistant')),
});

// L'intégralité des fonctionnalités :

// tinymce.init({
//   selector: 'textarea.tinymce',
//   plugins: [
//     // Core editing features
//     'anchor', 'autolink', 'charmap', 'codesample', 'emoticons', 'image', 'link', 'lists', 'media', 'searchreplace', 'table', 'visualblocks', 'wordcount',
//     // Your account includes a free trial of TinyMCE premium features
//     // Try the most popular premium features until Oct 27, 2024:
//     'checklist', 'mediaembed', 'casechange', 'export', 'formatpainter', 'pageembed', 'a11ychecker', 'tinymcespellchecker', 'permanentpen', 'powerpaste', 'advtable', 'advcode', 'editimage', 'advtemplate', 'ai', 'mentions', 'tinycomments', 'tableofcontents', 'footnotes', 'mergetags', 'autocorrect', 'typography', 'inlinecss', 'markdown',
//   ],
//   toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
//   tinycomments_mode: 'embedded',
//   tinycomments_author: 'Author name',
//   mergetags_list: [
//     { value: 'First.Name', title: 'First Name' },
//     { value: 'Email', title: 'Email' },
//   ],
//   ai_request: (request, respondWith) => respondWith.string(() => Promise.reject('See docs to implement AI Assistant')),
// });