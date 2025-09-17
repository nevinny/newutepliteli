// public/assets/js/ckeditor-init.js
document.addEventListener('DOMContentLoaded', function () {
    alert('js/ckeditor-init.js');
    // Ждем загрузки DOM и CKEditor
    setTimeout(function () {
        if (typeof ClassicEditor !== 'undefined') {
            // Инициализируем для всех textarea с классом ckeditor
            document.querySelectorAll('textarea.ckeditor').forEach(textarea => {
                if (!textarea.hasAttribute('data-ckeditor-initialized')) {
                    ClassicEditor
                        .create(textarea, {
                            toolbar: {
                                items: [
                                    'heading', '|',
                                    'bold', 'italic', 'underline', 'strikethrough', '|',
                                    'link', 'blockQuote', '|',
                                    'bulletedList', 'numberedList', '|',
                                    'undo', 'redo'
                                ]
                            },
                            language: 'ru',
                            placeholder: 'Введите текст...'
                        })
                        .then(editor => {
                            textarea.setAttribute('data-ckeditor-initialized', 'true');
                        })
                        .catch(error => {
                            console.error('CKEditor initialization error:', error);
                        });
                }
            });
        }
    }, 100);
});
