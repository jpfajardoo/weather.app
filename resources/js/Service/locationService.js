import { ref } from 'vue';

export function useLocationService() {
    const location = ref({
        name: 'Rizal Park, Philippines',
        lat: 14.5756660307,
        lon: 120.972679443
    });

    const fetchRecentLocation = async () => {
        try {
            const locationResponse = await fetch(`/user/location`);
            const locationData = await locationResponse.json();
            location.value.name = locationData.data.address;
            location.value.lat = locationData.data.latitude;
            location.value.lon = locationData.data.longitude;
        } catch (error) {
            console.log('error', error);
        }
    };

    return { location, fetchRecentLocation };
}