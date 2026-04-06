<template>
  <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white p-6 rounded-lg w-96">
      <h3 class="text-lg font-bold mb-4">Edit User</h3>

      <div class="space-y-2">
        <input v-model="localForm.name" placeholder="Name" class="border p-2 w-full rounded"/>
        <input v-model="localForm.email" placeholder="Email" class="border p-2 w-full rounded"/>
        <input v-model="localForm.password" type="password" placeholder="Password" class="border p-2 w-full rounded"/>
      </div>

      <div class="flex justify-end gap-2 mt-4">
        <button @click="$emit('close')" class="bg-gray-300 px-4 py-2 rounded">Cancel</button>
        <button @click="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ['editForm'],
  data() {
    return {
      localForm: { ...this.editForm }
    }
  },
  watch: {
    editForm(newVal) {
      this.localForm = { ...newVal }
    }
  },
  methods: {
    submit() {
      this.$emit('update', this.localForm)
      this.$emit('close')
    }
  }
}
</script>