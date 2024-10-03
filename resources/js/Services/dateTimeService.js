export const dateTimeService = {
    formatDateTime(dateString) {
        const options = { weekday: 'short', month: 'short', day: 'numeric', hour: '2-digit', minute: '2-digit', hour12: true };
        const date = new Date(dateString);
        return date.toLocaleString('en-US', options).replace(',', '');
    },

    formatDate(dateString) {
        const options = { weekday: 'short', month: 'short', day: 'numeric' };
        const date = new Date(dateString);
        return date.toLocaleString('en-US', options).replace(',', '');
    },

    formatTime(dateString) {
        const options = { hour: '2-digit', minute: '2-digit', hour12: true };
        const date = new Date(dateString);
        return date.toLocaleString('en-US', options).replace(',', '');
    }
};