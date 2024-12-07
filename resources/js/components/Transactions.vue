<template>
    <div>
        <h2>New Transaction</h2>
        <form @submit.prevent="submitTransaction">
            <div class="form-group">
                <label for="user_id">User ID</label>
                <input v-model="transaction.user_id" type="number" class="form-control" id="user_id" required>
            </div>
            <div class="form-group">
                <label for="service_id">Service</label>
                <select v-model="transaction.service_id" class="form-control" id="service_id" required>
                    <option v-for="service in services" :key="service.id" :value="service.id">{{ service.name }}</option>
                </select>
            </div>
            <div class="form-group">
                <label for="fee_preset_id">Fee Preset</label>
                <select v-model="transaction.fee_preset_id" class="form-control" id="fee_preset_id" required>
                    <option v-for="preset in feePresets" :key="preset.id" :value="preset.id">{{ preset.name }}</option>
                </select>
            </div>
            <div class="form-group">
                <label for="amount">Amount</label>
                <input v-model="transaction.amount" type="number" step="0.01" class="form-control" id="amount" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit Transaction</button>
        </form>

        <div v-if="result" class="mt-4">
            <h3>Transaction Result</h3>
            <pre>{{ JSON.stringify(result, null, 2) }}</pre>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            transaction: {
                user_id: '',
                service_id: '',
                fee_preset_id: '',
                amount: ''
            },
            services: [],
            feePresets: [],
            result: null
        }
    },
    mounted() {
        this.fetchServices();
        this.fetchFeePresets();
    },
    methods: {
        async fetchServices() {
            const response = await fetch('/api/services');
            this.services = await response.json();
        },
        async fetchFeePresets() {
            const response = await fetch('/api/fee-presets');
            this.feePresets = await response.json();
        },
        async submitTransaction() {
            const response = await fetch('/api/transactions', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(this.transaction),
            });
            this.result = await response.json();
            this.transaction = {
                user_id: '',
                service_id: '',
                fee_preset_id: '',
                amount: ''
            };
        }
    }
}
</script>

