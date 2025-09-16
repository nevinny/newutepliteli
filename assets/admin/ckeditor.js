// assets/admin/ckeditor.js

import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import {CKEditor} from '@ckeditor/ckeditor5-vue';

document.addEventListener('DOMContentLoaded', function () {
    // Ждем инициализации EasyAdmin
    const initCKEditor = function () {
        const wysiwygFields = document.querySelectorAll('[data-ea-wysiwyg-field]');

        if (wysiwygFields.length > 0 && typeof ClassicEditor !== 'undefined') {
            wysiwygFields.forEach(field => {
                if (!field.hasAttribute('data-ckeditor-initialized')) {
                    const toolbarConfig = field.getAttribute('data-ea-wysiwyg-toolbar');
                    const height = field.getAttribute('data-ea-wysiwyg-height');
                    const language = field.getAttribute('data-ea-wysiwyg-language');

                    const config = {
                        toolbar: toolbarConfig ? JSON.parse(toolbarConfig) : {
                            items: [
                                'heading', '|',
                                'bold', 'italic', 'underline', 'strikethrough', '|',
                                'link', 'blockQuote', '|',
                                'bulletedList', 'numberedList', '|',
                                'undo', 'redo'
                            ]
                        },
                        language: language || 'ru',
                        height: height || 400
                    };

                    ClassicEditor
                        .create(field, config)
                        .then(editor => {
                            field.setAttribute('data-ckeditor-initialized', 'true');
                            console.log('CKEditor initialized');
                        })
                        .catch(error => {
                            console.error('CKEditor initialization error:', error);
                        });
                }
            });
        }
    };

    // Инициализируем сразу и при динамических изменениях
    initCKEditor();

    // Для асинхронно загружаемых форм
    document.addEventListener('ea.collection.item-added', initCKEditor);
    document.addEventListener('ea.tab.loaded', initCKEditor);
});
