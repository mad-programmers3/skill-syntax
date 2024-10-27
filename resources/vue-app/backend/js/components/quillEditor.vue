<template>
    <div>
        <quill-editor
                ref="quillEditor"
                v-model="content"
                :options="editorOptions"
                style="height: 300px;"
        ></quill-editor>
    </div>
</template>

<script>
    import  quillEditor  from 'vue-quill-editor'
    import 'quill/dist/quill.core.css'
    import 'quill/dist/quill.snow.css'
    import 'quill/dist/quill.bubble.css'

    export default {
        name: 'QuillEditorComponent',
        components: quillEditor ,
        props: {
            content: String
        },
        data() {
            return {
                // Quill editor options like theme and toolbar configuration
                editorOptions: {
                    theme: 'snow', // Set the Quill editor theme
                    modules: {
                        toolbar: [
                            [{ 'header': [1, 2, false] }], // Allows headers of size 1, 2, or normal text
                            ['bold', 'italic', 'underline'],  // Text formatting options
                            [{ 'list': 'ordered' }, { 'list': 'bullet' }], // List options (ordered/unordered)
                            ['link', 'image', 'clean'],  // Links, images, and a 'clean' button
                            [{ 'align': [] }], // Text alignment options
                        ]
                    }
                }
            }
        },

        watch: {
            content(val) {
                this.$emit('input', val);
            }
        }
    }
</script>