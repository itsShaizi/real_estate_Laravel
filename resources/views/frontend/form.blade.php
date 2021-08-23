<form action="/contact" method="POST" class="w-64 mx-auto" x-data="contactForm()" @submit.prevent="submitData">
    <div class="mb-4">
        <label class="block mb-2">Name:</label>
        <input type="text" name="name" class="border w-full p-1" x-model="formData.name">
    </div>

    <div class="mb-4">
        <label class="block mb-2">E-mail:</label>
        <input type="email" name="email" class="border w-full p-1" x-model="formData.email">
    </div>

    <div class="mb-4">
        <label class="block mb-2">Message:</label>
        <textarea name="message" class="border w-full p-1" x-model="formData.message"></textarea>
    </div>
    <button class="bg-gray-700 hover:bg-gray-800 disabled:opacity-50 text-white w-full p-2 mb-4" x-text="buttonLabel" :disabled="loading"></button>

    <p x-text="message"></p>
</form>

<style type="text/css">
    button:disabled {
      cursor: not-allowed;
      opacity: 0.5;
    }
</style>

<script type="text/javascript">
function contactForm() {
    return {
        formData: {
            name: '',
            email: '',
            message: ''
        },
        message: '',
        loading: false,
        buttonLabel: 'Submit',

        submitData() {
            this.buttonLabel = 'Submitting...'
            this.loading = true;
            this.message = ''
            
            fetch('/contact', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(this.formData)
            })
            .then(() => {
                this.message = 'Form sucessfully submitted!'
            })
            .catch(() => {
                this.message = 'Ooops! Something went wrong!'
            })
            .finally(() => {
                this.loading = false;
                this.buttonLabel = 'Submit'
            })
        }
    }
}
</script>