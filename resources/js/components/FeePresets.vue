<template>
    <div>
        <h2>Fee Presets</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="preset in feePresets" :key="preset.id">
                    <td>{{ preset.name }}</td>
                    <td>{{ preset.description }}</td>
                    <td>
                        <button @click="editPreset(preset)" class="btn btn-sm btn-primary">Edit</button>
                        <button @click="deletePreset(preset.id)" class="btn btn-sm btn-danger">Delete</button>
                    </td>
                </tr>
            </tbody>
        </table>
        <button @click="showModal = true" class="btn btn-success">Add Fee Preset</button>

        <div v-if="showModal" class="modal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ editingPreset ? 'Edit' : 'Add' }} Fee Preset</h5>
                        <button type="button" class="close" @click="closeModal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form @submit.prevent="savePreset">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input v-model="currentPreset.name" type="text" class="form-control" id="name" required>
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea v-model="currentPreset.description" class="form-control" id="description"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            feePresets: [],
            showModal: false,
            currentPreset: {},
            editingPreset: false
        }
    },
    mounted() {
        this.fetchFeePresets();
    },
    methods: {
        async fetchFeePresets() {
            const response = await fetch('/api/fee-presets');
            this.feePresets = await response.json();
        },
        editPreset(preset) {
            this.currentPreset = { ...preset };
            this.editingPreset = true;
            this.showModal = true;
        },
        async deletePreset(id) {
            if (confirm('Are you sure you want to delete this fee preset?')) {
                await fetch(`/api/fee-presets/${id}`, { method: 'DELETE' });
                this.fetchFeePresets();
            }
        },
        async savePreset() {
            const method = this.editingPreset ? 'PUT' : 'POST';
            const url = this.editingPreset ? `/api/fee-presets/${this.currentPreset.id}` : '/api/fee-presets';
            
            await fetch(url, {
                method,
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(this.currentPreset),
            });

            this.closeModal();
            this.fetchFeePresets();
        },
        closeModal() {
            this.showModal = false;
            this.currentPreset = {};
            this.editingPreset = false;
        }
    }
}
</script>

