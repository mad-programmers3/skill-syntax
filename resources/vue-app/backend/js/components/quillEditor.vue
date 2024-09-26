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
                editorContent: this.value,
                editorOptions: {
                    theme: 'snow', // Set the Quill editor theme
                    modules: {
                        toolbar: [
                            [{ 'header': [1, 2, false] }],
                            ['bold', 'italic', 'underline'],
                            [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                            ['link', 'image', 'clean'],
                            [{ 'align': [] }],
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










