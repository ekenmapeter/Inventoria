// Modal utility functions
const Modal = {
    show: function(modalId) {
        const modal = document.getElementById(modalId);
        const content = modal.querySelector('.modal-content');
        modal.classList.remove('hidden');
        setTimeout(() => content.classList.add('show'), 10);
    },

    hide: function(modalId) {
        const modal = document.getElementById(modalId);
        const content = modal.querySelector('.modal-content');
        content.classList.remove('show');
        setTimeout(() => modal.classList.add('hidden'), 300);
    },

    reset: function(modalId, formId) {
        this.hide(modalId);
        if (formId) {
            document.getElementById(formId).reset();
        }
    }
};

export default Modal;