import Modal from '../utils/modal.js';
import Toast from '../utils/toast.js';
import { generateItemCode } from '../utils/helpers.js';

const Item = {
    init: function() {
        this.bindEvents();
        this.loadInitialData();
    },

    bindEvents: function() {
        document.getElementById('itemForm').addEventListener('submit', this.handleSubmit.bind(this));
    },

    loadInitialData: async function() {
        await Promise.all([
            this.loadCategories(),
            this.loadLocations(),
            this.loadSuppliers()
        ]);
    },

    openModal: function() {
        Modal.show('itemModal');
        document.getElementById('itemCode').value = generateItemCode();
    },

    closeModal: function() {
        Modal.reset('itemModal', 'itemForm');
    },

    // ... other item-related functions
};

export default Item;