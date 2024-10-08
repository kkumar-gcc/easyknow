<script src="{{ asset('js/tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>
<script>
    const useDarkMode = window.matchMedia('(prefers-color-scheme: dark)').matches;
    const isSmallScreen = window.matchMedia('(max-width: 1023.5px)').matches;
    tinymce.init({
        selector: "#myeditorinstance",
        plugins: [
            'advlist', 'autolink', 'importcss', 'link', 'image', 'lists', 'charmap', 'preview', 'anchor',
            'pagebreak',
            'searchreplace', 'wordcount', 'visualblocks', 'visualchars', 'code', 'fullscreen',
            'insertdatetime', 'codesample',
            'media', 'table', 'emoticons', 'template', 'help'
        ],
        toolbar: 'undo  | bold italic preview| styles | alignleft aligncenter alignright alignjustify | ' +
            'bullist numlist outdent indent | link searchreplace image media | redo  fullscreen codesample | ' +
            'print forecolor backcolor emoticons template pagebreak anchor charmap advlist| help',
        menubar: 'edit view insert format tools table help ',
        // menubar: false,
        mobile: {
            menubar: true,
            plugins: 'autosave lists autolink',
            toolbar: 'undo bold italic styles'
        },
        codesample_global_prismjs: true,
        branding: false,
        autosave_ask_before_unload: true,
        autosave_interval: '30s',
        autosave_prefix: '{path}{query}-{id}-',
        autosave_restore_when_empty: false,
        autosave_retention: '2m',
        image_advtab: true,
        link_list: [{
                title: 'My page 1',
                value: 'https://www.tiny.cloud'
            },
            {
                title: 'My page 2',
                value: 'http://www.moxiecode.com'
            }
        ],
        image_list: [{
                title: 'My page 1',
                value: 'https://www.tiny.cloud'
            },
            {
                title: 'My page 2',
                value: 'http://www.moxiecode.com'
            }
        ],
        image_class_list: [{
                title: 'None',
                value: ''
            },
            {
                title: 'Some class',
                value: 'class-name'
            }
        ],
        importcss_append: true,
        file_picker_callback: (callback, value, meta) => {
            /* Provide file and text for the link dialog */
            if (meta.filetype === 'file') {
                callback('https://www.google.com/logos/google.jpg', {
                    text: 'My text'
                });
            }

            /* Provide image and alt text for the image dialog */
            if (meta.filetype === 'image') {
                callback('https://www.google.com/logos/google.jpg', {
                    alt: 'My alt text'
                });
            }

            /* Provide alternative source and posted for the media dialog */
            if (meta.filetype === 'media') {
                callback('movie.mp4', {
                    source2: 'alt.ogg',
                    poster: 'https://www.google.com/logos/google.jpg'
                });
            }
        },
        templates: [{
                title: 'New Table',
                description: 'creates a new table',
                content: '<div class="mceTmpl"><table width="98%%"  border="0" cellspacing="0" cellpadding="0"><tr><th scope="col"> </th><th scope="col"> </th></tr><tr><td> </td><td> </td></tr></table></div>'
            },
            {
                title: 'Starting my story',
                description: 'A cure for writers block',
                content: 'Once upon a time...'
            },
            {
                title: 'New list with dates',
                description: 'New List with dates',
                content: `<div
                    class="not-prose relative mt-3 w-full p-2.5 text-base text-left  border border-transparent rounded-3xl font-normal hover:bg-gray-100 hover:shadow-md dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
                    <div class="flex flex-col items-stretch justify-center p-6 sm:flex-row">
                        <div class="relative text-center basis-1/3 min-h-fit">
                            <img class="relative block object-cover w-full h-full shadow-md rounded-xl hover:shadow-sm sm:absolute sm:top-0 sm:left-0 "
                                src="https://picsum.photos/400/300" alt="">
                        </div>
                        <div class="relative mt-2 leading-normal basis-2/3 sm:mt-0 sm:px-4">
                            <a href="" class="link link-secondary">
                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 line-clamp-3 dark:text-white ">
                                    title
                                </h5>
                            </a>
                            <p class="font-normal line-clamp-3 sm:hidden">
                                description
                            </p>
                            <p class="mt-3">
                            <span class="mr-1">by </span>
                                <a class="text-sm font-medium text-gray-900 truncate dark:text-white user-popover"
                                    href="#"
                                    >
                                link
                                </a>
                                <span class="ml-1 text-sm">some text</span>
                            </p>
                        </div>
                    </div>
                </div>`
            }
        ],
        template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
        template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
        image_caption: true,
        quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
        noneditable_class: 'mceNonEditable',
        contextmenu: 'link image table',
        content_style: `body { font-family:Helvetica,Arial,sans-serif; font-size:16px;margin:20px ;  } :focus-visible {
           outline: none;
        }`,
    });
    document.addEventListener('focusin', function(e) {
        if (e.target.closest('.tox-tinymce-aux, .moxman-window, .tam-assetmanager-root') !== null) {
            e.stopImmediatePropagation();
        }
    });
    tinymce.init({
        selector: "#editor2",
        plugins: [
            'advlist', 'autolink', 'importcss', 'link', 'image', 'lists', 'charmap', 'preview', 'anchor',
            'pagebreak',
            'searchreplace', 'wordcount', 'visualblocks', 'visualchars', 'code', 'fullscreen',
            'insertdatetime', 'codesample',
            'media', 'table', 'emoticons', 'help'
        ],
        // toolbar: '| bold italic | bullist numlist | link image media emoticons | codesample preview |' +
        //     '| styles     | ' +
        //     'forecolor | help',
        toolbar: "formatgroup paragraphgroup insertgroup moregroup",
        toolbar_groups: {
            formatgroup: {
                icon: 'format',
                tooltip: 'Formatting',
                items: 'bold italic underline strikethrough | forecolor backcolor | superscript subscript | removeformat'
            },
            paragraphgroup: {
                icon: 'paragraph',
                tooltip: 'Paragraph format',
                items: 'h1 h2 h3 | bullist numlist | alignleft aligncenter alignright | indent outdent'
            },
            insertgroup: {
                icon: 'plus',
                tooltip: 'Insert',
                items: 'link image emoticons charmap hr'
            },
            moregroup: {
                icon: "more-drawer",
                tooltip: "more",
                items: "codesample preview help "
            }
        },

        menubar: false,
        statusbar: false,
        max_height: 200,
        codesample_global_prismjs: true,
        branding: false,
        image_advtab: true,
        importcss_append: true,
        template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
        template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
        image_caption: true,
        quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
        noneditable_class: 'mceNonEditable',
        contextmenu: 'link image table',
        content_css: '{{ asset('css/app.css') }}?' + new Date().getTime(),
        content_style: `body { font-family:Helvetica,Arial,sans-serif; font-size:16px;margin:20px ;  } :focus-visible {
           outline: none;
        }`,
        toolbar_location: 'bottom',
        // skin: useDarkMode ? 'oxide-dark' : 'oxide',
        // content_css: useDarkMode ? 'dark' : 'default'
    });
</script>
