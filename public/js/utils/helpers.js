// General helper functions
export const generateItemCode = () => {
    const prefix = 'ITM';
    const timestamp = Date.now().toString().slice(-6);
    const random = Math.floor(Math.random() * 1000).toString().padStart(3, '0');
    return `${prefix}${timestamp}${random}`;
};

export const generateTrackingRef = () => {
    const prefix = 'TRK';
    const date = new Date();
    const year = date.getFullYear().toString().slice(-2);
    const month = (date.getMonth() + 1).toString().padStart(2, '0');
    const day = date.getDate().toString().padStart(2, '0');
    const timestamp = date.getTime().toString().slice(-4);
    const random = Math.floor(Math.random() * 1000).toString().padStart(3, '0');
    return `${prefix}${year}${month}${day}-${timestamp}${random}`;
};

export const showTableLoading = (tableId) => {
    const tbody = document.getElementById(tableId);
    tbody.innerHTML = `
        <tr>
            <td colspan="100%" class="loading-spinner">
                <div>
                    <div class="loading-spinner-icon"></div>
                    <div class="loading-text">Loading data...</div>
                </div>
            </td>
        </tr>
    `;
};