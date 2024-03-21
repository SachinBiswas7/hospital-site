function showDoctors(department) {
    // Hide all sections
    const sections = document.querySelectorAll('.doctor-section');
    sections.forEach(section => {
        section.style.display = 'none';
    });

    // Show the selected department
    const selectedSection = document.getElementById(department);
    if (selectedSection) {
        selectedSection.style.display = 'block';
    }
}
