import Modal from '../utils/modal.js';
import Toast from '../utils/toast.js';

const ShipBy = {
    init() {
        this.modal = document.getElementById('shipByModal');
        this.form = document.getElementById('shipByForm');
        this.submitBtn = document.getElementById('saveShipByBtn');
        this.nameInput = document.getElementById('shipByName');
        this.descInput = document.getElementById('shipByDescription');

        if (this.form && this.submitBtn) {
            this.bindEvents();
        }
    },

    bindEvents() {
        // Form submission
        this.form.onsubmit = (e) => {
            e.preventDefault();
            this.handleSubmit();
        };

        // Submit button click
        this.submitBtn.onclick = () => this.handleSubmit();

        // Close button click
        const closeBtn = this.modal.querySelector('button[onclick="closeShipByModal()"]');
        if (closeBtn) {
            closeBtn.onclick = () => this.closeModal();
        }
    },

    async handleSubmit() {
        try {
            if (!this.validateForm()) {
                return;
            }

            this.setLoading(true);

            const formData = {
                name: this.nameInput.value.trim(),
                description: this.descInput.value.trim()
            };

            const response = await fetch('/ship-by', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify(formData)
            });

            const result = await response.json();

            if (!response.ok) {
                throw new Error(result.message || 'Failed to add shipping method');
            }

            await Toast.fire({
                icon: 'success',
                title: 'Shipping method added successfully'
            });

            this.closeModal();
            await this.loadShipByOptions();

        } catch (error) {
            console.error('Error:', error);
            Toast.fire({
                icon: 'error',
                title: error.message || 'Failed to add shipping method'
            });
        } finally {
            this.setLoading(false);
        }
    },

    validateForm() {
        if (!this.nameInput.value.trim()) {
            Toast.fire({
                icon: 'warning',
                title: 'Method name is required'
            });
            this.nameInput.focus();
            return false;
        }
        return true;
    },

    setLoading(isLoading) {
        this.submitBtn.disabled = isLoading;
        this.submitBtn.innerHTML = isLoading
            ? `<div class="inline-flex items-center">
                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Saving...
               </div>`
            : `<span class="inline-flex items-center">
                <i class="fas fa-plus mr-2"></i>Add Method
               </span>`;
    },

    async loadShipByOptions() {
        const select = document.querySelector('select[name="ship_by"]');
        if (!select) return;

        try {
            select.innerHTML = '<option value="">Select Shipping Method</option>';
            const response = await fetch('/ship-by');

            if (!response.ok) {
                throw new Error('Failed to load shipping methods');
            }

            const methods = await response.json();
            methods.forEach(method => {
                select.add(new Option(method.name, method.id));
            });
        } catch (error) {
            console.error('Error loading shipping methods:', error);
            Toast.fire({
                icon: 'error',
                title: 'Failed to load shipping methods'
            });
        }
    },

    openModal() {
        Modal.show('shipByModal');
        this.form.reset();
    },

    closeModal() {
        Modal.hide('shipByModal');
        this.form.reset();
    }
};

export default ShipBy;