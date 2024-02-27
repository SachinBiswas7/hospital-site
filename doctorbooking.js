document.addEventListener('DOMContentLoaded', function () {
    // Array of doctors with their specialties
    const doctorsList = [
        { specialty: 'cardiologist', name: 'Dr. John Doe' },
        { specialty: 'cardiologist', name: 'Dr. Jane Smith' },
        { specialty: 'dermatologist', name: 'Dr. Mark Johnson' },
        { specialty: 'dermatologist', name: 'Dr. Emily Brown' },
        // Add more doctors as needed
    ];

    const specialtySelect = document.getElementById('specialty');
    const doctorSelect = document.getElementById('doctor');

    // Function to update doctor options based on selected specialty
    function updateDoctorOptions() {
        const selectedSpecialty = specialtySelect.value;
        const filteredDoctors = doctorsList.filter(doctor => doctor.specialty === selectedSpecialty);

        // Clear existing options
        doctorSelect.innerHTML = '';

        // Add new options based on the selected specialty
        filteredDoctors.forEach(doctor => {
            const option = document.createElement('option');
            option.value = doctor.name;
            option.textContent = doctor.name;
            doctorSelect.appendChild(option);
        });
    }

    // Event listener to update doctor options when the specialty changes
    specialtySelect.addEventListener('change', updateDoctorOptions);

    // Initial call to populate doctors based on the default specialty
    updateDoctorOptions();
});
