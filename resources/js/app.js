import { createApp } from 'vue'
import FeePresets from './components/FeePresets.vue'
import Services from './components/Services.vue'
import Thresholds from './components/Thresholds.vue'
import FeePercentages from './components/FeePercentages.vue'
import Transactions from './components/Transactions.vue'

const app = createApp({
    data() {
        return {
            currentView: 'fee-presets'
        }
    },
    components: {
        'fee-presets': FeePresets,
        'services': Services,
        'thresholds': Thresholds,
        'fee-percentages': FeePercentages,
        'transactions': Transactions
    }
})

app.mount('#app')

