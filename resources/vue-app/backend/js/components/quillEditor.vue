<template>
    <div>
        <quill-editor
                ref="quillEditor"
                v-model="editorContent"
                :options="editorOptions"
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
        props: ['value'],
        data() {
            return {
                // Setting the initial content of the editor to the value passed from parent
                editorContent: this.value,

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
            editorContent(val) {
                this.$emit('input', val);
            }
        }
    }
</script>