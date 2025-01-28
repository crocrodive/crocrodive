document.addEventListener('DOMContentLoaded', function () {
    const menuOptions = document.querySelectorAll('.menu-option');
    menuOptions.forEach(option => {
        option.addEventListener('click', function () {
            menuOptions.forEach(opt => opt.classList.remove('selected'));
            this.classList.add('selected');
            // Set the selected option
            const selectedOption = this.getAttribute('data-option');
            console.log(`Selected option: ${selectedOption}`);
            // You can now use the selectedOption variable as needed
        });
    });
});