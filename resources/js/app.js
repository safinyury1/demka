import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();


const selectElements = document.querySelectorAll('.status-form select[name="status_id"]');
console.log('Найдено элементов select:', selectElements.length);

for (let elem of selectElements) {
    elem.addEventListener('change', function() {
        console.log('Изменен статус для формы:', this.form);
        this.form.submit(); 
    });
}